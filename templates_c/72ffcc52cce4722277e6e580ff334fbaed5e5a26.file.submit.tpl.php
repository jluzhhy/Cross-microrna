<?php /* Smarty version Smarty-3.0.7, created on 2015-09-10 00:15:37
         compiled from ".\templates\submit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:296255f1019ed7c5d0-61599471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72ffcc52cce4722277e6e580ff334fbaed5e5a26' => 
    array (
      0 => '.\\templates\\submit.tpl',
      1 => 1441857941,
      2 => 'file',
    ),
    '50da811edd0e07e65507282cf2fea5e9d6f55598' => 
    array (
      0 => '.\\templates\\base.tpl',
      1 => 1441858531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '296255f1019ed7c5d0-61599471',
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
    
  <script type="text/javascript" src="static/js/motif_annotate.js">
  
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
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Submitjobs'){?> current<?php }?>"><a href="submit.php" alt="Submit data">Submit</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Downloading'){?> current<?php }?>"><a href="download.php" alt="Download your own BoBro">Download</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Documents'){?> current<?php }?>"><a href="documentation.php" alt="Get Help">Documentation</a></li>
        <li class="right<?php if ($_smarty_tpl->getVariable('section')->value=='Aboutus'){?> current<?php }?>"><a href="aboutus.php">About us</a></li>
      </ul>
    </div>
    

    <div id="main">
      
  <style type="text/css">
          .input_file{position:absolute;opacity:0;filter:alpha(opacity=0);cursor:pointer;width:385px;height:30px;}      
  </style>
 
    
  <div id="content">
  <input id="samplep" type="hidden" value="<?php echo $_smarty_tpl->getVariable('sample')->value;?>
"/>

  <div id="tabs" >
    <ul>
      <li><a href="#tabs-1">Motif Finding</a></li>
      <li><a href="#tabs-2">Motif Scan</a></li>
  
    </ul>
   <div id="tabs-1" style="background-color:#CED8F6;" >

      
 
        <form action="data_submit.php" method="post" enctype="multipart/form-data" name="form1">
        
          
    <div class="section" id="fdiv" style="position:relative;background-color:#DFE0DB;top:5px;">    
   <h2>Input query sequences</h2><br/>
   <div id="Inputsequence"  style="position:relative;">
            

        
            &nbsp; <strong>Upload data(*.zip)</strong><br/>
             <div style="position:relative;">
            &nbsp; <input name="seqdata" type="file" id="seqdata"  onchange="upfile3.value=this.value" class="input_file" />
              <input type="text"  name="upfile3" style="width:386px;"  readonly />            
             </div>
       
   </div>
   </div>

    
    
    <div class="section" id="fdiv" style="position:relative;background-color:#DFE0DB;top:5px;">
      <span id="fop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" /><strong>Set parameters</strong></h2></span><br/>
        
          <div id="option" style="position:relative;display:none;">
             <table border="0">
              <tr>
                <td witdh="200px">&nbsp;Minimal motif length:</td>
                <td witdh="200px"><input name="min" type="text" size="5" id="min" size="5" value="10" ></input> </td>
                <td>The length should be more than 6</td>
              </tr>
                <tr>
                <td witdh="200px">&nbsp;Maximal motif length:</td>
                <td witdh="200px"><input name="max" type="text" id="max" size="5" value="12" ></input></td>
                <td></td>
              </tr>
                 <tr>
                <td witdh="200px">&nbsp;Number of output motifs:</td>
                <td witdh="200px"><input name="num" type="text" id="num" size="5" value="10" ></input></td>
                <td></td>
              </tr>
            
            </table>
             <br/>
            <p> The default minimum motif length is set as 10, because >90% TFs in prokaryotic genomes have binding motifs with length >10. The number of output motifs should be less than 100, otherwise they will be too slow to display </p><br>
           </div>
     </div>
    
   
       <div id="emailfd" class="section" style="position:relative;top:10px;background-color:#DFE0DB;"> 
         <h2>Submit job</h2>
         <br/>
         
        &nbsp;Please leave your email if submitting too many sequences; you will be notified by email when the job is done.<br/>
         &nbsp;<strong>E-mail</strong>&nbsp;(optional):<input name="email" type="text" id="email" size="60" style="position:relative;left:10px;"/>
              &nbsp;
              <input type="reset" name="Submit2"  value="Cancel" />
              <input type="submit" name="Submit"  value="Submit" />
       </div>
              
          
    </form>


       
 
    
      
  
  </div> 
      
 </div>
 </div>

    </div>

    </div>

    
    <div id="foot">
      <div id="copyright">
        <p>
          Copyright 2014-2015 &copy; <a href="http://sbbi.unl.edu/">SBBI</a>, <a href="http://www.unl.edu">UNL</a>. All rights reserved. <br/><a href="mailto:jcui@unl.edu" title="jcui@unl.edu" >Contact us: jcui@unl.edu</a>  
        </p>
      </div>

    </div>
    
    
  </body>
</html>
