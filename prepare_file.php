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
   
  
?>
