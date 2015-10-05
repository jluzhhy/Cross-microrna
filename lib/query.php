<?php

function print_table_head($head_items,$length,$align){
	print "<tr bgcolor=#EFEFEF  align=\"center\">\n";
	for($i=0;$i<count($head_items);$i++){
		print "<td width=".$length[$i]." align=".$align[$i].">\n";
		print "<b>".$head_items[$i]."</b>";
		print "</td>\n";
	}
	print "</tr>\n";
}

function print_operon_table_head(){
	$head_items=array("All<input name=\"operonListAll\" type=\"checkbox\" id=\"operonListAll\" value=\"operonListAll\" onClick={operonListAllClicked();}>","Operon ID<br>(# of similar operons)","GI","Synonym","Gene","Start","End","Strand","Length","COG Number","Product");
	$length=array("5%","10%","5%","10%","5%","10%","10%","5%","5%","10%","30%");
	$align=array("center","center","center","center","center","center","center","center","center","center","left");
	print_table_head($head_items,$length,$align);
}

function print_gene_table_head(){
	$head_items=array("GI","Operon ID","Strand","Length","Synonym","Gene","COG_number","Product","Species");
	$length=array("10%","10%","5%","5%","5%","5%","10%","35%","15%");
	$align=array("center","center","center","center","center","center","center","left","left");
	print_table_head($head_items,$length,$align);
}

function print_similar_operon($r,$bgcolor){
		print "<tr bgcolor=\"$bgcolor\" align=center>\n";
		print "<td align=center><input type=checkbox name=operon".$r['operon2_id']." value=".$r['operon2_id']."></td>";
		print "<td>\n";
		print "<a href=operondetail.php?id=".$r['operon2_id'].">".$r['operon2_id']."</a>";
		print "</td>\n";
		print "<td>\n";
		print $r['size'];
		print "</td>\n";
		print "<td><a href=displayWeightedMatching.php?operon1_id=".$r['operon1_id']."&operon2_id=".$r['operon2_id'].">";
		print $r['unweighted'];
		print "</a></td>\n";
		print "<td><a href=displayWeightedMatching.php?operon1_id=".$r['operon1_id']."&operon2_id=".$r['operon2_id'].">";
		printf("%10.2f",$r['weighted']);
		print "</a></td>\n";
		print "<td><a href=displayWeightedMatching.php?operon1_id=".$r['operon1_id']."&operon2_id=".$r['operon2_id'].">";
		printf("%10.2f",$r['bit_score']);
		print "</a></td>\n";
		print "<td><a href=displaySimilarOperon.php?operon1_id=".$r['operon2_id']."&source=1>";
		print $r['similar_operon_number'];
		print "</a></td>\n";
		print "<td align=left>\n<a href=displayNC.php?id=".$r['species_id'].">";
		print $r['species_name'];
		print "</a></td>\n";
}

function print_gene($row1,$bgcolor){
		print "<tr bgcolor=\"$bgcolor\" align=\"center\">\n";
		print "<td>\n";
		print "<a href=genedetail.php?id=".$row1['id'].">".$row1['gi']."</a>";
		print "</td>\n";
		print "<td>\n";
		print "<a href=operondetail.php?id=".$row1['operon_id'].">".$row1['operon_id']."</a>";
		print "</td>\n";
		print "<td>\n";
		print $row1['strand'];
		print "</td>\n";
		print "<td>\n";
		print $row1['length'];
		print "</td>\n";
		print "<td>\n";
		print $row1['synonym'];
		print "</td>\n";
		print "<td>\n";
		print $row1['gene'];
		print "</td>\n";
		print "<td>\n";
		$items=explode(',',$row1['COG_number']);
		foreach($items as $COG_value){
			if(strlen($COG_value)>1){
				print "<a href=http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?$COG_value>";
				print $COG_value;
				print "</a><br>";
			}else{
				print "&nbsp;";
			}
		}
		print "</td>\n";
		print "<td align=\"left\">\n";
		print $row1['product'];
		print "</td>\n";
		print "<td align=left>\n";
		print "<a href=\"displayNC.php?id=".$row1['species_id']."\">";
		#print $row1['species_id'];
		print $row1['name'];
		print "</a>";
		print "</td>\n";
		print "</tr>\n";
}

