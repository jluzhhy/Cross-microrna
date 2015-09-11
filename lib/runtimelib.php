<?php
require_once("lib/spyc.php4");
require("config/common.php");
require("config/tools.php");

function prepare_prediction($workdir,$info)
{  $BASE=$info['BASE'];
    mkdir($workdir);
    $nc=$workdir."/";
      $tempfnaname = $nc.$info['jobid'];
     $fp = fopen($tempfnaname."tg", 'w');
     fwrite($fp, $info['input']); fclose($fp);
     unset($info["input"]);
      if(preg_match("/Jobid:\d*$/",$info['bkgname']))
        {
        $arr=explode(":", $info['bkgname']);
           $jobid=chop($arr[3]);
           $tempnam ="$BASE/data/annotation/$jobid/$jobid";	
           $fa = fopen("$tempfnaname"."bkg", 'w');
          fwrite($fa, "".file_get_contents($tempnam)); 
          fclose($fa);
           unset($info["bkgname"]);
        
       }
       else
       {
        $fp = fopen("$tempfnaname"."bkg", 'w');
     fwrite($fp, $info['bkgname']); fclose($fp);
     unset($info["bkgname"]);
     }
    
     
     $fp = fopen("$workdir/info.yaml", 'w');
     fwrite($fp, Spyc::YAMLDump($info));
     fclose($fp);
      system("chmod 777 -R $workdir");
     return $workdir;
}



function annotate_prediction($workdir) 
{  
	 $info = Spyc::YAMLLoad("$workdir/info.yaml");
	    
       $jobid= basename("$workdir");
        $BASE =$info['BASE'];
          $min=$info['minin'];
           $max=$info['maxin'];
           $num=$info['numout'];
           if(intval($num)>80)
           {
            $num=80;
           }
           $ty=$info['style'];
             $bf=$info['bf'];
             $bn=$info['bn'];
           $st=$info['st'];
            $sn=$info['sn'];
    $tempnam ="$BASE/data/annotation/$jobid/$jobid";
    $work="$BASE/data/annotation/$jobid/";
$check=file_get_contents($tempnam."tg");
 if(intval($info['big'])==1)	
  {
  
   $chars=explode(">",$check);
   $pnum=count($chars);
  
    if ($pnum>400)
  {        $num=1;
   for($j=1;$j<=10;$j++)
   { $result="";
       $mmend=$pnum/10;
       if($mmend>50) $mmend=50;
      for($i=1;$i<=$mmend;$i++)
      {
       $rs=rand(0,$pnum-1);
        $result=$result.">";
        $result=$result.$chars[$rs];
  
      }
      // print("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!".$result);
      $fp = fopen($tempnam."$j", 'w');
     fwrite($fp, $result);
     fclose($fp);
      
   }
  }
  
}else
{
   $fp = fopen($tempnam."1", 'w');
     fwrite($fp, $check);
     fclose($fp);
     touch($tempnam."2");
     touch($tempnam."3");
     touch($tempnam."4");
     touch($tempnam."5");
       touch($tempnam."6");
     touch($tempnam."7");
     touch($tempnam."8");
     touch($tempnam."9");
      touch($tempnam."10");
}
   unset($check);
   unset($result);   
          $Rint=2;   
         if($num>10)
         {
            $bn=$num/2;
         }
         if((($max-$min+1)/2)>4)
         {    $Rint= ceil(($max-$min+1)/4);
         
         }
      if($bf=="Y")
       	     {$option="-L ".$min." -U ".$max." -o ".$num." -R $Rint -F -n $bn $sn $st";}
       	else
       	     {$option="-L ".$min." -U ".$max." -o ".$num." -R $Rint -n $bn $sn $st";}
          $ert=file_get_contents($tempnam."bkg")."asd";
       $asd=strlen($ert);
       if($asd<10)
     	 {	$cmd="#!/usr/bin/env sh\ncd $work\n  perl $BASE/program/BBR.pl 1 $jobid $option >$work/report";}
     	 else 
     	 {	$cmd="#!/usr/bin/env sh\ncd $work\n  perl $BASE/program/BBR.pl 2 $jobid ".$jobid."bkg $option > $work/report"; }
        
	     system($cmd);
       system("chmod 777 -R $work");
 if(file_exists($tempnam.".motifinfo"))
{ 
system("$BASE/lib/zx.pl $tempnam.motifinfo"); 
system("$BASE/lib/zx2.pl $tempnam $jobid $BASE");                       

} 
}

