<?php /* Smarty version Smarty-3.0.7, created on 2015-09-10 00:15:35
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:404255f10367a07350-37980555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1441858403,
      2 => 'file',
    ),
    '50da811edd0e07e65507282cf2fea5e9d6f55598' => 
    array (
      0 => '.\\templates\\base.tpl',
      1 => 1441858531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '404255f10367a07350-37980555',
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
    $J("div#tabs").tabs({
      fx : { opacity: 'toggle', duration : 300 }
    });
     $J('button').qtip({
          content : { attr : 'alt' }, 
          style : { classes : 'qtip-shadow qtip-youtube'},
          position : { at : 'bottom center', my : 'top center' }
        });
       
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
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Submitjobs'){?> current<?php }?>"><a href="submit.php" alt="Submit data">Submit</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Downloading'){?> current<?php }?>"><a href="download.php" alt="Download your own BoBro">Download</a></li>
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Documents'){?> current<?php }?>"><a href="documentation.php" alt="Get Help">Documentation</a></li>
        <li class="right<?php if ($_smarty_tpl->getVariable('section')->value=='Aboutus'){?> current<?php }?>"><a href="aboutus.php">About us</a></li>
      </ul>
    </div>
    

    <div id="main">
      
<div id="content">
 <style type="text/css">
          .input_file{-webkit-appearance: none;position:absolute;opacity:0;filter:alpha(opacity=0);cursor:pointer;}      
  </style>
  <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Overview</a></li>
      <li><a href="#tabs-2">What's new</a></li>
      <li><a href="#tabs-3">Cite us</a></li>
    </ul>

    <div id="tabs-1">
     
      <div style="float: middle;"> 
        <img src="static/images/Home-page-design.png" width="900px" height="444px" style="z-Index:-1;margin-left:30px">
        <input id="b1" type="button" name="Button1" value="Button" onclick="javascript:window.location.href='annotate.php'" class="input_file" style="top:35pt;left:40pt;width:180pt;height:150pt;" title="Motif analysis by your data."/>
                 <input id="b2" type="button" name="Button2" value="Button" onclick="javascript:window.location.href='displayspecies.php'" class="input_file" style="left:40pt;top:210pt;width:180pt;height:150pt;" title="Motif analysis by DOOR database."/>
                         <input id="b5" type="button" name="Button5" value="Button" onclick="javascript:window.location.href='annotate.php#tabs-1'" class="input_file" style="left:250pt;top:60pt;width:220pt;height:100pt;" title="Bobro Submit"/>
                                  <input id="b5" type="button" name="Button8" value="Button" onclick="javascript:window.location.href='annotate.php#tabs-4'" class="input_file" style="left:250pt;top:160pt;width:220pt;height:100pt;" title="MP3 Submit"/>
                                          <input id="b6" type="button" name="Button6" value="Button" onclick="javascript:window.location.href='showmotifdatabase.php'" class="input_file" style="left:250pt;top:250pt;width:220pt;height:100pt;" title="Motif Database"/>
                                         <input id="b3" type="button" name="Button3" value="Button" onclick="javascript:window.location.href='annotate.php#tabs-2'" class="input_file" style="left:500pt;top:60pt;width:220pt;height:100pt;" title="Motif scan"/>
        <input id="b4" type="button" name="Button4" value="Button" onclick="javascript:window.location.href='annotate.php#tabs-3'" class="input_file" style="left:500pt;top:160pt;width:220pt;height:100pt;" title="Motif compare"/>
        <input id="b4" type="button" name="Button7" value="Button" onclick="javascript:window.location.href='annotate.php#tabs-2'" class="input_file" style="left:500pt;top:260pt;width:220pt;height:100pt;" title="Motif compare"/>

         </div>
    </div>
    
    <div id="tabs-2">

        
	 <p> 04/04/2014, the paper of DMINDA server has been accepted by <strong>Nucleic Acids Research<strong>.</p>
         <p align="justify"> <br/>
      DMINDA (<strong>D</strong>NA <strong>m</strong>otif <strong>i</strong>dentification a<strong>nd</strong> <strong>a</strong>nalyses) is an integrated web server for DNA motif identification and analyses. This website is freely available to all users and there is no login requirement. This server provides a suite of cis regulatory DNA motif analysis functions, which are important to elucidating the mechanism of transcriptional regulation:<br/><br/>  
     (i) de novo motif finding for a given set of promoter sequences along with motif evaluation based on information extracted from a control set or a set of reference genomes;<br/> <br/>  
     (ii) scanning motif instances of a query motif in provided genomic sequences;<br/> <br/>  
     (iii) motif comparison and clustering of identified motifs; and <br/> <br/> 
     (iv) co-occurrence analyses of query motifs in given promoter sequences.<br/> <br/> 
     The server is powered by a backend computer cluster with over 150 computing nodes, and is particularly useful for DNA-motif analyses in prokaryotic genomes. We believe that DMINDA, as a new and comprehensive web server for cis regulatory motif finding and analyses, will benefit the genomic research community in general and prokaryotic genome researchers in particular. <br/> <br/> 
        </p>
    

    </div>
    
    <div id="tabs-3">
      <p align="justify"><br/>
        Please cites the following papers if you use the result of the motif finding program:<br>
      <p>1.Qin Ma*, Hanyuan Zhang*, Xizeng Mao, Chuan Zhou, Bingqiang Liu, Xin Chen, Ying Xu, DMINDA: An integrated web server for DNA motif identification and analyses, <em><strong>Nucleic Acids Research</strong></em>, doi: 10.1093/nar/gku315, 2014. <a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=24753419" target="_blank"><strong>&nbsp(PMID:24753419)</strong></a>.  </p>
       <p>2. Qin Ma, Bingqiang Liu, Chuan Zhou, Yanbin Yin, Guojun Li, Ying Xu,
        BoBro2.0: An integrated toolkit for accurate prediction and analysis of cis regulatory elements at a genome scale. <em><strong> Bioinformatics,</strong></em> 10.1093/bioinformatics/btt397, 2013<a href="http://www.ncbi.nlm.nih.gov/pubmed/23846744" target="_blank"><strong>&nbsp(PMID:23846744)</strong></a></p>
       <p>3. Guojun Li, Bingqiang Liu, Qin Ma, Ying Xu, A new framework for identifying cis-regulatory motifs in prokaryotes, <em><strong>Nucleic Acids Research</strong></em>. 2011 Apr;39(7):e42<a href="http://www.ncbi.nlm.nih.gov/pubmed/21149261" target="_blank"><strong>&nbsp(PMID:21149261)</strong></a></p>  
       <p>4. Guojun. Li*,Bingqiang Liu*, Ying Xu, Accurate Recognition of cis Regulatory Motifs with the Correct Lengths in Prokaryotic Genomes, <em><strong>Nucleic Acids Research</strong></em>, Vol. 38, No. 2, e12, 2010.<a href="http://www.ncbi.nlm.nih.gov/pubmed/19906734" target="_blank">&nbsp<strong>(PMID:19906734)</strong></a></p>
     
      </p>
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
       <a href="http://www.easycounter.com/">
<img src="http://www.easycounter.com/counter.php?jluzhhyhit"
border="0" alt="Hit Counters"></a>
<br>Visitors since 02/05/2014
    </div>



    
  </body>
</html>
