<?php
// For debug purpose
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');

// Permit large array due to very big families
ini_set('memory_limit', '-1');

//date_default_timezone_set("America/New_York");
 if (function_exists ( ¡®date_default_timezone_set¡¯ )){ 
    date_default_timezone_set(¡¯America/New_York¡¯); 
} else { 
    putenv("TZ=America/New_York"); 
} 
// Set running mode, pro or dev
$HOST_MODE = "dev";

// Set path variables
$BASE = realpath(dirname(__FILE__) . "/../");
$LIBPATH = $BASE . "/lib";
$DATAPATH = $BASE . "/data";
$TOOLPATH = $BASE . "/tools";
?>