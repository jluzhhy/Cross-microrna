{{extends file="base.tpl"}}

{{block name="extra_js"}}
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
{{/block}}

{{block name="extra_style"}}
.dataTables_wrapper { min-height: 0; }
div#tabs div { max-height: 450px; }

ul li {margin: 10px 0;}
 
{{/block}}

{{block name="main"}}
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

        <img src="static/images/CAP-miRSeq_workflow.png" width="900px" height="444px" style="z-Index:-1;margin-left:30px">

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

     MIiRES (<strong>MicroRNA from exogenous species</strong>) detectect candidate <strong>microRNA</strong> from exogenous microrna by RNA-seq data. This website is freely available to all users and there is no login requirement. This server provides a suite of microRNA analysis functions, which are important to elucidating the mechanism of microrna influence:<br/><br/>  

        </p>
    

    </div>
    
    <div id="tabs-3">
      <p align="justify"><br/>
        Please cites the following papers if you use the result of the motif finding program:<br>

     
      </p>
    </div>
  </div>

</div>
{{/block}}

{{block name="foot"}}
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


{{/block}}