function prepare_scan($workdir,$info)
{  $res="DONE!";
    mkdir($workdir);
     system("chmod 777 -R $workdir");
    $nc=$workdir."/";
     $tempfnaname = $nc.$info['jobid'];
         $info['fnaname']=preg_replace("/[ \r\t\f]+/","\t",$info['fnaname']);
         if(!preg_match("/>end/",$info['fnaname']) && $info['style']!='3')
         {$info['fnaname']=$info['fnaname']."\n>end";
         }
     
     $fp = fopen("$tempfnaname"."temp", 'w');
     fwrite($fp, $info['fnaname']); fclose($fp);
     unset($info["fnaname"]);
      $fp = fopen("$tempfnaname"."temp", 'r');
      $fh = fopen("$tempfnaname", 'w');
        $tt=0;
	     while(!feof($fp))
       {
         
          $line=fgets($fp);
          if(preg_match("/\>/",$line))
          {
              $tt=0;
          }
          else{$tt++;}
           if($tt<100)
          {
            fwrite($fh,$line);
          }
       }
       fclose($fp);
         fclose($fh);
     $fp = fopen("$tempfnaname"."tg", 'w');
     fwrite($fp, $info['tgname']); fclose($fp);
     unset($info["tgname"]);
    
    $fp = fopen("$tempfnaname"."bkg", 'w');
     fwrite($fp, $info['bkgname']); fclose($fp);
     unset($info["bkgname"]);
     
     $BASE=$info['BASE'];
     $fp = fopen("$workdir/info.yaml", 'w');
     fwrite($fp, Spyc::YAMLDump($info));
     fclose($fp);
     system("chmod 777 -R $workdir");
     return $workdir;
}



function annotate_scan($workdir) 
{  
	 $info = Spyc::YAMLLoad("$workdir/info.yaml");
	    
       $jobid= basename("$workdir");
         $BASE=$info['BASE'];
          $tp=$info['tp'];
           $mp=$info['mp'];
           $ty=$info['style'];
            $bkg=$info['fast'];
    $tempnam ="$BASE/data/annotation/$jobid/$jobid";
    $work="$BASE/data/annotation/$jobid/";	
    $option="";
      if($tp!="")
    { $option=$option+" -t $tp";
      $option=$option+" $tp";
     }
     if($mp!="")
    {
      $option=$option+" -M $mp";
     }
    if($bkg=="true"){ $cmd="#!/usr/bin/env sh\ncd $work\n  perl $BASE/program/BBS.pl true $jobid ".$jobid."tg $ty ".$jobid."bkg $option >$work/report";}
    else 
    { $cmd="#!/usr/bin/env sh\ncd $work\n  perl $BASE/program/BBS.pl no $jobid ".$jobid."tg $ty $option >$work/report";}
       
      
	     system("sh $cmd");
       
   
       $tempnam ="$BASE/data/annotation/$jobid/$jobid";
if(file_exists($tempnam)&&file_get_contents($tempnam)!="" && intval($ty)==1)
{ $scr="#!/usr/bin/env sh\ncd $BASE/data/annotation/$jobid\n"; 
 $i=0;$z=0;$k=0;$name="";
$fp = fopen($tempnam, 'r');
	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
  	     	if(preg_match("/^>/", $line))
  	     	{	
  	     		
  	     		$z++;
  	     		if($z==2)
  	     		   {$z=1;
  	     		   	$k=0;
  	     		   	fclose($fa);
                  fwrite($fm,">end\n");
                 fclose($fm);
                  fwrite($fc,">end\n");
                 fclose($fc);
  	     		   	$k=0;
  	     		   	} 
            if($z==1)
            {   $arr=explode(">",$line);
            
            $name=chop($arr[1]);
  	     		$i++;
  	     		$fa= fopen ($tempnam."$name", 'w');
            $fm= fopen ("$work/$name", 'w');
            $fc= fopen ("$work/!$name", 'w');
            fwrite($fm,">$name\n");
            fwrite($fc,">$name\n");
            $scr=$scr."perl $BASE/program/script/weblogo/seqlogo -F PNG -a -n -Y -k 1 -c  -f ".$tempnam.$name." > ".$tempnam.$name.".png\n";
            }
  	     	}
  	        
  	     		 if($z==1 && !preg_match("/^>/", $line)&& $line!="")
  	     		 {$k++;
  	     		 	fwrite($fa,">$k\n");
  	     		fwrite($fa,$line);
            fwrite($fm,$line);
              fwrite($fc,$line);
  	     		 	
  	     		 }
  	     }
    fclose($fp);
  
    
 $fp = fopen("$BASE/data/annotation/$jobid/weblogo.sh", 'w');
     fwrite($fp, $scr);
     fclose($fp);
 } 
