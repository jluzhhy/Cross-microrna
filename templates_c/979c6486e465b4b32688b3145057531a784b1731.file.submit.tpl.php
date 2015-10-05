<?php /* Smarty version Smarty-3.0.7, created on 2015-10-05 13:01:43
         compiled from "./templates/submit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14599157005612acf7bf1912-84951575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '979c6486e465b4b32688b3145057531a784b1731' => 
    array (
      0 => './templates/submit.tpl',
      1 => 1444063836,
      2 => 'file',
    ),
    'd727a2f7c0bda098bc7da6c28169b69f69e5ee74' => 
    array (
      0 => './templates/base.tpl',
      1 => 1444064137,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14599157005612acf7bf1912-84951575',
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


 var $J = jQuery.noConflict();
$J(document).ready(function(){ 

var i=0;
var c = 0;
var id ='';
var seq = '';
var processed = 0;


$J("#seqdata").change(function(event){

document.getElementById("upfile3").value=document.getElementById("seqdata").value;
var d=new Date();
var prefix=d.valueOf();
$J("#file-listing").append("\<li\>\<div id\=\"progress\_bar"+prefix+"\"\>\<div id=\""+prefix+"\" class\=\"percent\"  \>0\%\<\/div\>\<\/div\>\<\/li\>");
  var progress = document.getElementById(prefix);
  function updateProgress(evt) {
    // evt is an ProgressEvent.
      // var percentLoaded = eval($J("#bar").val());
   
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        progress.textContent = percentLoaded + '%';
      }
    }
  }
 var file = document.getElementById("seqdata").files[0];
var leftsize=file.size;
var buffer=1024*100000;
var start=0;
var stop=0;
var newdata="";
var min1 = document.getElementById("min").value;
var max1 = document.getElementById("max").value;
while(stop<leftsize)
 { var newdata="";
     var start = stop+1;
     var stop = start+buffer-1; 
     if(stop>leftsize)
       { stop=leftsize;
       }
   
     var file = document.getElementById("seqdata").files[0];
     var blob = file.slice(start, stop);
     i++;
     var reader = new FileReader();
reader.onloadstart = function(e) {
      document.getElementById("progress_bar"+prefix).className = 'loading';
    };

reader.onload = function(e) {
        var text = reader.result;  
        var lines = text.split('\n');
        var hash={};
    for(var line = 0; line < lines.length; line++){
     if(lines[line].match(/^\@/))
    {   
   
      
        var lines2 = lines[line].split();
          id = lines2[0];
       
         //var patt = s/\@//;
        //id =patt.exec(id);
     } else if(lines[line].match(/^[A|C|G|T|U]*$/gi) && lines[line].length<= max1 && lines[line].length>= min1)   
       {
        seq = lines[line];
             line++;
          if(hash[seq] ===undefined)
          {hash[seq]=1;    }
          else{hash[seq]=hash[seq]+1;}
     
      
        id ='';
        seq ='';
        
    
     }
}

for (var k in hash) {
    // use hasOwnProperty to filter out keys from the Object.prototype
    if (hash.hasOwnProperty(k)) {
      processed++;
       newdata=newdata+">seq_"+processed+"_x"+hash[k]+"\n"+k+"\n";
    }
}
          var filename=prefix;
    
    
        //  percent=100/(i-1);
    
        // alert(eval($J("#bar").val()));
       // progress.style.width = parseInt(eval(percentLoaded +percent));
       // progress.textContent = parseInt(eval(percentLoaded +percent));
        // $J("#bar").val(eval(percentLoaded +percent));
      
    $J.ajax({url: "prepare_file.php",
          type: 'POST',
          data: {data: newdata, filename:filename },
          success: function(data) {}
    });
   }
     reader.onprogress = updateProgress;
    reader.onloadend = function (evt) {
          
        progress.style.width = '100%';
        progress.textContent ='100%';
       progress.innerHTML = document.getElementById("seqdata").value+"    \<input type\=\"checkbox\" name\=\"controls\[\]\" class=\"CLASS\" value\="+prefix+"\<\/\> is control?";
       
     
    };


      
     i++;
  
     reader.readAsText(blob);

   
   
}

});


$J("form").submit(function(form) {
 form.preventDefault();
var sData =  document.querySelector('.CLASS').$('input').serialize();
alert(sData);
 $J.ajax({url: "prepare_job.php",
          type: 'POST',
          data: { prefix:prefix, species: $J("#species").val(),species2: $J("#species2").val(),email: $J("#email").val() },
          success: function(data) {window.location.href=data;}
    });

 
});
});
      
</script>



  </head>

  <body>
    <div class="shadow corner" id="pane">

    
<
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
      
  <style type="text/css">

          .input_file{position:absolute;opacity:0;filter:alpha(opacity=0);cursor:pointer;width:385px;height:30px;}  
   #progress_bar {
    margin: 10px 0;
    padding: 3px;
    border: 1px solid #010;
    font-size: 14px;
    clear: both;
    opacity: 0;
    -moz-transition: opacity 1s linear;
    -o-transition: opacity 1s linear;
    -webkit-transition: opacity 1s linear;
  }
  #progress_bar.loading {
    opacity: 1.0;
  }
  #progress_bar .percent {
    background-color: #99ccff;
    height: auto;
    width: 0;
     opacity: 1.0;
  }    
  #progress_bar .file {
    background-color: #99ccff;
    height: auto;
    width: 0;
     opacity: 1.0;
  }
  </style>
 
  

  <div id="content">
  

  <div id="tabs" >
    <ul>
      <li><a href="#tabs-1">exogenous microRNA</a></li>
    </ul>
   <div id="tabs-1" style="background-color:#CED8F6;" >

        <form action="prepare_job.php" name="form1" method="post" enctype="multipart/form-data" >
        

    <div class="section" id="trim" style="position:relative;background-color:#DFE0DB;top:5px;">
      <span id="fop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" /><strong>Trim data</strong></h2></span><br/>
        <table border="0">
              <tr>
                <td witdh="200px">&nbsp;Minimal length:</td>
                <td witdh="200px"><input name="min" type="text" size="5" id="min" size="5" value="8" ></input> </td>
                <td>The length should be more than 6</td>
              </tr>
                <tr>
                <td witdh="200px">&nbsp;Maximal length:</td>
                <td witdh="200px"><input name="max" type="text" id="max" size="5" value="22" ></input></td>
                <td></td>
              </tr>
                 <tr>
                <td witdh="200px">&nbsp;3' Adatptor:</td>
                <td witdh="200px"><input name="ada" type="text" id="ada" size="15" value="" ></input></td>
                <td></td>
              </tr>
                
              <tr>
                <td witdh="200px">&nbsp;Quality score:</td>
                <td witdh="200px"><input name="qs" type="text" id="qs" size="5" value="30" ></input></td>
                <td></td>
              </tr>
            </table>
                 
           
     </div>
    
 
          <div class="section" id="fdiv" style="position:relative;background-color:#DFE0DB;top:5px;">    
            <h2>Input query sequences</h2><br/>
            <div id="Inputsequence"  style="position:relative;">
                 &nbsp; <strong>Upload data(*.fastq)</strong><br/>
              <div style="position:relative;">
              &nbsp; <input name="seqdata" type="file" id="seqdata"   class="input_file" />
              <input type="text"  name="upfile3" id="upfile3" style="width:386px;"  readonly />            
              </div>

                      <ul id="file-listing"></ul>
            </div>
           </div>

    
    
    <div class="section" id="fdiv" style="position:relative;background-color:#DFE0DB;top:5px;">
      <span id="fop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" /><strong>Set parameters</strong></h2></span><br/>
        
          <div id="option" style="position:relative;">
 &nbsp; <strong>Original species:<strong>
<select id="species" name="species">
<option value="hsa">  Human </option>
<option value="ptr">  Chimp </option>
<option value="mmu">  Mouse </option>
<option value="rno">  Rat </option>
<option value="cfa">  Dog </option>
</select> 
 &nbsp; <strong>Exogenous species:<strong>
<select id="species2" name="species2">
<option value=" ﻿hsa  ">  Human </option>
<option value=" ptr ">  Chimp </option>
<option value=" na  ">  Orangutan </option>
<option value=" na  ">  Rhesus  </option>
<option value=" na  ">  Marmoset  </option>
<option value=" mmu ">  Mouse </option>
<option value=" rno ">  Rat </option>
<option value=" na  ">  Guinea  </option>
<option value=" lca ">  Cat </option>
<option value=" cfa ">  Dog </option>
<option value=" eca ">  Horse </option>
<option value=" bta ">  Cow </option>
<option value=" na  ">  Opossum </option>
<option value=" na  ">  Platypus  </option>
<option value=" gga ">  Chicken </option>
<option value=" na  ">  Zebra </option>
<option value=" na  ">  Lizard  </option>
<option value=" xtr ">  X.tropicalis  </option>
<option value=" tni ">  Zebrafish </option>
<option value=" tni ">  Tetraodon </option>
<option value=" fru ">  Fugu  </option>
<option value=" na  ">  Stickleback </option>
<option value=" na  ">  Medaka  </option>
<option value=" na  ">  Lamprey </option>
<option value=" bfl ">  Lancelet  </option>
<option value=" cin ">  C.intestinalis  </option>
<option value=" spu ">  S.purpuratus  </option>
<option value=" cel ">  C.elegans </option>
<option value=" na  ">  C.brenneri  </option>
<option value=" cbr ">  C.briggsae  </option>
<option value=" na  ">  C.remanei </option>
<option value=" sja ">  C.japonica  </option>
<option value=" na  ">  P.pacificus </option>
<option value=" dme ">  D.melanogaster  </option>
<option value=" dsi ">  D.simulans  </option>
<option value=" dse ">  D.sechellia </option>
<option value=" dya ">  D.yakuba  </option>
<option value=" der ">  D.erecta  </option>
<option value=" dan ">  D.ananassae </option>
<option value=" dps ">  D.pseudoobscura </option>
<option value=" dpe ">  D.persimilis  </option>
<option value=" dvi ">  D.virilis </option>
<option value=" dmo ">  D.mojavensis  </option>
<option value=" dgr ">  D.grimshawi </option>
<option value=" aga ">  A.gambiae </option>
<option value=" ame ">  A.mellifera </option>
<option value=" na  ">  S.cerevisiae  </option>
<option value=" cel ">  worm  </option>
</select>           
           
     </div>
    
     </div>

       <div id="emailfd"  class="section" style="position:relative;top:10px;background-color:#DFE0DB;"> 

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
