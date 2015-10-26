<?php

require_once("lib/spyc.php");
require("config/common.php");
require("config/tools.php");

function prepare_job($workdir,$info)
{    $BASE=$info['BASE'];
     mkdir($workdir);
    

     
     $fp = fopen("$workdir/info.yaml", 'w');
     fwrite($fp, Spyc::YAMLDump($info));
     fclose($fp);

     system("chmod 777 -R $workdir");
     return $workdir;
}
function run_micro($workdir)
{  $info = Spyc::YAMLLoad("$workdir/info.yaml");
       $jobid= basename("$workdir");
       $BASE=$info['BASE'];
       $species=$info['species'];
       $species2=$info['species2'];
    $allfile=unserialize($info['allfile']); 
    $tags=unserialize($info['tags']); 
    $selectfile=unserialize($info['selectfile']); 

$hash=array();
$total=array();
$i=0;
$key=1;
foreach ($allfile as $aa)
{  
  
   if(file_exists("$BASE/upload/$aa"))
     {  
        
       
       
        $fp = fopen("$BASE/upload/$aa", 'r');

	             while(!feof($fp)) {
                                        
		                   $line=chop(fgets($fp));
                                         
                                    if(preg_match("/\>seq/",$line))
                                           {
                                               $ss=explode("_x",$line);
                                               $seq=chop(fgets($fp));
                                              
                                               $hash{$tags{"$i"}}{$seq}=$ss[1]+0;
                                                         $total{$seq}{'name'}="seq_".$key."_len_".strlen($seq);
                                                         $total{$seq}{'count'}=0;
                                                                        $key++;
                                                             
                                                            
                                                    
                                                    
                                                        
                                                  
                                                    
                                                   

                                           }
                               }
 
     }
 $i++;
}


$fd = fopen ("$workdir/totalreads.fa" , "w") or die ("Can't open $filename") ;
foreach ($total as $key => $value)
{
 
    $fout= fwrite ($fd ,  ">".$total{$key}{'name'}."\n") ;
    $fout= fwrite ($fd ,  $key."\n") ;
}
fclose($fd);
$fd = fopen ("$workdir/allcounts" , "w") or die ("Can't open $filename") ;
 $fout= fwrite ($fd ,"X\t");

foreach ($tags as $key => $value)
{
    $fout= fwrite ($fd ,  $tags{$key}."\t") ;
}
 $fout= fwrite ($fd ,"All\n");
 foreach ($total as $key2 => $value2)
    {  $fout= fwrite ($fd,$total{$key2}{'name'}."\t"); 
     
        foreach ($tags as $key => $value)
        {
            
             if($hash{$value}{$key2})
              {
                $fout= fwrite ($fd ,  $hash{$value}{$key2}."\t") ;
                $total{$key2}{'count'}=$total{$key2}{'count'}+$hash{$value}{$key2};
              }
             else
              {
                $fout= fwrite ($fd ,  "0\t") ;
              }
            
          }
        $fout= fwrite ($fd ,  $total{$key2}{'count'}) ;
      $fout= fwrite ($fd ,"\n");
   }
fclose($fd);
       system("cd $workdir\n\n$BASE/tools/run.pl -i $workdir/*.fq -o $workdir -a $species2 -s $species");
}  

?>