if(file_exists($tempnam)&&(intval($ty)==2))
{ $scr="#!/usr/bin/env sh\ncd $BASE/data/annotation/$jobid\n";  
 $i=0;$z=0;$k=0;$name="";
 $arrA=array();
 $arrG=array();
 $arrC=array();
 $arrT=array();
$fp = fopen($tempnam, 'r');
	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
         
  	     	if(preg_match("/^>/", $line))
  	     	{ 	  
           $arr=explode(">",$line);
              $name=chop($arr[1]);
              $fa= fopen($tempnam."$name", 'w');
              $fm= fopen ("$work/$name", 'w');
               fwrite($fm,">$name\n");
              $fc= fopen ("$work/!$name", 'w');
               fwrite($fc,">$name\n");
  	          $line=fgets($fp);
             
                 fwrite($fc,$line);
              $arrA=explode("\t",$line);
              $line=fgets($fp);
                 fwrite($fc,$line);
              $arrG=explode("\t",$line);
              $line=fgets($fp);
             fwrite($fc,$line);
              $arrC=explode("\t",$line);
              $line=fgets($fp);
             fwrite($fc,$line);
              $arrT=explode("\t",$line);
                  $sum=100;
                  $logo=array();
                  for($i=0;$i<$sum;$i++)
                  {   $logo[$i]="";
                  }
              for($i=1;$i<count($arrA);$i++)
              {   $sum=intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i])+intval($arrT[$i]);
                  for($j=0;$j<ceil(intval($arrA[$i])/$sum*100);$j++)
                  {$logo[$j]=$logo[$j]."A";
                  }
                  for($j=ceil(intval($arrA[$i])/$sum*100);$j<ceil((intval($arrA[$i])+intval($arrG[$i]))/$sum*100);$j++)
                  {$logo[$j]=$logo[$j]."G";
                  }
                 for($j=ceil((intval($arrA[$i])+intval($arrG[$i]))/$sum*100);$j<ceil((intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]))/$sum*100);$j++)
                  {$logo[$j]=$logo[$j]."C";
                  }
                  for($j=ceil((intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]))/$sum*100);$j<100;$j++)
                  {$logo[$j]=$logo[$j]."T";
                  }
              }
               for($j=0;$j<100;$j++)
                {    fwrite($fa,">$j\n");
                fwrite($fa,$logo[$j]."\n");
                       fwrite($fm,$logo[$j]."\n");
                
                }
              fclose($fa);
              fwrite($fm,">end\n");
                 fclose($fm);
                   fwrite($fc,">end\n");
                 fclose($fc);
               $scr=$scr."perl $BASE/program/script/weblogo/seqlogo -F PNG -a -n -Y -k 1 -c  -f ".$tempnam.$name." > ".$tempnam.$name.".png\n";
              
  	     	}
  	     }
    fclose($fp);
    
  $fp = fopen("$BASE/data/annotation/$jobid/weblogo.sh", 'w');
     fwrite($fp, $scr);
     fclose($fp); 
	}		 
 if(file_exists($tempnam."_matrix")&&(intval($ty)==3))
{ 
$i=0;$z=0;$k=0;$name="";
$fp = fopen($tempnam, 'r');
	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
  	     	if(preg_match("/^>/", $line))
  	     	{	
  	     		
  	     		$z++;
  	     		if($z==2)
  	     		   {$z=1;
  	     		   	$k=0;
  	     
        
                  fwrite($fc,">end\n");
                 fclose($fc);
  	     		   	$k=0;
  	     		   	} 
            if($z==1)
            {   $arr=explode(">",$line);
            
            $name=chop($arr[1]);
  	     		$i++;
  
   
            $fc= fopen ("$work/!$name", 'w');
     
            fwrite($fc,">$name\n");
            }
  	     	}
  	        
  	     		 if($z==1 && !preg_match("/^>/", $line)&& $line!="")
  	     		 {$k++;
  	
              fwrite($fc,$line);
  	     		 	
  	     		 }
  	     }
    fclose($fp);







