<?php /* Smarty version Smarty-3.0.7, created on 2015-09-09 23:39:53
         compiled from ".\templates\motif_annotate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3230255f0fb89b036e8-99504615%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '388355fea4e2508f01c3f8bee04c9b22f60b8d3a' => 
    array (
      0 => '.\\templates\\motif_annotate.tpl',
      1 => 1423563547,
      2 => 'file',
    ),
    '50da811edd0e07e65507282cf2fea5e9d6f55598' => 
    array (
      0 => '.\\templates\\base.tpl',
      1 => 1397657167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3230255f0fb89b036e8-99504615',
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
        <li class="middle<?php if ($_smarty_tpl->getVariable('section')->value=='Submitjobs'){?> current<?php }?>"><a href="annotate.php" alt="Submit data">Submit</a></li>
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
   <input id="samplepp1" type="hidden" value="<?php echo $_smarty_tpl->getVariable('sample1')->value;?>
"/>
  <input id="samplep1" type="hidden" value="<?php echo $_smarty_tpl->getVariable('promoter')->value;?>
"/>
  <input id="mp3sample" type="hidden" value="<?php echo $_smarty_tpl->getVariable('promoterm')->value;?>
"/>
  <input id="sm1" type="hidden" value="<?php echo $_smarty_tpl->getVariable('motif_alignment')->value;?>
"/>
  <input id="sm2" type="hidden" value="<?php echo $_smarty_tpl->getVariable('motif_matrix')->value;?>
"/>
  <input id="sm3" type="hidden" value="<?php echo $_smarty_tpl->getVariable('motif_consensus')->value;?>
"/>
  <div id="tabs" >
    <ul>
      <li><a href="#tabs-1">Motif Finding</a></li>
      <li><a href="#tabs-2">Motif Scan</a></li>
      <li><a href="#tabs-3">Motif Compare</a></li>
       <li><a href="#tabs-4" onclick="javascript:setMP3(this)">Motif MP3</a></li>
       <li><a href="#tabs-5" onclick="javascript:setregulon(this)">Regulon finding</a></li>
    </ul>
   <div id="tabs-1" style="background-color:#CED8F6;" >

      
 
        <form action="motif_prediction.php" method="post" enctype="multipart/form-data" name="form1">
        
           <div id="work" class="section" style="position:relative;background-color:#DFE0DB;display:none;">
           <h2>Select Function</h2><br/>
          <select name="specp" id="specp" style="position:relative;width:388px;left:10px;">
          <option value="1"  selected = "selected" > <i>De novo</i> Motif finding</option>
          <option value="2"> <i>De novo</i> Motif finding with background sequencess</option>
          <option value="3">Motif finding with a comparative genomic framework</option>
          </select>
          </div>
        
  
   <div id="query" class="section" style="position:relative;background-color:#DFE0DB;">
      <h2>Input query sequences</h2><br/>
   <div id="Inputsequence"  style="position:relative;">
            

             &nbsp;&nbsp;<strong>Enter FASTA sequences.</strong>&nbsp; <img src='static/images/que.png' title="The input is a set of regulatory sequences (e.g. promoters) in the FASTA format." style="position:relative;padding-top:0px;height:15px;" /> <span id="sa1" style="cursor:default;" ><U><font color="blue">Sample</font></U></span>&nbsp;<span id="sc1" style="cursor:default;"><U><font color="blue">Clear</font></U></span> <span id="sfda"> <U><font color="#FD9002"> Select from DOOR</font></U></span><br/>
                <?php if ($_smarty_tpl->getVariable('sequences')->value==">end"){?>
             
              <textarea name="sequence" id="sequencef" style="position:relative;left:10px;width:385px;height:100px;"></textarea>
           
             <?php }?>
            <?php if ($_smarty_tpl->getVariable('sequences')->value!=">end"){?>
             
            <textarea name="sequence" id="sequencef" style="position:relative;left:10px;width:385px;height:100px;"><?php echo $_smarty_tpl->getVariable('sequences')->value;?>
</textarea>
          
             <?php }?>
            
            <br/>
            &nbsp; <strong>OR upload data</strong><br/>
             <div style="position:relative;">
            &nbsp; <input name="fnafile" type="file" id="fnafile"  onchange="upfile3.value=this.value" class="input_file" />
              <input type="text"  name="upfile3" style="width:386px;"  readonly />            
              </div>
      
                 <div id="gpfd0"  style="position:relative;width:900px;top:5px;display:none;">
                      <div id="showspeciesfd0">
                        <br/>
         <iframe name="myframegpfd0" id="myframegpfd0" style="border: 0px solid black" src="preparedoor.php?st=0" width="100%" height="500">
         </iframe>
                      </div>
        
              </div>
             
    </div>
    
 
       
   </div>
   

    
     <div id="querycontrol" class="section" style="position:relative;background-color:#DFE0DB;">
      <span id="qcop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" />Include control sequences (optional)</h2></span><br/>
            <div id="control" style="position:relative;display:none;">
          <br/>                                                                                                                                                                                                                                                          
          &nbsp;&nbsp;<strong>Enter FASTA sequences for background.</strong>&nbsp;<img src='static/images/que.png' title="You can use a set of randomly generated sequences as control sequences, or select a whole genome from DOOR" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa2" style="cursor:default;" ><U><font color="blue">Sample</font></U></span>&nbsp;<span id="sc2" style="cursor:default;"><U><font color="blue">Clear</font></U></span></span>&nbsp;&nbsp;<span id="sfdb"><U><font color="#FD9002"> Select from DOOR</font></U></span><br/>
         
          <textarea name="sequence1" id="sequence1" style="position:relative;left:10px;width:385px;height:100px;" ></textarea>
          <br/>  
          &nbsp; <strong>OR upload data</strong><br/>
           
          <div style="position:relative;">
         &nbsp; <input name="bkgfilef" type="file" id="bkgfilef"  onchange="upfile2.value=this.value" class="input_file" />
          <input type="text"  name="upfile2" style="width:386px;"  readonly />
          </div>
          
          <div id="gpfd1"  style="position:relative;width:900px;top:5px;display:none;">
                    <div id="showspeciesfd1">
                          <br/>
                          <iframe name="myframegpfd1" id="myframegpfd1" style="border: 0px solid black" src="controldoor.php?st=0" width="100%" height="500">
                          </iframe>
                  </div>      
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
         &nbsp;<strong>E-mail</strong>&nbsp;(optional):<input name="emailf" type="text" id="emailf" size="60" style="position:relative;left:10px;"/>
              &nbsp;
              <input type="reset" name="Submit2"  value="Cancel" />
              <input type="submit" name="Submit"  value="Submit" />
       </div>
              
          
    </form>

<div id="organism" class="section" style="position:relative;top:5px;display:none;">
        <div id="showspecies">
          <h2><strong>Prepare data from DOOR database:</strong><input type="button" id="preparedata"  value="Prepare"/></h2>
         <iframe name="myframe" style="border: 0px solid black" src="targetspecies.php" width="100%" height="500">
         </iframe>
       </div>
        
</div>
 


     <div class="section" id="rdiv" style="position:relative;background-color:#DFE0DB;display:none;">
      <span id="rop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" /><strong>Set parameters</strong></h2></span><br/>     
    <div id="optionr" class="section" style="display:none;">
            <table border="0">
              <tr>
                <td witdh="200px">&nbsp;Minimal motif length:</td>
                <td witdh="200px"><input name="minr" type="tsize="5"ext" id="minr" size="5" value="12" ></input> </td>
                <td></td>
              </tr>
                <tr>
                <td witdh="200px">&nbsp;Maximal motif length:</td>
                <td witdh="200px"><input name="maxr" type="text" id="maxr" size="5" value="12" ></input></td>
                <td></td>
              </tr>
                 <tr>
                <td witdh="200px">&nbsp;Number of output motifs:</td>
                <td witdh="200px"><input name="numr" type="text" id="numr" size="5" value="10" ></input></td>
                <td></td>
              </tr>
              
            </table>
    </div>
    </div>
        <br/>
        <div id="emailrd" class="section" style="position:relative;background-color:#DFE0DB;display:none;">
        <h2>Submit job</h2>
         <br/> 
         
       &nbsp;Please leave your email if submitting too many sequences; you will be notified by email when the job is done.<br/>
        &nbsp;<strong>E-mail</strong>&nbsp;(optional):<input name="emailr" type="text" id="emailr" size="60" style="position:relative;left:10px;"/>
          &nbsp; <input type="reset" name="Submit4"  value="Cancel" />
              <input type="submit" name="Submit3"  value="Submit" "/> 
       
        </div> 

</form> 


       
   </div>
  
 <div id="tabs-2" style="background-color:#CED8F6;">
                  
  
        <form action="motif_scan.php" method="post" enctype="multipart/form-data" name="form1">
        
           <div id="work0" class="section" style="position:relative;background-color:#DFE0DB;">
          <h2>Input query motifs</h2><br/>
          &nbsp;&nbsp;<strong>Select motif format</strong><br/>
           <select name="specm" id="specm"  style="position:relative;width:388px;left:10px;">
          <option value="1"  selected = "selected">motif alignment</option>
          <option value="2" >motif matrix</option>
          <option value="3" >motif consensus</option>
          </select>
           <span id="background" style="position:relative;left:5px;display:none;">&nbsp; with background?</span>
         <select name="spec2" id="spec2" style="position:relative;left:5px;display:none;" >
          <option value="Y" >Yes</option>
          <option value="N" selected>No</option>
          </select>
          <br/>
          <br/>
           <div id="Motifsequence"  style="position:relative;width:900px;">
            
          &nbsp;<strong> Enter motif </strong>
            <span id="m0" style="position:relative;"><strong>  alignment </strong>  <img src='static/images/que.png' title="The input is a set of provided motifs, represented as aligned motif instances (Supplementary Table S2)" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa3" style="cursor:default;" ><U><font color="blue">Sample</font></U></span></span>
              <span id="m1" style="position:relative;display:none;"><strong>  matrix </strong> <img src='static/images/que.png' title="The input is a set of provided motifs, represented as motif count matrixs (Supplementary Table S4)" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa4" style="cursor:default;"><U><font color="blue">Sample</font></U></span></span>
              <span id="m2" style="position:relative;display:none;"><strong> consensus </strong> <img src='static/images/que.png' title="The input is a set of provided motifs, represented as motif consensus (Supplementary Table S3)" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa5" style="cursor:default;"><U><font color="blue">Sample</font></U></span></span>&nbsp;<span id="sc3" style="cursor:default;"><U><font color="blue">Clear</font></U></span><br/>
             
              <?php if ($_smarty_tpl->getVariable('motifs')->value==">end"){?>
             
             <textarea name="sequence23" id="sequence23" style="position:relative;width:385px;left:10px;height:100px;"></textarea>
           
             <?php }?>
            <?php if ($_smarty_tpl->getVariable('motifc')->value!=">end"){?>
             
            <textarea name="sequence23" id="sequence23" style="position:relative;width:385px;left:10px;height:100px;"><?php echo $_smarty_tpl->getVariable('motifs')->value;?>
</textarea>
          
             <?php }?>
             <br/>
            &nbsp;<strong> OR upload data</strong><br/>
           
             <div style="position:relative;">
             &nbsp;<input name="fnafile" type="file" id="fnafile"  onchange="upfile4.value=this.value" class="input_file" />
              <input type="text"  name="upfile4" style="width:385px;"  readonly /> 
              
              </div>
          
             
    </div>
          
          
          </div>
      
      <div class="section" style="background-color:#DFE0DB;">
      <h2>Input query sequences</h2><br/> 
   
    <div id="Targetsequence"  style="position:relative;width:900px;">
             &nbsp;<strong>Enter FASTA sequences. &nbsp;</strong> <img src='static/images/que.png' title="The input is a set of to-be-scanned DNA sequences in the FASTA format." style="position:relative;padding-top:0px;height:15px;" /> <span id="sa6" style="cursor:default;" ><U><font color="blue">Sample</font></U></span>&nbsp;<span id="sc4" style="cursor:default;"><U><font color="blue">Clear</font></U></span><span id="sfdc"><U><font color="#FD9002"> Select from DOOR</font></U></span><br/>
             <textarea name="sequence13" id="sequence13" style="position:relative;width:385px;left:10px;height:100px;"></textarea>
              <br/>
             &nbsp;<strong> OR upload data</strong><br/>
             <div style="position:relative;">
             &nbsp;<input name="tgfile" type="file" id="tgfile"  onchange="upfile5.value=this.value" class="input_file" />
              <input type="text"  name="upfile5" style="width:385px;"  readonly />          
              </div>
            <div id="gpfd2" class="Getpromoters" style="position:relative;width:900px;top:5px;display:none;">
        <div id="showspeciesfd2">
        <br/>
         <iframe name="myframegpfd2" id="myframegpfd2" style="border: 0px solid black" src="preparedoor.php?st=0" width="100%" height="500">
         </iframe>
       </div>      
           </div>
      
    </div>
<br/>
      <div id="control1" style="position:relative;width:900px;display:none;">
         <br/>
         &nbsp;<strong>Enter FASTA sequences for background. </strong><span id="sa7" style="cursor:default;" ><U><font color="blue">Sample</font></U></span>&nbsp;<span id="sc5" style="cursor:default;"><U><font color="blue">Clear</font></U></span><br/>
         <textarea name="sequences2" id="sequence2" style="position:relative;width:385px;left:10px;height:100px;" ></textarea> 
             <span style="position:relative;left:25px;top:-50px;">or get data from</span>&nbsp;&nbsp;<span id="sfdd"> <img src="static/images/door.png" width="200px" height="100px" ></span><br/>
          &nbsp;&nbsp;<strong> OR upload data</strong><br/>
          <div style="position:relative;">
          &nbsp;<input name="bkgfiles" type="file" id="bkgfiles"  onchange="upfile6.value=this.value" class="input_file" />
          <input type="text"  name="upfile6" style="width:385px;"  readonly />
          </div>
                <div id="gpfd3" class="Getpromoters" style="position:relative;width:900px;top:5px;display:none;">
        <div id="showspeciesfd3">
        <br/>
         <iframe name="myframegpfd3" id="myframegpfd3" style="border: 0px solid black" src="controldoor.php?st=0" width="100%" height="500">
         </iframe>
       </div>   

     </div>
    </div>
    <br/> 
</div>
   
     
          
     <div class="section" id="sdiv" style="position:relative;background-color:#DFE0DB;display:none;">
      <span id="sop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" /><strong>Set parameters</strong></h2></span><br/>
        
          <div id="options" style="position:relative;display:none;">
             <table border="0">
              <tr>
                <td witdh="200px">&nbsp;motif conservation level:</td>
                <td witdh="200px"><input name="mp" type="text" id="mp" size="5" value="0.8" style="position:relative;left:5px;"></input> 
            <span id="range" style="position:relative;left:5;"> [0.7,1]</span>   
            </td>
                <td></td>
              </tr>
            </table>
          
           </div>
     </div>
       
   <div id="emailsd" class="section" style="position:relative;background-color:#DFE0DB;">
   <h2>Submit job</h2><br/> 
   
       &nbsp;Please leave your email if submitting too many sequences; you will be notified by email when the job is done.</br/>
        &nbsp;<strong>E-mail</strong>&nbsp;(optional):</span><input name="emails" type="text" id="emails" size="60" style="position:relative;left:10px;"/>
              &nbsp; <input type="reset" name="Submit2"  value="Cancel" />
              <input type="submit" name="Submit"  value="Submit" /> 
   </div>
 
 
</form>



</div> 




<div id="tabs-3" style="background-color:#CED8F6;" >
            
   <form action="motif_compare.php" method="post" enctype="multipart/form-data" name="form3">
         <div class="section" style="background-color:#DFE0DB;">
            <h2>Input query motifs</h2><br/>
           &nbsp;&nbsp;<strong>Select motif format</strong><br/>
           &nbsp;
           <?php if ($_smarty_tpl->getVariable('stt')->value=="2"){?>
           <select name="specm3" id="specm3"  style="position:relative;width:388px;">
          <option value="1"  >motif alignment</option>
          <option value="2"  selected = "selected">motif matrix</option>
          <option value="3"  >motif consensus</option>
           </select>
           <?php }?>
           
           <?php if ($_smarty_tpl->getVariable('stt')->value=="3"){?>
          <select name="specm3" id="specm3"  style="position:relative;width:388px;">
          <option value="1"  >motif alignment</option>
          <option value="2"  >motif matrix</option>
          <option value="3"  selected = "selected">motif consensus</option>
           </select>
           <?php }?>
           
          <?php if ($_smarty_tpl->getVariable('stt')->value=="1"){?>
          <select name="specm3" id="specm3"  style="position:relative;width:388px;">
          <option value="1"  selected = "selected">motif alignment</option>
          <option value="2"  >motif matrix</option>
          <option value="3"  >motif consensus</option>
           </select>
           <?php }?>
           
           <?php if ($_smarty_tpl->getVariable('stt')->value=="0"){?>
          <select name="specm3" id="specm3"  style="position:relative;width:388px;">
          <option value="1"  selected = "selected">motif alignment</option>
          <option value="2"  >motif matrix</option>
          <option value="3"  >motif consensus</option>
           </select>
           <?php }?>
        
        <div style="visibility:hidden">
        <?php if ($_smarty_tpl->getVariable('motifcistg')->value=="Y"){?>
         <select name="spec2c" id="spec2c" style="position:relative;left:5px;" >
          <option value="Y" selected >Yes</option>
          <option value="N" >No</option>
          </select>
        <?php }else{ ?>
          <select name="spec2c" id="spec2c" style="position:relative;left:5px;" >
          <option value="Y" >Yes</option>
          <option value="N" selected>No</option>
          </select>
        <?php }?>
            </div>
           <div id="Motifsequence3"  style="position:relative;width:900px;">
                 &nbsp;<strong> Enter motif </strong>
            <span id="m03" style="position:relative;"><strong>  alignment </strong> <img src='static/images/que.png' title="The input is a set of motifs to be compared, in the same formats as the ones for the motif-scan function (Supplementary Table S2)" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa8" style="cursor:default;" ><U><font color="blue">Sample</font></U></span></span>
              <span id="m13" style="position:relative;display:none;"><strong>   matrix </strong> <img src='static/images/que.png' title="The input is a set of motifs to be compared, in the same formats as the ones for the motif-scan function (Supplementary Table S4)" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa10" style="cursor:default;" ><U><font color="blue">Sample</font></U></span></span>
              <span id="m23" style="position:relative;display:none;"><strong>   consensus </strong> <img src='static/images/que.png' title="The input is a set of motifs to be compared, in the same formats as the ones for the motif-scan function (Supplementary Table S3)" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa11" style="cursor:default;" ><U><font color="blue">Sample</font></U></span></span>&nbsp;<span id="sc6" style="cursor:default;"><U><font color="blue">Clear</font></U></span><br/>
              <?php if ($_smarty_tpl->getVariable('motifc')->value==">end"){?>
             
             <textarea name="sequence23c" id="sequence23c" style="position:relative;width:385px;left:10px;height:100px;"></textarea>
           
             <?php }?>
            <?php if ($_smarty_tpl->getVariable('motifc')->value!=">end"){?>
             
             <textarea name="sequence23c" id="sequence23c" style="position:relative;width:385px;left:10px;height:100px;"><?php echo $_smarty_tpl->getVariable('motifc')->value;?>
</textarea>
          
             <?php }?>
        <br/>
           
           &nbsp;<strong> OR upload data</strong><br/>
          
             <div style="position:relative;">
             &nbsp;<input name="fnafile3" type="file" id="fnafile3"  onchange="upfile43.value=this.value" class="input_file" />
              <input type="text"  name="upfile43" style="width:385px;"  readonly /> 
             </div>
   
        </div>
         
         
          </div>
          
        <div class="section" style="background-color:#DFE0DB;">
        <span id="ccop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" />Include host DNA sequences (optional)</h2></span><br/>
  
        <div id="Targetsequence3"  style="position:relative;width:900px;display:none;">
        &nbsp;<strong>Enter FASTA sequences&nbsp;</strong> <img src='static/images/que.png' title="Enter the original DNA sequences of the motifs if so chosen" style="position:relative;padding-top:0px;height:15px;" /> <span id="sa9" style="cursor:default;"><U><font color="blue">Sample</font></U></span>&nbsp;<span id="sc7" style="cursor:default;"><U><font color="blue">Clear</font></U></span><br/>
                 
            <?php if ($_smarty_tpl->getVariable('motifctg')->value==">end"){?>
             
             <textarea name="sequence13c" id="sequence13c" style="position:relative;width:385px;left:10px;height:100px;"></textarea>
           
             <?php }?>
            <?php if ($_smarty_tpl->getVariable('motifctg')->value!=">end"){?>
             
             <textarea name="sequence13c" id="sequence13c" style="position:relative;width:385px;left:10px;height:100px;"><?php echo $_smarty_tpl->getVariable('motifctg')->value;?>
</textarea>
          
             <?php }?>
             
          <br/>      
       &nbsp; <strong> OR upload data</strong><br/>
          
             <div style="position:relative;">
             &nbsp;<input name="tgfile3" type="file" id="tgfile3"  onchange="upfile53.value=this.value" class="input_file" />
              <input type="text"  name="upfile53" style="width:385px;"  readonly />          
              </div>
    <div id="gpfd4" class="Getpromoters" style="position:relative;width:900px;top:5px;display:none;">
        <div id="showspeciesfd4">
        <br/>
         <iframe name="myframegpfd4" id="myframegpfd4" style="border: 0px solid black" src="preparedoor.php?st=0" width="100%" height="500">
         </iframe>
       </div>   

     </div>
             
    </div>
    
    
  </div>
        <div class="section" id="cdiv" style="position:relative;background-color:#DFE0DB;">
      <span id="cop"><h2><img src="static/images/plus.png" style="height:10px;width:10px;" /><strong>Set parameters</strong></h2></span><br/>
           <div id="optionc" style="position:relative;width:900px;display:none;">
            <table border="0">
               <tr>
                <td witdh="200px">&nbsp;thresholds T1:</td>
                <td witdh="200px">
               <input name="ct2" type="text" id="ct2" size="5" value="0.8" style="position:relative;left:5px;"></input>   
               </td>
                <td></td>
              </tr>
              <tr>
                <td witdh="200px">&nbsp;thresholds T2:</td>
                <td witdh="200px">
                  <input name="ct1" type="text" id="ct1" size="5" value="0.4" style="position:relative;left:5px;"></input>    
               </td>
                <td></td>
              </tr>
              
            </table>
            <br/>
            <p>The two similarity thresholds in the clustering algorithm are set at T1 = 0.8 and T2 = 0.4 as default based on our analyses of the documented motif pairs in the RegulonDB database. Specifically, we have compared each pair of documented motifs in that database, and 0.4 and 0.8 correspond to the median and the upper quartile of all the similarities, respectively.</p>
            <br/>
          </div>
      </div>     
       <div id="emailcd" class="section" style="position:relative;background-color:#DFE0DB;"> 
             <h2>Submit job</h2><br/> 
             
               &nbsp; Please leave your email if submitting too many sequences; you will be notified by email when the job is done.<br/>
              &nbsp;<strong> E-mail</strong>&nbsp;(optional):<input name="emailc" type="text" id="emailc" size="60" style="position:relative;left:10px;"/>
              &nbsp;<input type="reset" name="Submit23"  value="Cancel" />
              <input type="submit" name="Submit3"  value="Submit" /> 

             
        </div>
      </form>
      

</div> 
 
 <div id="tabs-4" style="background-color:#CED8F6;" onclick="javascript:setMP3(this)" >
                 <form action="motif_mp3.php?jobid=<?php echo $_smarty_tpl->getVariable('jobid')->value;?>
" method="post" enctype="multipart/form-data" name="form3">
     <div class="section" style="background-color:#DFE0DB;">
           <span id="mp3sfdb"><h2>Select from DOOR</font></h2></span><br/>
    <div id="gpfd4m" class="Getpromoters" style="position:relative;width:900px;top:5px;display:inline">
        <div id="showspeciesfd4m">
            <br/>
                <iframe name="myframegpfd4m" id="myframegpfd4m" style="border: 0px solid black" src="preparedoor.php?st=0" width="100%" height="500">
                </iframe>
        </div>   
        </div>
    </div>
          
        <div class="section" style="background-color:#DFE0DB;">
            <span id="mp3s1"><h2>Or include pholygenetic footprinting DNA sequences </h2></span><br/>
  
        <div id="mp3t"  style="position:relative;width:900px;">
               &nbsp;&nbsp;<strong>Enter FASTA sequences.</strong>&nbsp;<img src='static/images/que.png' title="You can use a set of pholygenetic footprinting DNA sequences as input sequences, or select a whole genome from DOOR" style="position:relative;padding-top:0px;height:15px;" /> <span id="mp3sa2" style="cursor:default;" ><U><font color="blue">Sample</font></U></span>&nbsp;<span id="mp3sc2" style="cursor:default;"><U><font color="blue">Clear</font></U></span></span>&nbsp;&nbsp;<br/>
                 <textarea name="mp3t1" id="mp3t1c" style="width:385px;height:100px;"></textarea>
                 <br/>      
                &nbsp; <strong> OR upload data</strong><br/>
                  <div style="position:relative;">
                   &nbsp;<input name="tgfilem4" type="file" id="tgfilem4"  onchange="upfile53m.value=this.value" class="input_file" />
                   <input type="text"  name="upfile53m" style="width:385px;"  readonly />          
                  </div>
        </div>
    
             
    </div>
    

           <div id="emailmp" class="section" style="position:relative;background-color:#DFE0DB;"> 
             <h2>Submit job</h2><br/> 
             
               &nbsp; Please leave your email if submitting too many sequences; you will be notified by email when the job is done.<br/>
              &nbsp;<strong> E-mail</strong>&nbsp;(optional):<input name="emailmp" type="text" id="emailmp" size="60" style="position:relative;left:10px;"/>
              &nbsp;<input type="reset" name="Submitmp"  value="Cancel" />
              <input type="submit" name="Submitmp2"  value="Submit" /> 

             
        </div>
     
       
      </form>
      
  
  </div> 
   
   <div id="tabs-5" style="background-color:#CED8F6;" >
                 <form action="motif_regulon.php" method="post" enctype="multipart/form-data" name="form4">
    <?php if ($_smarty_tpl->getVariable('NC')->value==''){?>
     <div class="section" style="background-color:#DFE0DB;">
           <span id="regulonsfdb"><h2>Select from DOOR</font></h2></span><br/>
    <div id="regulongpfd" class="Getpromoters" style="position:relative;width:900px;top:5px;display:inline">
        <div id="regulonshowspeciesfd">
            <br/>
                <iframe name="myframegpfdregulon" id="myframegpfdregulon" style="border: 0px solid black" src="preparedoor.php?st=0" width="100%" height="500">
                </iframe>
        </div>   
        </div>
    </div>
     <?php }else{ ?>     
        <div class="section" style="background-color:#DFE0DB;">
            <span id="regulons1"><h2>Or include pholygenetic footprinting DNA sequences </h2></span><br/>
  
        <div id="regulont"  style="position:relative;width:900px;">
               
               &nbsp;&nbsp;<strong>Enter selected species and genes.</strong>&nbsp;<img src='static/images/que.png' title="Please list all the candidate genes" style="position:relative;padding-top:0px;height:15px;" /> <span id="regulonsa2" style="cursor:default;" ><U><font color="blue">Sample</font></U></span>&nbsp;<span id="regulonsc2" style="cursor:default;"><U><font color="blue">Clear</font></U></span></span>&nbsp;&nbsp;<br/>
                 <textarea name="regulont1" id="regulont1c" style="width:385px;height:100px;">Selected species:<?php echo $_smarty_tpl->getVariable('NC')->value;?>
&#13;&#10;Selected genes:<?php echo $_smarty_tpl->getVariable('genelist')->value;?>
</textarea><br/><br/>
                
               &nbsp; <strong> OR upload data</strong><br/>
                  <div style="position:relative;">
                   &nbsp;<input name="tgfiler4" type="file" id="tgfiler4"  onchange="upfile53r.value=this.value" class="input_file" />
                   <input type="text"  name="upfile53r" style="width:385px;"  readonly />          
                  </div>     
                
        </div>
    
             
    </div>
        

           <div id="emailmr" class="section" style="position:relative;background-color:#DFE0DB;"> 
             <h2>Submit job</h2><br/> 
             
               &nbsp; Please leave your email if submitting too many sequences; you will be notified by email when the job is done.<br/>
              &nbsp;<strong> E-mail</strong>&nbsp;(optional):<input name="emailmr" type="text" id="emailmr" size="60" style="position:relative;left:10px;"/>
              &nbsp;<input type="reset" name="Submitmr"  value="Cancel" />
              <input type="submit" name="Submitmr2"  value="Submit" /> 

             
        </div>
      <?php }?>
       
      </form>
      
  
  </div> 
  
      
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
