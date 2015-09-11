<?php

function query_operon_gene_percentage($species_id){

    $spe = array();
    $spe['name'] = '';
    $spe['ncs'] = array();
    $spe['total_gene'] = 0;
    $spe['in_operon']  = 0;

    $species_id = mysql_real_escape_string($species_id);
    $sql = "SELECT id, name FROM Species WHERE id=$species_id";
    $result=mysql_query($sql) or die("Invalid query: ".mysql_error());
    $row=mysql_fetch_array($result);
    $spe['name']=$row['name'];
    unset($result);

    $sql="SELECT id,NC_id,protein_gene_number,rna_gene_number,operon_number FROM NC WHERE species_id=$species_id";
    $result=mysql_query($sql) or die("Invalid query: ".mysql_error());
    $n=mysql_num_rows($result);
    for($i=0;$i<$n;$i++){
        $row=mysql_fetch_array($result);
        $NC_id=$row['id'];
        $row['total_gene_num'] =
            $row['protein_gene_number'] + $row['rna_gene_number'];

        $sql2="SELECT sum(size) as total_genes FROM Operon WHERE size>=2 AND NC_id=$NC_id ORDER BY id";
        $result2=mysql_query($sql2) or die("Invalid query: ".mysql_error());
        $row2=mysql_fetch_array($result2);
        $row['gene_in_operon'] = $row2['total_genes'];

        #$row['percent'] = round($row['gene_in_operon'] / $row['total_gene_num'],2);

        array_push($spe['ncs'], $row);

        $spe['total_gene'] += $row['total_gene_num'];
        $spe['in_operon']  += $row['gene_in_operon'];
    }
    $spe['percent'] = round((100*$spe['in_operon'])/$spe['total_gene'], 2);

    return $spe;
}

function average($input){
    return array_sum($input)/count($input);
}

function median($input){
    sort($input);
    $num=count($input);
    if ($num % 2){
        $median=$input[floor($num)/2];
    }
    else{
        $median=($input[$num/2]+$input[$num/2-1])/2;
    }

    return $median;
}

function StandardDeviation($input){
    $avg=average($input);
    foreach ($input as $value){
        $variance[]=pow($value-$avg,2);
    }
    $deviation=sqrt(average($variance));
    return $deviation;
}
################ old #####################3


function Correlation($array1,$array2){
    $avg_array1=average($array1);
    $avg_array2=average($array2);
    #print "$avg_array1----- $avg_array2<br>";
    $sum_correlation_up=0;
    for ($i=0;$i<count($array1);$i++){
        $sum_correlation_up=$sum_correlation_up+(($array1[$i]-$avg_array1)*($array2[$i]-$avg_array2));

    }	
    #print $sum_correlation_up."<br>";

    $sum_array1_sumpow2=0;
    for ($i=0;$i<count($array1);$i++){
        $sum_array1_sumpow2=$sum_array1_sumpow2+pow(($array1[$i]-$avg_array1),2);
    }	
    $sum_array1_sumpow2_sqrt=sqrt($sum_array1_sumpow2);
    #rint $sum_array1_sumpow2_sqrt."<br>";

    $sum_array2_sumpow2=0;
    for ($i=0;$i<count($array1);$i++){
        $sum_array2_sumpow2=$sum_array2_sumpow2+pow(($array2[$i]-$avg_array2),2);
    }	
    $sum_array2_sumpow2_sqrt=sqrt($sum_array2_sumpow2);
    #print $sum_array2_sumpow2_sqrt."<br>";

    $correlation=$sum_correlation_up/($sum_array1_sumpow2_sqrt*$sum_array2_sumpow2_sqrt);	

    return $correlation;
}





function extract_operon_size($operon_id){
    $sql="SELECT size FROM Operon WHERE id=$operon_id";
    $result=mysql_query($sql) or die("Invalid query: ".mysql_error());
    $row=mysql_fetch_array($result);
    #	print_r($row);
    return $row['size'];


}