$scr="#!/usr/bin/env sh\ncd $BASE/data/annotation/$jobid\n";  
 $i=0;$z=0;$k=0;$name="";
 $arrA=array();
 $arrG=array();
 $arrC=array();
 $arrT=array();
$fp = fopen($tempnam."_matrix", 'r');
	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
         
  	     	if(preg_match("/^>/", $line))
  	     	{ 	  
           $arr=explode(">",$line);
              $name=chop($arr[1]);
              $fa= fopen($tempnam."$name", 'w');
               $fm= fopen ("$work/$name", 'w');
                fwrite($fm,">$name\n");
               $fc= fopen ("$work/\!$name", 'w');
               fwrite($fc,">$name\n");
  	          $line=fgets($fp);
              $arrA=explode("\t",$line);
              $line=fgets($fp);
              $arrG=explode("\t",$line);
              $line=fgets($fp);
              $arrC=explode("\t",$line);
              $line=fgets($fp);
              $arrT=explode("\t",$line);
                  $sum=intval($arrA[1])+intval($arrG[1])+intval($arrC[1])+intval($arrT[1]);
                  $logo=array();
                  for($i=0;$i<$sum;$i++)
                  {   $logo[$i]="";
                  }
              for($i=1;$i<count($arrA);$i++)
              {   
                  for($j=0;$j<intval($arrA[$i]);$j++)
                  {$logo[$j]=$logo[$j]."A";
                  }
                  for($j=intval($arrA[$i]);$j<(intval($arrA[$i])+intval($arrG[$i]));$j++)
                  {$logo[$j]=$logo[$j]."G";
                  }
                 for($j=(intval($arrA[$i])+intval($arrG[$i]));$j<(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]));$j++)
                  {$logo[$j]=$logo[$j]."C";
                  }
                  for($j=(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]));$j<(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i])+intval($arrT[$i]));$j++)
                  {$logo[$j]=$logo[$j]."T";
                  }
              }
               for($j=0;$j<$sum;$j++)
                {    fwrite($fa,">$j\n");
                fwrite($fa,$logo[$j]."\n");
                       fwrite($fm,$logo[$j]."\n");
                       fwrite($fc,$logo[$j]."\n");
                
                }
              fclose($fa);
                 fwrite($fm,">end\n");
                 fclose($fm);
                 fwrite($fc,">end\n");
                 fclose($fc);
                   $scr=$scr."perl $BASE/program/script/weblogo/seqlogo -F PNG -a -n -Y -k 1 -c  -f ".$tempnam.$name." > ".$tempnam.$name.".png\n";
              
  	     	}
  	     }
    fclose($fp);
    
  $fp = fopen("$BASE/data/annotation/$jobid/weblogo.sh", 'w');
     fwrite($fp, $scr);
     fclose($fp); 
	}		 


    system("sh $BASE/data/annotation/$jobid/weblogo.sh > $BASE/data/annotation/$jobid/err.log");

     
}

function prepare_compare($workdir,$info)
{  $res="DONE!";
    mkdir($workdir."");
        
    $nc=$workdir."/";
       $jobid= basename("$workdir");
        touch($nc."log");
        system("chmod 777 $nc"."log");
     $tempfnaname = $nc.$jobid;
     $fp = fopen("$tempfnaname"."tg", 'w');
     fwrite($fp, $info['tg']); fclose($fp);
     unset($info["tg"]);
      $info['mt']=preg_replace("/[ \r\t\f]+/","\t",$info['mt']);
        if(!preg_match("/>end/",$info['mt']) && $info['style']!='3')
         {$info['mt']=$info['mt']."\n>end";
         }
     $fp = fopen("$tempfnaname"."in", 'w');
     fwrite($fp, $info['mt']); fclose($fp);
     unset($info["mt"]);
           $fp = fopen("$tempfnaname"."in", 'r');
      $fh = fopen("$tempfnaname"."mt", 'w');
        $tt=0;
	     while(!feof($fp))
       {
         
          $line=fgets($fp);
          if(preg_match("/\>/",$line))
          {
              $tt=0;
          }
          else{$tt++;}
           if($tt<100)
          {
            fwrite($fh,$line);
          }
       }
       fclose($fp);
         fclose($fh);
  
     $fp = fopen("$workdir/info.yaml", 'w');
     fwrite($fp, Spyc::YAMLDump($info));
     fclose($fp);
         system("chmod 777 -R $workdir");
     return $workdir;
}


