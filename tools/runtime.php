#!/usr/bin/env php -q

<?php

require_once("lib/spyc.php");
require_once("lib/runtimelib.php");

$opts = getopt("rw:");


$jobid = basename($opts['w']);
$tempnam=$opts['w']."/$jobid";
$info = Spyc::YAMLLoad("{$opts['w']}/info.yaml");
$info['status'] = 'running';
$info['jobid']=$jobid;


if (array_key_exists('r', $opts))
{ run_micro($opts["w"]);
}   

if (array_key_exists('e', $opts) && isset($info["email"])&&array_key_exists('r', $opts))
{
    $fp = fopen("{$opts['w']}/email.txt", "w");
    $headers = "Bcc: unlzhhy@husters.unl.edu" . "\r\n";
    fwrite($fp, "Your motif pholygenetic footprinting job is done.\nPlease click http://\nYour email: {$info['email']}");
    fclose($fp);
   # system("echo perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt >> {$opts['w']}/log");
   # system("perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt");
}
$info['status'] = 'Done';
$fp = fopen("{$opts['w']}/info.yaml", "w");
fwrite($fp, Spyc::YAMLDump($info)); fclose($fp);

?>