function extract_intergenic_length($operon_id){
    $sql="SELECT Gene.id as id,start,end,strand,length FROM Gene,Operon_Gene WHERE Operon_Gene.operon_id='$operon_id' AND Operon_Gene.gene_id=Gene.id";
    $result=mysql_query($sql) or die("Can not query: '$sql' ".mysql_error());
    $row=mysql_fetch_array($result);
    if (strcmp($row[3],'-')==0){
        $sql_strand_neg="SELECT Gene.id as id,start,end,strand,length,NC_id FROM Gene,Operon_Gene WHERE Operon_Gene.operon_id='$operon_id' AND Operon_Gene.gene_id=Gene.id ORDER BY end DESC LIMIT 1";
        $strand_result=mysql_query($sql_strand_neg) or die("Can not query: '$sql_strand_neg' ".mysql_error());
        $row1=mysql_fetch_array($strand_result);
        $NC_id=$row1[5];
        $upstream_startposition=$row1[2]+1;
        #	        $sql_upstream_end="SELECT id,start,end,strand,NC_id FROM Gene WHERE strcmp(strand,'-')=0 AND start>".$upstream_startposition." AND NC_id=".$NC_id." ORDER BY start LIMIT 1";
        #	        $sql_upstream_end="SELECT id,start,end,strand,NC_id FROM Gene WHERE start>".$upstream_startposition." AND NC_id=".$NC_id." AND strcmp(strand,'-')=0 ORDER BY start LIMIT 1";
        $sql_upstream_end="SELECT id,start,end,strand,NC_id FROM Gene WHERE start>".$upstream_startposition." AND NC_id=".$NC_id." ORDER BY start LIMIT 1";
        $upstream_end_result=mysql_query($sql_upstream_end) or die("Can not query: '$sql_upstream_end' ".mysql_error());
        $row2=mysql_fetch_array($upstream_end_result);
        $upstream_endposition=$row2[1]-1;
        $intergenic_length=$upstream_endposition-$upstream_startposition+1;
        return $intergenic_length;
    }#if
    else{
        $sql_strand_pos="SELECT Gene.id as id,start,end,strand,length,NC_id FROM Gene,Operon_Gene WHERE Operon_Gene.operon_id='$operon_id' AND Operon_Gene.gene_id=Gene.id ORDER BY start LIMIT 1";
        $strand_result=mysql_query($sql_strand_pos) or die("Can not query: '$sql_strand_pos' ".mysql_error());
        $row1=mysql_fetch_array($strand_result);
        $NC_id=$row1[5];
        $upstream_endposition=$row1[1]-1;
        $sql_upstream_start="SELECT id,start,end,strand,NC_id FROM Gene WHERE strcmp(strand,'+')=0 AND start<".$upstream_endposition." AND NC_id=".$NC_id." ORDER BY start DESC LIMIT 1";
        #	        $sql_upstream_start="SELECT id,start,end,strand,NC_id FROM Gene WHERE start<".$upstream_endposition." AND NC_id=".$NC_id." AND strcmp(strand,'+')=0 ORDER BY start DESC LIMIT 1";
        $upstream_start_result=mysql_query($sql_upstream_start) or die("Can not query: '$sql_upstream_start' ".mysql_error());
        $row2=mysql_fetch_array($upstream_start_result);
        $upstream_startposition=$row2[2]+1;
        $intergenic_length=$upstream_endposition-$upstream_startposition+1;
        return $intergenic_length;
    }#else
}





function extract_totalgene_length_ofoperon($operon_id){
    $sql="SELECT Gene.id as id,start,end,strand,length,NC_id FROM Gene,Operon_Gene WHERE Operon_Gene.operon_id='$operon_id' AND Operon_Gene.gene_id=Gene.id ORDER BY start";
    $result=mysql_query($sql) or die("Can not query: '$sql' ".mysql_error());
    $n=mysql_num_rows($result);
    $total_lengthofgenes_ofoneoperon=0;
    for($i=0;$i<$n;$i++){
        $row=mysql_fetch_array($result);
        $total_lengthofgenes_ofoneoperon=$total_lengthofgenes_ofoneoperon+$row[4];
    }
    return $total_lengthofgenes_ofoneoperon;	
}