function annotate_compare($workdir) 
{  
	 $info = Spyc::YAMLLoad("$workdir/info.yaml");
	    
        $jobid= basename("$workdir");
         $BASE=$info['BASE'];
          $t1=$info['t1'];
           $t2=$info['t2'];
          $sy=$info['style'];
          $ori=$info['ori'];
          $tempnam ="$BASE/data/annotation/$jobid/$jobid"; 
if(intval($sy)==2)
{    
 $i=0;$z=0;$k=0;$name="";
 $arrA=array();
 $arrG=array();
 $arrC=array();
 $arrT=array();
$fp = fopen($tempnam."in", 'r');
$fm= fopen($tempnam."mt", 'w');	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
         
  	     	if(preg_match("/^>/", $line)&&!preg_match("/^>end/", $line))
  	     	{ 	  
           $arr=explode(">",$line);
              $name=chop($arr[1]);       
               fwrite($fm,">$name\n");
  	          $line=fgets($fp);
              $arrA=explode("\t",$line);
              $line=fgets($fp);
              $arrG=explode("\t",$line);
              $line=fgets($fp);
              $arrC=explode("\t",$line);
              $line=fgets($fp);
              $arrT=explode("\t",$line);
                  $sum=intval($arrA[1])+intval($arrG[1])+intval($arrC[1])+intval($arrT[1]);
                  $logo=array();
                  for($i=0;$i<$sum;$i++)
                  {   $logo[$i]="";
                  }
              for($i=1;$i<count($arrA);$i++)
              {   
                  for($j=0;$j<intval($arrA[$i]);$j++)
                  {$logo[$j]=$logo[$j]."A";
                  }
                  for($j=intval($arrA[$i]);$j<(intval($arrA[$i])+intval($arrG[$i]));$j++)
                  {$logo[$j]=$logo[$j]."G";
                  }
                 for($j=(intval($arrA[$i])+intval($arrG[$i]));$j<(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]));$j++)
                  {$logo[$j]=$logo[$j]."C";
                  }
                  for($j=(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]));$j<(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i])+intval($arrT[$i]));$j++)
                  {$logo[$j]=$logo[$j]."T";
                  }
              }
               for($j=0;$j<$sum;$j++)
                {   
                       fwrite($fm,$logo[$j]."\n");
                
                }
            
              
  	     	}
  	     }
                fwrite($fm,">end\n");
            fclose($fm);
    fclose($fp);
    
    
    }
     else if(intval($sy)==3)
     {
        	system ("$BASE/program/bin/BBS -p $tempnam"."in  > $tempnam"."mt1");
          
          $i=0;$z=0;$k=0;$name="";
 $arrA=array();
 $arrG=array();
 $arrC=array();
 $arrT=array();
$fp = fopen($tempnam."mt1", 'r');
$fm= fopen($tempnam."mt", 'w');	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
         
  	     	if(preg_match("/^>/", $line)&&!preg_match("/^>end/", $line))
  	     	{ 	  
           $arr=explode(">",$line);
              $name=chop($arr[1]);       
               fwrite($fm,">$name\n");
  	          $line=fgets($fp);
              $arrA=explode("\t",$line);
              $line=fgets($fp);
              $arrG=explode("\t",$line);
              $line=fgets($fp);
              $arrC=explode("\t",$line);
              $line=fgets($fp);
              $arrT=explode("\t",$line);
                  $sum=intval($arrA[1])+intval($arrG[1])+intval($arrC[1])+intval($arrT[1]);
                  $logo=array();
                  for($i=0;$i<$sum;$i++)
                  {   $logo[$i]="";
                  }
              for($i=1;$i<count($arrA);$i++)
              {   
                  for($j=0;$j<intval($arrA[$i]);$j++)
                  {$logo[$j]=$logo[$j]."A";
                  }
                  for($j=intval($arrA[$i]);$j<(intval($arrA[$i])+intval($arrG[$i]));$j++)
                  {$logo[$j]=$logo[$j]."G";
                  }
                 for($j=(intval($arrA[$i])+intval($arrG[$i]));$j<(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]));$j++)
                  {$logo[$j]=$logo[$j]."C";
                  }
                  for($j=(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i]));$j<(intval($arrA[$i])+intval($arrG[$i])+intval($arrC[$i])+intval($arrT[$i]));$j++)
                  {$logo[$j]=$logo[$j]."T";
                  }
              }
               for($j=0;$j<$sum;$j++)
                {   
                       fwrite($fm,$logo[$j]."\n");
                
                }
            
              
  	     	}
  	     }
                fwrite($fm,">end\n");
            fclose($fm);
    fclose($fp);
     
     }
    $option="";
      if($ori=='Y')
      {
      	if(intval($sy)==-2)
      	{$cmd="#!/usr/bin/env sh\ncd $workdir\n  perl $BASE/program/BBC.pl ".$jobid."tg 0 $sy $t1 $t2\nperl $BASE/data/getsimilarity.pl "."$workdir/$jobid"."tg.BBC/$jobid"."tg.similarity > $BASE/data/annotation/$jobid/similarity\n";}
      	else{
      		$cmd="#!/usr/bin/env sh\ncd $workdir\n  perl $BASE/program/BBC.pl ".$jobid."tg ".$jobid."mt $sy $t1 $t2\nperl $BASE/data/getsimilarity.pl "."$workdir/$jobid"."tg.BBC/$jobid"."tg.$jobid"."mt.similarity > $BASE/data/annotation/$jobid/similarity\n"; 
      		}
      	}
      else
      {$cmd="#!/usr/bin/env sh\ncd $workdir\n  perl $BASE/program/BBC.pl ".$jobid."tg ".$jobid."mt -1 $t1 $t2\nperl $BASE/data/getsimilarity.pl "."$workdir/$jobid"."tg.BBC/$jobid"."tg.$jobid"."mt.similarity > $BASE/data/annotation/$jobid/similarity\n";   }

       $fp = fopen("$BASE/data/annotation/$jobid/test", 'w');
     fwrite($fp, $cmd);
     fclose($fp);
	     system($cmd." 1>$workdir/log1 2>$workdir/log2"); 
       
      
