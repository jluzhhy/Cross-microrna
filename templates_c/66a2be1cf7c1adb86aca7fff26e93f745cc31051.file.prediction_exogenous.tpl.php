<?php /* Smarty version Smarty-3.0.7, created on 2015-10-11 19:24:15
         compiled from "./templates/prediction_exogenous.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183203599256028d3f35f577-08698528%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66a2be1cf7c1adb86aca7fff26e93f745cc31051' => 
    array (
      0 => './templates/prediction_exogenous.tpl',
      1 => 1443007803,
      2 => 'file',
    ),
    'd727a2f7c0bda098bc7da6c28169b69f69e5ee74' => 
    array (
      0 => './templates/base.tpl',
      1 => 1444538192,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183203599256028d3f35f577-08698528',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title>DMES:Detect Candidate microRNA from Exogenous Species</title>


    
    

    <link rel="stylesheet" href="static/css/base.css" />
    <link rel="stylesheet" href="static/css/jquery.ui/jquery-ui.css" />
    <link rel="stylesheet" href="static/css/jquery.qtip/jquery.qtip.css" />
    <link rel="stylesheet" href="static/css/jquery.datatable/jquery.dataTables.css" />
    <link rel="stylesheet" href="static/css/jquery.datatable/jquery.dataTables_themeroller.css" />
    <style type="text/css" media="screen">
      .dataTables_info { padding-top: 0; }
      .dataTables_paginate { padding-top: 0; }
      div#content div a { color: blue; }
      div#content ul.ui-widget-header a { color: black; }
      td..dataTables_empty { text-align: center; font-color: #555; font-size: 1.2em; }
    </style>

    
    
    
    <style type="text/css" media="screen">    
    
.dataTables_wrapper { min-height: 0; }
div#tabs div { max-height: 450px; }

ul li {margin: 10px 0;}
 

    </style>		

    <script type="text/javascript" src="static/js/jquery.js"></script>
    <script type="text/javascript" src="static/js/jquery-ui.js"></script>
    <script type="text/javascript" src="static/js/jquery.corner.js"></script>
    <script type="text/javascript" src="static/js/jquery.qtip.js"></script>
    <script type="text/javascript" src="static/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="static/js/jquery.dataTables.FixedHeader.js"></script>
    <script type="text/javascript" src="static/js/jquery.dataTables.ColVis.js"></script>
    <script type="text/javascript">
      var $J = jQuery.noConflict()
      $J(document).ready(function() {
       $J(".corner").corner("5px");
        $J("div#tabs").tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
      $J('a').qtip({
          content : { attr : 'alt' }, 
          style : { classes : 'qtip-shadow qtip-youtube'},
          position : { at : 'bottom center', my : 'top center' }
        });
   
        if ($J("input#id_keyword").val() == "") {
          $J("input#id_keyword").val($J("input#id_keyword").attr("title"));
          $J("input#id_keyword").focus(function () {
               if ($J(this).val() == $J(this).attr("title"))
                  $J(this).val("");
             }).blur(function () {
              if ($J(this).val() == "")
                  $J(this).val($J(this).attr("title"));
          });
        }
      });
    </script>
    
<script type="text/javascript">
  var $J = jQuery.noConflict()
          
     $J(document).ready(function() {
 
$J('table.tables').dataTable();
});
</script>


  </head>

  <body>
    <div class="shadow corner" id="pane">

    

    <div style="position:relative;left:0px;top:0px;z-Index:0;"><a href="index.php"><img src="static/images/head.png" width="1024px" height="200px" alt="logo"/></a></div>

   
    <div id="nav" >
      <div id="search">
        <form id="search" name="search" action="search.php" method="GET">
          <input id="id_keyword" name="keyword"  align="right" title="Search by your job ID" />
        </form>
      </div>

      <ul id="nav">
        <li class="left<?php if ($_smarty_tpl->getVariable('section')->value=='Homepage'){?> current<?php }?>" ><a href="index.php" alt="Welcome BoBro" >Home</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Submitjobs'){?> current<?php }?>"><a href="submit.php" alt="Submit data">Submit</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Downloading'){?> current<?php }?>"><a href="download.php" alt="Download your own BoBro">Download</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Documents'){?> current<?php }?>"><a href="documentation.php" alt="Get Help">Documentation</a></li>
        <li class="right<?php if ($_smarty_tpl->getVariable('section')->value=='Aboutus'){?> current<?php }?>"><a href="aboutus.php">About us</a></li>
      </ul>
    </div>
    

    <div id="main">
      
  <?php if ($_smarty_tpl->getVariable('status')->value=="Done"){?>
  
     <?php echo $_smarty_tpl->getVariable('content')->value;?>

   
  <?php }else{ ?>
  
  <META HTTP-EQUIV="REFRESH" CONTENT="15">
  
  

     <div style="text-align: center; font-size:1.2em;"><p>
  
    <img src="static/images/busy.gif" /> <br />
  
 
    Your request is received now.<br>
    Or you can choose to stay at this page, which will be automatically refreshed every <b>15</b> seconds.<br/>

    
     Link:&nbsp<a href ="http://csbl.bmb.uga.edu/DMINDA/motif_annotation_prediction.php?jobid=<?php echo $_smarty_tpl->getVariable('jobid')->value;?>
">http://csbl.bmb.uga.edu/DMINDA/prediction_exogenous.php?jobid=<?php echo $_smarty_tpl->getVariable('jobid')->value;?>
</a>
    <br> Yon can remember your jobid <font color="red"> <strong><?php echo $_smarty_tpl->getVariable('jobid')->value;?>
<strong> </font>
     </p><div>
 <?php }?>
   

    </div>

    </div>

    




    
  </body>
</html>
