<?php
require("lib/smarty/Smarty.class.php");

$smarty = new Smarty;
$smarty->left_delimiter='{{';
$smarty->right_delimiter='}}';
$smarty->debugging = false;
$smarty->allow_php_tag = true;
?>
