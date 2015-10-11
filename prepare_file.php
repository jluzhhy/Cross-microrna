<?php

//this must be before any printing is being done, inside or outside of the php tags.
header("Cache-control: private");
require("config/common.php");
require("config/smarty.php");
require("config/tools.php");
require("lib/runtimelib.php");

$data=$_POST['data'];

$filename=$_POST['filename'];
 $workdir ="$BASE/upload/";
 $fp = fopen("$workdir/$filename", 'a');
     fwrite($fp, $data); fclose($fp);


$fstring=0;
if(file_exists("$workdir/$filename"."log"))
{$fd = fopen ("$workdir/$filename"."log" , "r");
$size= filesize ("$workdir/$filename"."log" );

$fstring = fread ($fd ,$size) ;

fclose($fd);
}

$fd = fopen ("$workdir/$filename"."log" , "w") or die ("Can't open $filename") ;
$fcounted = $fstring + 1 ;
$fout= fwrite ($fd , $fcounted ) ;
fclose($fd) ;
print $fcounted;
?>
