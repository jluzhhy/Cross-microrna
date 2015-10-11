<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title>DMES:Detect Candidate microRNA from Exogenous Species</title>


    {{block name="meta"}}
    {{/block}}

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

    {{block name="extra_css"}}
    {{/block}}
    
    <style type="text/css" media="screen">    
    {{block name="extra_style"}}
    {{/block}}
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
    {{block name="extra_js"}}
    {{/block}}

  </head>

  <body>
    <div class="shadow corner" id="pane">

    {{block name="head"}}
<
    <div style="position:relative;left:0px;top:0px;z-Index:0;"><a href="index.php"><img src="static/images/head.png" width="1024px" height="200px" alt="logo"/></a></div>

   
    <div id="nav" >
      <div id="search">
        <form id="search" name="search" action="search.php" method="GET">
          <input id="id_keyword" name="keyword"  align="right" title="Search by your job ID" />
        </form>
      </div>

      <ul id="nav">
        <li class="left{{if $section == 'Homepage'}} current{{/if}}" ><a href="index.php" alt="Welcome BoBro" >Home</a></li>
        <li class="middle{{if $section == 'Submitjobs'}} current{{/if}}"><a href="submit.php" alt="Submit data">Submit</a></li>
        <li class="middle{{if $section == 'Downloading'}} current{{/if}}"><a href="download.php" alt="Download your own BoBro">Download</a></li>
        <li class="middle{{if $section == 'Documents'}} current{{/if}}"><a href="documentation.php" alt="Get Help">Documentation</a></li>
        <li class="right{{if $section == 'Aboutus'}} current{{/if}}"><a href="aboutus.php">About us</a></li>
      </ul>
    </div>
    {{/block}}

    <div id="main">
      {{block name="main"}}
      {{/block}}
    </div>

    </div>

    {{block name="foot"}}
    <div id="foot">
      <div id="copyright">
        <p>
          Copyright 2014-2015 &copy; <a href="http://sbbi.unl.edu/">SBBI</a>, <a href="http://www.unl.edu">UNL</a>. All rights reserved. <br/><a href="mailto:jcui@unl.edu" title="jcui@unl.edu" >Contact us: jcui@unl.edu</a>  
        </p>
      </div>

    </div>
    {{/block}}
    
  </body>
</html>
