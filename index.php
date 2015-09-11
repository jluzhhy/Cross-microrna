<?php
// include "head.html";

require("config/common.php");
require("config/smarty.php");


$smarty->assign('section', 'Homepage');

$smarty->display('index.tpl');
?> 