function extract_operon_length($operon_id){
    $sql1="SELECT Gene.id as id,start,end,strand,length,NC_id FROM Gene,Operon_Gene WHERE Operon_Gene.operon_id='$operon_id' AND Operon_Gene.gene_id=Gene.id ORDER BY start LIMIT 1";
    $result1=mysql_query($sql1) or die("Can not query: '$sql1' ".mysql_error());
    $row1=mysql_fetch_array($result1);
    $first_geneofoperon_start=$row1['start'];
    $sql2="SELECT Gene.id as id,start,end,strand,length,NC_id FROM Gene,Operon_Gene WHERE Operon_Gene.operon_id='$operon_id' AND Operon_Gene.gene_id=Gene.id ORDER BY end DESC LIMIT 1";
    $result2=mysql_query($sql2) or die("Can not query: '$sql2' ".mysql_error());
    $row2=mysql_fetch_array($result2);
    $last_geneofoperon_end=$row2['end'];
    $operon_length=$last_geneofoperon_end-$first_geneofoperon_start+1;
    return $operon_length;
}





function get_histogram($data,$x_legend,$y_legend,$x_tick_gap){
    $img_dim_x=800;
    $img_dim_y=500;
    $im = @imagecreate($img_dim_x,$img_dim_y) or die("Cannot Initialize new GD image stream");
    $background_color = imagecolorallocate($im, 255, 255, 255);  // white
    $black = imagecolorallocate($im, 0, 0, 0); #black
    $blue = imagecolorallocate($im,0,0,255); #blue
    $x1=20;$y1=10;$x2=$img_dim_x-10;$y2=$img_dim_y-40;
    imagerectangle($im,$x1,$y1,$x2,$y2,$black);
    $x_axis_legend_x=($x1+$x2)/2-30;
    $x_axis_legend_y=$y2+25;
    imagestring($im,3,$x_axis_legend_x,$x_axis_legend_y,$x_legend,$black);
    $y_axis_legend_x=$x1-15;
    $y_axis_legend_y=($y1+$y2)/2;
    imagestringup($im,3,$y_axis_legend_x,$y_axis_legend_y,$y_legend,$black);
    $keys=array_keys($data);
    $values=array_values($data);
    sort($keys,SORT_NUMERIC);
    $max=max($values);$min=min($values);
    for($i=0;$i<count($keys);$i++){
        $height=0.9*($y2-$y1)*$data[$keys[$i]]/$max;
        $bar_x1=(($x2-$x1)/count($keys))*($i+0.2)+$x1;
        $bar_y1=$y2-$height;
        $bar_x2=(($x2-$x1)/count($keys))*($i+0.8)+$x1;
        $bar_y2=$y2;
        imagefilledrectangle($im,$bar_x1,$bar_y1,$bar_x2,$bar_y2,$blue);
        #	imagestring($im,3,$bar_x1,$bar_y1-15,$data[$keys[$i]],$black);
        if($i%$x_tick_gap==0){
            imagestring($im,3,$bar_x1,$bar_y2+5,$keys[$i],$black);
        }
    }
    for($i=0;$i<count($keys);$i++){
        $height=0.9*($y2-$y1)*$data[$keys[$i]]/$max;
        $bar_x1=(($x2-$x1)/count($keys))*($i+0.2)+$x1;
        $bar_y1=$y2-$height;
        $bar_x2=(($x2-$x1)/count($keys))*($i+0.8)+$x1;
        $bar_y2=$y2;
        imagestring($im,3,$bar_x1,$bar_y1-15,$data[$keys[$i]],$black);
    }
    return $im;
}

#PHP file end
?>
