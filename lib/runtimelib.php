<?php

require_once("lib/spyc.php");
require("config/common.php");
require("config/tools.php");

function prepare_job($workdir,$info)
{    $BASE=$info['BASE'];
     mkdir($workdir);
     $tempfnaname = $workdir."/".$info['jobid'];
     $fp = fopen($tempfnaname."", 'w');
     fwrite($fp, $info['seqdata']); fclose($fp);
     unset($info["seqdata"]);

     
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
       $tempnam="$workdir/$jobid";
       #tar xzvf ".$tempnam.".tar.gz
       system("cd $workdir\n\n$BASE/tools/run.pl -i $workdir/*.fq -o $workdir -a $species2 -s $species");
     }

?>