function operondetail($id){
		#$sql="SELECT gi,strand,length,synonym,gene,COG_number,COGNITOR,GO,Pfam,class_string,product,Species.name as name,species_id,sequence FROM Gene,Species WHERE gi=$gi AND species_id=Species.id";
		$sql="SELECT Operon.id as id,size,Operon.protein_gene_number as protein_gene_number,Operon.rna_gene_number as rna_gene_number,similar_operon_number,reference,Species.id as species_id,Species.name as species_name,three_letter_name,KEGG_GENOME_ID,VIMSS_url,NC.id as NC_id,NC.NC_id as NC_name,NC.description as NC_description FROM Operon,Species,NC WHERE Operon.id=$id AND Operon.species_id=Species.id AND Operon.NC_id=NC.id";
		$result=mysql_query($sql) or die("Can not query $sql ".mysql_error());
		$row1=mysql_fetch_array($result,MYSQL_ASSOC);
		print "<table width=80% border=0 align=center>\n<tr>";
		print "<td width=33%>&nbsp;</td>";
		print "<td width=34%><div align=center>Operon information: ID=<b>".$row1['id']."</b></div></td>\n";
		print "<td width=33% align=right valign=center><form id=\"operonListForm\" name=\"operonListForm\" method=\"post\" action=\"addToSelectedOperon.php\">";
		print "<input type=hidden id=operon$id name=operon$id value=$id>";
		print "<input type=submit name=submit value=\"Add operon $id to selected operons\">";
		print "</form></td>";
		print "</tr></table>";
		$operon1_id=$row1['id'];
		print "<table align=center width=80% border=1>\n";
		print "<tr>\n";
		print "<td width=20% align=right><b>Operon ID</b></td>";
		print "<td width=80%>".$row1['id']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Size</b></td>";
		print "<td>".$row1['size']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Protein gene number</b></td>";
		print "<td>".$row1['protein_gene_number']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>RNA gene number</b></td>";
		print "<td>".$row1['rna_gene_number']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Similar operon number</b></td>";
		print "<td><a href=displaySimilarOperon.php?operon1_id=".$row1['id']."&source=1>".$row1['similar_operon_number']."</a></td>";;
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Genes</b></td>";
		print "<td>";
		$sql_genes="SELECT Gene.id as id,gi,strand,start,end,synonym,COG_number,product,ODB FROM Gene,Operon_Gene WHERE Operon_Gene.gene_id=Gene.id AND operon_id=$id";
		$result_gene=mysql_query($sql_genes) or die("Can not query $sql_genes, ".mysql_error());
		$n=mysql_num_rows($result_gene);
		print "<table border=0>";
		$headitems=array("GI","Start","End","Strand","Synonym","COG","Product");
		$width=array("10%","10%","10%","5%","10%","10%","45%");
		$align=array("center","center","center","center","center","center","left");
		print_table_head($headitems,$width,$align);
		$flag=0;
		$gene_synonyms=array();
		for($i=0;$i<$n;$i++){
			$r=mysql_fetch_array($result_gene,MYSQL_ASSOC);
			print "<tr>";
			print "<td align=center valign=top><a href=genedetail.php?id=".$r['id'].">".$r['gi']."</a></td>";
			print "<td align=center valign=top>".$r['start']."</td>";
			print "<td align=center valign=top>".$r['end']."</td>";
			print "<td align=center valign=top>".$r['strand']."</td>";
			print "<td align=center valign=top><a href=genedetail.php?id=".$r['id'].">".$r['synonym']."</a></td>";
			print "<td align=center valign=top>";
			$items=explode(',',$r['COG_number']);
			foreach($items as $COG_value){
				if(strlen($COG_value)>1){
					print "<a href=http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?$COG_value>";
					print $COG_value;
					print "</a>&nbsp;<br>";
				}else{
					print "&nbsp;";
				}
			}
			print "</td>";
			print "<td align=left valign=top>".$r['product']."</td>";
			print "</tr>";
			if($r['ODB']>0){
				$flag=$r['ODB'];
			}
			array_push($gene_synonyms,$r['synonym']);
		}
		print "</table>";
		print "</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Species name</b></td>";
		print "<td>";
		print "<a href=\"displayNC.php?id=".$row1['species_id']."\">";
		print $row1['species_name'];
		print "</a>";
		print "</td>";
		print "</tr>\n";
		print "<tr>";
		print "<tr>\n";
		print "<td align=right><b>NC name</b></td>";
		print "<td>";
		print "<a href=\"displayNCoperon.php?id=".$row1['NC_id']."&page=1\">";
		print $row1['NC_name'];
		print "</a>";
		print "</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>NC description</b></td>";
		print "<td>";
		print "<a href=\"displayNCoperon.php?id=".$row1['NC_id']."&page=1\">";
		print $row1['NC_description'];
		print "</a>";
		print "</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>ODB info</b></td>";
		print "<td>";
		$link="http://odb.kuicr.kyoto-u.ac.jp/odb2.rb?org=".$row1['three_letter_name']."&genome_id=".$row1['KEGG_GENOME_ID']."&genes=".join(",",$gene_synonyms);
		if($flag==0){
			print "No information available in ODB.";
		}elseif($flag==1){
			print "There is a known operon with literature information, click <a href=\"$link\">here</a> to show.";
		}elseif($flag==2){
			print "There is a putative operon in ODB, click <a href=\"$link\">here</a> to show.";
		}
		print "</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>VIMSS info</b></td>";
		print "<td>";
		if(strlen($row1['VIMSS_url'])>0){
			print "Click <a href=http://www.microbesonline.org/operons/".$row1['VIMSS_url'].">here</a> to show related information in VIMSS.";
		}else{
			print "No information available in VIMSS operon database.";
		}
		print "</td>";
		print "</tr>\n";
		print "<tr><td align=right><b>Reference</b></td><td>\n";
		if(strlen(trim($row1['reference']))>0){
			$refs=split(",",$row1['reference']);
			foreach ($refs as $ref) {
				print "<a href=\"http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=pubmed&dopt=Abstract&list_uids=$ref\">$ref</a>&nbsp;";
			}
		}else{
			print "No literature information available.";
		}
		print "</td></tr>\n";
		print "<tr>\n";
		print "<td colspan=2>";
		print "<div align=center><b>Search for similar operons with: ".$row1['id']."</b></div>";
		include "operon_query_form.php";
		print "</b></td>";
		print "</tr>\n";
		print "</table>\n";
}

