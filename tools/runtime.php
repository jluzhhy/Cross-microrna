#!/usr/bin/env php -q

<?php
require_once("lib/spyc.php4");
require_once("lib/annotate.php4");

$opts = getopt("fscrgew:");

$jobid = basename($opts['w']);
$tempnam=$opts['w']."/$jobid";
$info = Spyc::YAMLLoad("{$opts['w']}/info.yaml");
$info['status'] = 'running';
$info['jobid']=$jobid;

$sy=intval($info['style']);
if (array_key_exists('f', $opts))
{annotate_prediction($opts["w"]);
 


}
if (array_key_exists('s', $opts))
{annotate_scan($opts["w"]);


}
if (array_key_exists('c', $opts))
{ annotate_compare($opts["w"]);
}

if (array_key_exists('r', $opts))
{ annotate_mp3($opts["w"]);
}   

if (array_key_exists('g', $opts))
{ 
  annotate_regulon($opts["w"]);

} 
/*	system("echo '#!/bin/bash\n#$ -l arch=glinux -l hostname=decoder2\n#\$ -S /bin/bash\n\ncd /srv2/www/html/DMINDA/\n/usr/bin/php /srv2/www/html/DMINDA/tools/annotatew.php4 -w /srv2/www/html/DMINDA/data/annotation/$jobid' > /srv2/www/html/DMINDA/data/annotation/$jobid/cmdw.sh");
	system("chmod 777 /srv2/www/html/DMINDA/data/annotation/$jobid/cmdw.sh ");
//$output = shell_exec("sh $TOOLPATH/qsub.sh $BASE $workdir 1>$workdir/logsub1 2>$workdir/logsub2");
$output = shell_exec("sh /srv2/www/html/DMINDA/tools/qsub1.sh /srv2/www/html/DMINDA /srv2/www/html/DMINDA/data/annotation/$jobid 1>/srv2/www/html/DMINDA/data/annotation/$jobid/wlogsub1 2>/srv2/www/html/DMINDA/data/annotation/$jobid/wlogsub2"); */

$info['status'] = 'Done';
$fp = fopen("{$opts['w']}/info.yaml", "w");
fwrite($fp, Spyc::YAMLDump($info)); fclose($fp);
if (array_key_exists('e', $opts) && isset($info["email"])&&array_key_exists('f', $opts))
{
    $fp = fopen("{$opts['w']}/email.txt", "w");
    $headers = "Bcc: maqin@csbl.bmb.uga.edu" . "\r\n";
    fwrite($fp, "Your motif de-novo finding job is done.\nPlease click http://csbl.bmb.uga.edu/DMINDA/motif_annotation_prediction.php?jobid=$jobid\nYour email: {$info['email']}");
    fclose($fp);
    system("echo perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt >> {$opts['w']}/log");
    system("perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt");
}
if (array_key_exists('e', $opts) && isset($info["email"])&&array_key_exists('s', $opts))
{
    $fp = fopen("{$opts['w']}/email.txt", "w");
    $headers = "Bcc: maqin@csbl.bmb.uga.edu" . "\r\n";
    fwrite($fp, "Your motif scan job is done.\nPlease click http://csbl.bmb.uga.edu/DMINDA/motif_annotation_scan.php?jobid=$jobid\nYour email: {$info['email']}");
    fclose($fp);
    system("echo perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt >> {$opts['w']}/log");
    system("perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt");
}
if (array_key_exists('e', $opts) && isset($info["email"])&&array_key_exists('g', $opts))
{    
    $fp = fopen("{$opts['w']}/email.txt", "w");
    $headers = "Bcc: maqin@csbl.bmb.uga.edu" . "\r\n";
    fwrite($fp, "Your regulon finding job is done.\nPlease click http://csbl.bmb.uga.edu/DMINDA/motif_annotation_regulon.php?jobid=$jobid\nYour email: {$info['email']}");
    fclose($fp);
    system("echo perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt >> {$opts['w']}/log");
    
}
if (array_key_exists('e', $opts) && isset($info["email"])&&array_key_exists('c', $opts))
{
    $fp = fopen("{$opts['w']}/email.txt", "w");
    $headers = "Bcc: maqin@csbl.bmb.uga.edu" . "\r\n";
    fwrite($fp, "Your motif compare job is done.\nPlease click http://csbl.bmb.uga.edu/DMINDA/motif_annotation_compare.php?jobid=$jobid\nYour email: {$info['email']}");
    fclose($fp);
    system("echo perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt >> {$opts['w']}/log");
    system("perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt");
}



if (array_key_exists('e', $opts) && isset($info["email"])&&array_key_exists('r', $opts))
{
    $fp = fopen("{$opts['w']}/email.txt", "w");
    $headers = "Bcc: maqin@csbl.bmb.uga.edu" . "\r\n";
    fwrite($fp, "Your motif pholygenetic footprinting job is done.\nPlease click http://csbl.bmb.uga.edu/DMINDA/motif_annotation_mp3_2.php?jobid=$jobid\nYour email: {$info['email']}");
    fclose($fp);
    system("echo perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt >> {$opts['w']}/log");
    system("perl tools/mail.pl $jobid {$info['email']} {$opts['w']}/email.txt");
}
?>
