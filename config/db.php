<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');

# database connection scripts
# the next 4 lines you can modify
$dbhost = '127.0.0.1';
$database_name = 'DOOR2';
$dbusername = 'apache';
$dbpasswd = 'apache';
$_SESSION['pagesize']=20;
$DOORpath='/hphome/www/html/OperonDB_10152012';
$webmaster['Name']="Chuan Zhou";
$webmaster['E-mail']='zhouchuan121@gmail.com';


#under here, don't touch!
$connection = mysql_pconnect("$dbhost","$dbusername","$dbpasswd")
    or die ("Couldn't connect to server.");
$db = mysql_select_db("$database_name", $connection)
    or die("Couldn't select database.");

?>