function genedetail($id){
		#$sql="SELECT gi,strand,length,synonym,gene,COG_number,COGNITOR,GO,Pfam,class_string,product,Species.name as name,species_id,sequence FROM Gene,Species WHERE gi=$gi AND species_id=Species.id";
		$sql="SELECT * FROM Gene,Species WHERE Gene.id=$id AND species_id=Species.id";
		$result=mysql_query($sql) or die("Can not query $sql ".mysql_error());
		$row1=mysql_fetch_array($result,MYSQL_ASSOC);
		print "<div align=center>Gene information for gene <b>".$row1['gi']."</b></div>\n";
		print "<table align=center width=70% border=1>\n";
		print "<tr>\n";
		print "<td width=20% align=right><b>GI</b></td>";
		print "<td width=80%>".$row1['gi']."</td>";
		print "</tr>\n";
		$sql1="SELECT * FROM Operon_Gene WHERE gene_id=$id";
		$result1=mysql_query($sql1) or die("Mysql error: sql1 ".mysql_error());
		$n1=mysql_num_rows($result1);
		if($n1!=0){
			$row2=mysql_fetch_array($result1,MYSQL_ASSOC);
			print "<tr>\n";
			print "<td align=right><b>Operon ID</b></td>";
			print "<td><a href=operondetail.php?id=".$row2['operon_id'].">".$row2['operon_id']."</a></td>";
			print "</tr>\n";
		}
		print "<tr>\n";
		print "<td align=right><b>Strand</b></td>";
		print "<td>".$row1['strand']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Start</b></td>";
		print "<td>".$row1['start']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>End</b></td>";
		print "<td>".$row1['end']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Length</b></td>";
		print "<td>".$row1['length']."</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Synonym</b></td>";
		print "<td>".$row1['synonym']."</td>";;
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Gene</b></td>";
		print "<td>".$row1['gene']."</td>";
		print "</tr>\n";
#		print "<tr>\n";
#		print "<td align=right><b>COG Code</b></td>";
#		print "<td>";
#		$items=explode(' ',$row1['COG_code']);
#		foreach($items as $COG_code){
#			if(strlen($COG_code)>0){
#				print "<a href=http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?fun=$COG_code>";
#				print $COG_code;
#				print "</a><br>";
#			}else{
#				print "&nbsp;";
#			}
#		}
#		print "</td>";
#		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>COG Number</b></td>";
		print "<td>";
		$items=explode(',',$row1['COG_number']);
		foreach($items as $COG_value){
			if(strlen($COG_value)>1){
				print "<a href=http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?$COG_value>";
				print $COG_value;
				print "</a>&nbsp;";
			}else{
				print "&nbsp;";
			}
		}
		print "</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Product</b></td>";
		print "<td>";
		print $row1['product'];
		print "</td>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td align=right><b>Species</b></td>";
		print "<td>";
		print "<a href=\"displayNC.php?id=".$row1['species_id']."\">";
		print $row1['name'];
		print "</a>";
		print "</td>";
		print "</tr>\n";
		print "<tr>";
		print "<td align=right><b>Sequence</b></td>";
		$n=$row1['length']/70;
		$new_seq='';
		for($i=0;$i<$n;$i++){
			$new_seq=$new_seq.substr($row1['sequence'],$i*70,70)."<br>";
		}
		print "<td><pre>".$new_seq."</pre><td>";
		print "</tr>";
		print "</table>\n";
}