if(file_exists($tempnam."tg.BBC/$jobid"."tg"))
{  $i=0;$z=0;$k=0;
     $scr="#!/usr/bin/env sh\ncd $BASE/data/annotation/$jobid\n";
	 $fp = fopen($tempnam."tg.BBC/$jobid"."tg", 'r');
	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
  	     	if(preg_match("/^>/", $line))
  	     	{	
  	     		
  	     		$z++;
  	     		if($z==2)
  	     		   {$z=1;
  	     		   	$k=0;
  	     		   	fclose($fa);
 
  	     		   	$k=0;
  	     		   	} 
            if($z==1)
            {
           $arr=explode(">",$line);
            
            $name=chop($arr[1]);
  	     		$i++;
  	     		$fa= fopen ("$BASE/data/annotation/$jobid/$name", 'w');
           $scr=$scr."perl $BASE/program/script/weblogo/seqlogo -F PNG -a -n -Y -k 1 -c  -f $BASE/data/annotation/$jobid/$name > $BASE/data/annotation/$jobid/$name".".png\n";
            }
  	     	}
  	        
  	     		 if($z==1 && !preg_match("/^>/", $line)&& $line!="")
  	     		 {$k++;
  	     		 	fwrite($fa,">$k\n");
  	     		fwrite($fa,$line);
  	     		 	
  	     		 }
  	     }
    fclose($fp);
 
      $fp = fopen("$BASE/data/annotation/$jobid/weblogo.sh", 'w');
     fwrite($fp, $scr);
     fclose($fp);
  system("sh $BASE/data/annotation/$jobid/weblogo.sh > $BASE/data/annotation/$jobid/err.log");
    
    
}

