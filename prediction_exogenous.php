<?php
// include "head.html";

require("config/common.php");
require("config/smarty.php");
require_once("lib/spyc.php4");
$jobid=$_GET['jobid'];
$tempnam ="$DATAPATH/$jobid";	


$status="";
$info = Spyc::YAMLLoad("$DATAPATH/$jobid/info.yaml");
$status=$info['status'];

if(file_exists("$DATAPATH/$jobid/result"))
{

   $content=file_get_contents("$DATAPATH/$jobid/result");

}
$smarty->assign('status',$status);
$smarty->assign('content',$content);
$smarty->display('prediction_exogenous.tpl');
?> 