function print_operon($row1,$bgcolor){
		print "<tr bgcolor=\"$bgcolor\">\n";
		$sql="SELECT synonym,gene,Gene.id as id,gi,start,end,strand,length,COG_number,product FROM Gene,Operon_Gene WHERE Operon_Gene.operon_id=".$row1['id']." AND Operon_Gene.gene_id=Gene.id";
		$result=mysql_query($sql) or die("Can not query: '$sql' ".mysql_error());
		$n=mysql_num_rows($result);
		print "<td rowspan=$n align=center><input type=checkbox name=operon".$row1['id']." value=".$row1['id']."></td>";
		print "<td rowspan=$n align=center>\n";
		print "<a href=operondetail.php?id=".$row1['id'].">".$row1['id']."</a>";
		print "<br>";
		print "<a href=displaySimilarOperon.php?operon1_id=".$row1['id']."&source=1>(".$row1['similar_operon_number'].")</a>";
		print "</td>\n";
		$fields=array("gi","synonym","gene","start","end","strand","length","COG_number","product");
		for($i=0;$i<$n;$i++){
			if($i!=0){
				print "<tr bgcolor=\"$bgcolor\">";
			}
			$row2=mysql_fetch_array($result);
			for($j=0;$j<count($fields);$j++){
				if(strcmp($fields[$j],"product")==0){
					print "<td align=left>".$row2[$fields[$j]]."</td>\n";
				}elseif(strcmp($fields[$j],"gi")==0){
					print "<td align=center><a href=genedetail.php?id=".$row2['id'].">".$row2[$fields[$j]]."</a></td>\n";
				}else{
					print "<td align=center>".$row2[$fields[$j]]."</td>\n";
				}
			}
			print "</tr>\n";
		}
}

function display_similar_operon($operon1_id,$sql,$page){
        $pagesize=$_SESSION['pagesize'];
        if($pagesize<=0){
                $pagesize=30;
        }

	$hits=$_SESSION['hits_similar_operon'];
	if(strlen(trim($hits))==0){
#		$result=mysql_query($sql) or die("Invalid query 1: ".mysql_error());
		$result=mysql_query($sql) or die("Invalid query 1");
		$hits=mysql_num_rows($result);
		$_SESSION['hits_similar_operon']=$hits;
	}
	$offset=($page-1)*$pagesize;
	$sql1="$sql LIMIT $offset,$pagesize";
	$result1=mysql_query($sql1) or die("Invalid query: $sql1,".mysql_error());
	$n=mysql_num_rows($result1);
	print "<div align=center><b>Similar operons with operon $operon1_id: ".$hits." operons, page $page</b></div>\n";
#	print "<div align=center>\n";
	print "<table width=\"100%\" border=\"1\">\n";
	$headitems=array("All<input name=\"operonListAll\" type=\"checkbox\" id=\"operonListAll\" value=\"operonListAll\" onClick={operonListAllClicked();}>","Operon ID","Size","Unweighted Score","Log(E-value) Score","Bit Score","Similar Operons","Species Name");
	$width=array("5%","10%","10%","10%","10%","10%","10%","35%");
	$align=array("center","center","center","center","center","center","center","left");
	print "<form id=\"operonListForm\" name=\"operonListForm\" method=\"post\" action=\"addToSelectedOperon.php\">";
	print_table_head($headitems,$width,$align);
	for($i=0;$i<$n;$i++){
		$r=mysql_fetch_array($result1,MYSQL_ASSOC);
		if($i%2==0)$bgcolor="#FFFFFF";
		else $bgcolor="#EFEFEF";
		print_similar_operon($r,$bgcolor);
		
	}
	print "</table>";
}