if(file_exists($tempnam."tg.BBC/$jobid"."tg.$jobid"."mt"))
{  $i=0;$z=0;$k=0;
$scr="#!/usr/bin/env sh\ncd $BASE/data/annotation/$jobid\n";
	 $fp = fopen($tempnam."tg.BBC/$jobid"."tg.$jobid"."mt", 'r');
	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
  	     	if(preg_match("/^>/", $line))
  	     	{	
  	     		
  	     		$z++;
  	     		if($z==2)
  	     		   {$z=1;
  	     		   	$k=0;
  	     		   	fclose($fa);
  	     		   	$k=0;
  	     		   	} 
            if($z==1)
            {
            $arr=explode(">",$line);
            
            $name=chop($arr[1]);
  	     		$i++;
  	     			$fa= fopen ("$BASE/data/annotation/$jobid/$name", 'w');
            $scr=$scr."perl $BASE/program/script/weblogo/seqlogo -F PNG -a -n -Y -k 1 -c  -f $BASE/data/annotation/$jobid/$name > $BASE/data/annotation/$jobid/$name".".png\n";
            }
  	     	}
  	        
  	     		 if($z==1 && !preg_match("/^>/", $line)&& $line!="")
  	     		 {$k++;
  	     		 	fwrite($fa,">$k\n");
  	     		fwrite($fa,$line);
  	     		 	
  	     		 }
  	     }
    fclose($fp);
       $fp = fopen("$BASE/data/annotation/$jobid/weblogo.sh", 'w');
     fwrite($fp, $scr);
     fclose($fp);
  system("sh $BASE/data/annotation/$jobid/weblogo.sh > $BASE/data/annotation/$jobid/err.log");
       
}   
}

function annotate_prediction_with_reference($workdir) 
{  
	 $info = Spyc::YAMLLoad("$workdir/info.yaml");
       $jobid= basename("$workdir");
         $BASE=$info['BASE'];
   $tempnam="$workdir/$jobid";
	     system("sh $tempnam"."cmd.sh 1> $tempnam"."log1 2> $tempnam"."log2");
      	
if(file_exists("$BASE/data/annotation/$jobid/output/motif.alignment"))
{  $i=0;$z=0;$k=0;
$fp = fopen("$BASE/data/annotation/$jobid/output/motif.alignment", 'r');
	
  	   while(!feof($fp))
  	     {    $line=fgets($fp);
  	     	if(preg_match("/^>/", $line))
  	     	{	
  	     		
  	     		$z++;
  	     		if($z==2)
  	     		   {$z=1;
  	     		   	$k=0;
                fwrite($fa,">end\n");
  	     		   	fclose($fa);
  	     		   	$k=0;
  	     		   	} 
            if($z==1)
            {
              $arr=explode(">",$line);
            $name=chop($arr[1]);
  	     		$i++;
  	     		$fa= fopen ("$BASE/data/annotation/$jobid/output/$name", 'w');
            	fwrite($fa,">$name\n");
            }
  	     	}
  	        
  	     		 if($z==1 && !preg_match("/^>/", $line)&& $line!="")
  	     		 {
  	     		 
  	     		fwrite($fa,$line);
  	     		 	
  	     		 }
  	     }
    fclose($fp);
}
     
}

function annotate_mp3($jobdir) 
{   
 $info = Spyc::YAMLLoad("$jobdir/info.yaml");
       $jobid= basename("$jobdir");
        $workdir=$info['BASE']."/MP3-DMINDA2"; 
        system("echo '#!/bin/bash\n#$ -l arch=glinux\n#\$ -S /bin/bash\n\ncd $workdir\nperl MP3.pl $jobdir/$jobid"."tg"." $jobdir' > $jobdir/cmd2.sh");
	      system("sh $jobdir/cmd2.sh ");

}
function annotate_regulon($jobdir) 
{  
 $info = Spyc::YAMLLoad("$jobdir/info.yaml");
 
       $jobid= basename("$jobdir");
        $workdir=$info['BASE']; 
              
        system("echo '#!/bin/bash\n#$ -l arch=glinux\n#\$ -S /bin/bash\n\nperl $workdir/regulon.pl $jobdir $jobid' > $jobdir/cmd2.sh");
	      system("sh $jobdir/cmd2.sh ");

}
 
?>
