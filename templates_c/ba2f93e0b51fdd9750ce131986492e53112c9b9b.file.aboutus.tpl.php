<?php /* Smarty version Smarty-3.0.7, created on 2015-09-10 00:06:15
         compiled from ".\templates\aboutus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2019055f101b77407a8-63434234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba2f93e0b51fdd9750ce131986492e53112c9b9b' => 
    array (
      0 => '.\\templates\\aboutus.tpl',
      1 => 1390141974,
      2 => 'file',
    ),
    '50da811edd0e07e65507282cf2fea5e9d6f55598' => 
    array (
      0 => '.\\templates\\base.tpl',
      1 => 1397657167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2019055f101b77407a8-63434234',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>DMINDA: A integrated DNA motif analysis web server</title>

    
    

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
    
div.section { margin: 1.5em 0.5em; padding-bottom: 5px; }
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
    
    

  </head>

  <body>
    <div class="shadow corner" id="pane">

    
    <div style="position:relative;left:0px;top:0px;z-Index:0;"><a href="index.php"><img src="static/images/test.png" width="1024px"  alt="logo"/></a></div>
   
    <div id="nav" >
      <div id="search">
        <form id="search" name="search" action="search.php" method="GET">
          <input id="id_keyword" name="keyword"  align="right" title="Search by your job ID" />
        </form>
      </div>

      <ul id="nav">
        <li class="left<?php if ($_smarty_tpl->getVariable('section')->value=='Homepage'){?> current<?php }?>" ><a href="index.php" alt="Welcome BoBro" >Home</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Submitjobs'){?> current<?php }?>"><a href="annotate.php" alt="Submit data">Submit</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Downloading'){?> current<?php }?>"><a href="download.php" alt="Download your own BoBro">Download</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Documents'){?> current<?php }?>"><a href="documentation.php" alt="Get Help">Documentation</a></li>
        <li class="right<?php if ($_smarty_tpl->getVariable('section')->value=='Aboutus'){?> current<?php }?>"><a href="aboutus.php">About us</a></li>
      </ul>
    </div>
    

    <div id="main">
      
<div id="content">

<div class="section">
  <h2>DMINDA Team</h2>
  <ul>
    <li>Prof. Ying Xu, xyn at bmb.uga.edu, CSBL</li>
   
    <li>Dr. Qin Ma, maqin at uga.edu, CSBL</li>

    <li>Mr. Hanyuan Zhang, jluzhhy at gmail.com, JLU</li>
     
    <li>Mr. Chuan Zhou, zhouchuan at mail.sdu.edu.cn, SDU</li>
    
    <li>Dr. Bingqiang Liu, bingqiangsdu at gmail.com,SDU </li>
    
    <li>Dr. Xizeng Mao,  xizeng at csbl.bmbb.uga.edu, CSBL</li>
    
    <li>Mr. Xin Chen, xinchenuga at gmail.com, CSBL</li>
    
    <li>Dr. Guojun Li, guojunsdu at gmail.com, SDU</li>
  </ul>

<p>CSBL: Computational Systems Biology Laboratory 
Dept. of Biochemistry and Molecular Biology
University of Georgia, Athens</p>
<p>JLU: Jilin University</p> 
<p>SDU: Shandong University</p>


</div>

</div>

    </div>

    </div>

    
    <div id="foot">
      <div id="copyright">
        <p>
          Copyright 2009-2013 &copy; <a href="http://csbl.bmb.uga.edu">CSBL</a>, <a href="http://www.uga.edu">UGA</a>. All rights reserved. <br/><a href="mailto:maqin@uga.edu" title="maqin@uga.edu" >Contact us: maqin@uga.edu</a>  
        </p>
      </div>

    </div>
    
    
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46087607-1', 'uga.edu');
  ga('send', 'pageview');
</script>
  </body>
</html>