function displaygenefromSQL($sql,$page){
        $pagesize=$_SESSION['pagesize'];
        if($pagesize<=0){
                $pagesize=30;
        }

	$hits=$_SESSION['sql_gene_hits'];
	if(strlen(trim($hits))==0){
#		$result=mysql_query($sql)  or die("Invalid query 1: ".mysql_error());
		$result=mysql_query($sql)  or die("Invalid query 1");
		$hits=mysql_num_rows($result);
		$_SESSION['sql_gene_hits']=$hits;
	}
	$offset=($page-1)*$pagesize;
	$sql1="$sql LIMIT $offset,$pagesize";
	$result1=mysql_query($sql1) or die("Invalid query: ".mysql_error());
	$n=mysql_num_rows($result1);
	print "<div align=center><b>Hits Genes: ".$hits." genes, page $page</b></div>\n";
	print "<div align=center>\n";
	print "<table border=1 width=100%>\n";
	print_gene_table_head();
	for($i=0;$i<$n;$i++){
		$row1=mysql_fetch_array($result1,MYSQL_ASSOC);
		if($i%2==0)$bgcolor="#FFFFFF";
		else $bgcolor="#EFEFEF";
		print_gene($row1,$bgcolor);
	}
	print "</table>\n";
	print "</div>\n";
}


function display_species($start){
	if(strlen($start)==0){
		$sql="SELECT * FROM Species";
	}else{
		$sql="SELECT * FROM Species WHERE LEFT(name,1)='$start'";
	}
	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
	$n=mysql_num_rows($result);
	print "<a href=displayspecies.php>All</a>&nbsp;";
	for($i=ord('A');$i<=ord('Z');$i++){
		$s=chr($i);
		print "<a href=displayspecies.php?start=$s>$s</a>&nbsp;";
	}
	print "<br>";
	print "<br>";
	for($i=0;$i<$n;$i++){
		$row=mysql_fetch_array($result); 
		$id=$row['id'];
		$name=$row['name'];
	}
}

function query_species($start){
    $start=mysql_real_escape_string($start);
	if(strlen($start)==0){
		$sql="SELECT * FROM Species";
	}else{
		$sql="SELECT * FROM Species WHERE LEFT(name,1)='$start'";
	}
	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
	$n=mysql_num_rows($result);
    //$species = array();

	for($i=0;$i<$n;$i++){

		$row=mysql_fetch_array($result); 

        $species[] = $row;
    }


    return $species;
}




function query_NC($species_id){

    $species_id = mysql_real_escape_string($species_id);
    $sql = "SELECT id, NC_id, species_id, NC_type, description, protein_gene_number, rna_gene_number, operon_number FROM NC WHERE species_id=$species_id";

	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
	$n=mysql_num_rows($result);
    $nc = array();
	for($i=0;$i<$n;$i++){
		$row=mysql_fetch_array($result); 
        $nc[] = $row;
    }
    return $nc;
}


