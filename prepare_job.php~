<?php
 


//this must be before any printing is being done, inside or outside of the php tags.
header("Cache-control: private");
require("config/common.php");
require("config/smarty.php");
require("config/tools.php");
require("lib/runtimelib.php");

$allfile=$_POST['allfile'];
$selectfile=$_POST['selectfile'];
$tags=$_POST['tags'];


$email=$_POST['email'];
	if($email==""){
           $email="xjzhhy@126.com";
                      }


$species=$_POST['species'];
$species2=$_POST['species2'];
$flag=0;

if(strlen($allfile[0])==0){
	print "<div align=center><b>Please specify the <font color=red>input file</font>.</b></div>";
         
	$flag=1;
}


if($flag==1){
	exit;
} 
else {
	$info = array(allfile=>serialize($allfile),tags=>serialize($tags),selectfile=>serialize($selectfile),status => "pending", email => $email,species=>$species,species2=>$species2);
	



       
       $jobid = date("YmdGis")."r";
       $workdir ="$BASE/data/$jobid";
       $info['workdir']=$workdir;
       $info['jobid']=$jobid;
       $info['BASE']=$BASE;
       
       $workdir= prepare_job($workdir,$info);



	system("echo '#!/bin/bash\ncd $BASE\n/usr/bin/php $TOOLPATH/runtime.php -r -e -w $workdir' > $workdir/cmd.sh");
	system("chmod 777 $workdir/cmd.sh ");
        $output = shell_exec("sh $TOOLPATH/qsub.sh $BASE $workdir 1>$workdir/logsub1 2>$workdir/logsub2");
  

}
$url="prediction_exogenous.php?jobid=$jobid";
echo $url;

?>