function displayOperons($sql,$format,$page,$checkbox,$action_program,$submitbuttons){
        $pagesize=$_SESSION['pagesize'];
        if($pagesize<=0){
                $pagesize=30;
        }
	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
	$total=mysql_num_rows($result);
#page<=0, display everything
	if($page>0){
		$offset=($page-1)*$pagesize;
		$sql="$sql LIMIT $offset,$pagesize";
	}
	$result=mysql_query($sql);
	$n=mysql_num_rows($result);
#format==1, display summary version, information only in Operon table
	if($format==1){
		if($checkbox==1){
			print "<form name=\"operonListForm\" id=\"operonListForm\"  method=\"post\" action=\"$action_program\" enctype=\"multipart/form-data\">";
			$headitems=array("All<input name=\"operonListAll\" type=\"checkbox\" id=\"operonListAll\" value=\"operonListAll\" onClick={operonListAllClicked();}>");
			$width=array("5%","10%","10%","10%","10%","10%","45%");
			$align=array("center","center","center","center","center","center","left");
		}else{
			$headitems=array();
			$width=array("10%","10%","10%","10%","10%","50%");
			$align=array("center","center","center","center","center","left");
		}
		array_push($headitems,"Operon ID","Size","Protein Coding Gene","RNA Coding Gene","Similar Operons","Species");
		print "<div align=center><table width=100% border=1>";
		print_table_head($headitems,$width,$align);
		for($i=0;$i<$n;$i++){
			$row=mysql_fetch_array($result); 
			if($i%2==0)$bgcolor="#FFFFFF";
			else $bgcolor="#EFEFEF";
			print "<tr bgcolor=\"$bgcolor\">\n";
			if($checkbox==1){
				print "<td align=center><input type=checkbox name=operon".$row['operon_id']." value=".$row['operon_id']."></td>";
			}
			print "<td align=center>\n";
			print "<a href=operondetail.php?id=".$row['operon_id'].">".$row['operon_id']."</a>";
			print "</td>\n";
			print "<td align=center>\n";
			print $row['size'];
			print "</td>\n";
			print "<td align=center>\n";
			print $row['protein_gene_number'];
			print "</td>\n";
			print "<td align=center>\n";
			print $row['rna_gene_number'];
			print "</td>\n";
			print "<td align=center>\n";
			print "<a href=displaySimilarOperon.php?source=1&operon1_id=".$row['operon_id'].">".$row['similar_operon_number']."</a>";
			print "</td>\n";
			print "<td align=left>\n";
			print "<a href=displayNC.php?id=".$row['species_id'].">".$row['species_name']."</a>";
			print "</td>\n";
		}
		print "</table></div>";
		if($checkbox==1){
			print "<div align=center>".$submitbuttons."</div>";
			print "</form>";
		}
	}
}

//function query_NC_operon($nc_id){
//
//
//	$sql="SELECT id,NC_id,description,operon_number FROM NC WHERE NC_id=$ncid";
//
//	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
//	$row=mysql_fetch_array($result);
//
//	$NC_name=$row['NC_id'];
//	$NC_description=$row['description'];
//
//	$total=$row['operon_number'];
//
//	$sql="SELECT * FROM Operon WHERE NC_id=$id ORDER BY id LIMIT $offset,$pagesize";
//	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
//	$n=mysql_num_rows($result);
//}


function display_NC_operon($id,$page){
        $pagesize=$_SESSION['pagesize'];
        if($pagesize<=0){
                $pagesize=30;
        }

	$sql="SELECT id,NC_id,description,operon_number FROM NC WHERE id=$id";
#	print $sql;
	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
	$row=mysql_fetch_array($result);
	$NC_name=$row['NC_id'];
	$NC_description=$row['description'];
	$total=$row['operon_number'];
	$offset=($page-1)*$pagesize;
	$sql="SELECT * FROM Operon WHERE NC_id=$id ORDER BY id LIMIT $offset,$pagesize";
	$result=mysql_query($sql) or die("Invalid query: ".mysql_error());
	$n=mysql_num_rows($result);
	print "<form id=\"operonListForm\" name=\"operonListForm\" method=\"post\" action=\"addToSelectedOperon.php\">";
	print "<div align=center><b>Operons in $NC_name, $NC_description, $total operons, page $page</b></div>\n";
	print "<div align=center><table border=1 width=100%>\n";	
	print_operon_table_head();
	for($i=0;$i<$n;$i++){
		$row=mysql_fetch_array($result); 
		if($i%2==0)$bgcolor="#FFFFFF";
		else $bgcolor="#EFEFEF";
		print_operon($row,$bgcolor);
	}
	print "</table></div>";
}

function genPassword($length){
        $letters = array('1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $pass='';
        $l=count($letters);
        for($i=0;$i<$length;$i++){
                $n=rand(0,getrandmax());
                $j=$n%$l;
                $pass=$pass.$letters[$j];
        }
        return $pass;
}

function displayGenes($sql,$format){
	$result=mysql_query($sql) or die("mysql error $sql,".mysql_error());
	$n=mysql_num_rows($result);
	print "<table width=100% border=1>";
	if($format==1){  #brief summary
		$headitems=array("Gene ID","GI","Start","End","COG");
		$width=array("20%","20%","20%","20%","20%");
		$align=array("Center","Center","Center","Center","Center");
		print_table_head($headitems,$width,$align);
		for($i=0;$i<$n;$i++){
			$row=mysql_fetch_array($result,MYSQL_ASSOC);
			print "<tr>";
			print "<td align=center><a href=genedetail.php?id=".$row['gene_id'].">".$row['gene_id']."</a></td>";
			print "<td align=center>".$row['gi']."&nbsp;</td>";
			print "<td align=center>".$row['start']."&nbsp;</td>";
			print "<td align=center>".$row['end']."&nbsp;</td>";
			print "<td align=center>";
			displayCOG($row['COG_number']);
			print "</td>";
			print "</tr>\n";
		}
	}
	print "</table>";
}

function displayCOG($COG_text){
	$items=explode(',',$COG_text);
	foreach($items as $COG_value){
		if(strlen($COG_value)>1){
			print "<a href=http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?$COG_value>";
			print $COG_value;
			print "</a><br>";
		}else{
			print "&nbsp;";
		}
	}
}

function getGIFromID($id){
	$sql="SELECT gi FROM Gene WHERE id=$id";
	$result=mysql_query($sql);
	$n=mysql_num_rows($result);
	if($n!=1){
		print "Error: gene $id not exists.<br>\n";
	}
	$row=mysql_fetch_array($result);
	return $row['gi'];
}

function displayGenePairs($sql,$format,$matches){
	$result=mysql_query($sql) or die("mysql error $sql,".mysql_error());
	$n=mysql_num_rows($result);
	print "<table width=100% border=1>";
	if($format==1){  #two gene ID,gi and log(evalue)
		$headitems=array("Gene1 ID","Gene1 GI","Gene2 ID","Gene2 GI","log(e_value)","Bit Score");
		$width=array("20%","20%","20%","20%","10%","10%");
		$align=array("Center","Center","Center","Center","Center","center");
		print_table_head($headitems,$width,$align);
		for($i=0;$i<$n;$i++){
			$row=mysql_fetch_array($result,MYSQL_ASSOC);
			if($matches[$row['gene1_id']]==$row['gene2_id']){
				print "<tr bgcolor=red>";
			}else{
				print "<tr>";
			}
			print "<td align=center><a href=genedetail.php?id=".$row['gene1_id'].">".$row['gene1_id']."</a></td>";
			if(isset($row['gene1_gi'])){
				$gene1_gi=$row['gene1_gi'];
			}else{
				$gene1_gi=getGIFromID($row['gene1_id']);
			}
			print "<td align=center>".$gene1_gi."</td>";
			print "<td align=center><a href=genedetail.php?id=".$row['gene2_id'].">".$row['gene2_id']."</a></td>";
			if(isset($row['gene2_gi'])){
				$gene2_gi=$row['gene2_gi'];
			}else{
				$gene2_gi=getGIFromID($row['gene2_id']);
			}
			print "<td align=center>".$gene2_gi."</td>";
			print "<td align=center>";
			printf("%10.2f",$row['log_evalue']);
			print "&nbsp;</td>";
			print "<td align=center>";
			printf("%10.2f",$row['bit_score']);
			print "&nbsp;</td>";
			print "</tr>\n";
		}
	}
	print "</table>";
	
}


function imagelinethick($image, $x1, $y1, $x2, $y2, $color, $thick = 1)
{
    /* this way it works well only for orthogonal lines
    imagesetthickness($image, $thick);
    return imageline($image, $x1, $y1, $x2, $y2, $color);
    */
    if ($thick == 1) {
        return imageline($image, $x1, $y1, $x2, $y2, $color);
    }
    $t = $thick / 2 - 0.5;
    if ($x1 == $x2 || $y1 == $y2) {
        return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
    }
    $k = ($y2 - $y1) / ($x2 - $x1); //y = kx + q
    $a = $t / sqrt(1 + pow($k, 2));
    $points = array(
        round($x1 - (1+$k)*$a), round($y1 + (1-$k)*$a),
        round($x1 - (1-$k)*$a), round($y1 - (1+$k)*$a),
        round($x2 + (1+$k)*$a), round($y2 - (1-$k)*$a),
        round($x2 + (1-$k)*$a), round($y2 + (1+$k)*$a),
    );
    imagefilledpolygon($image, $points, 4, $color);
    return imagepolygon($image, $points, 4, $color);
}

?>
