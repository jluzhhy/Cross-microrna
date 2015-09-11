{{extends file="base.tpl"}}

{{block name="extra_style"}}

{{/block}}

{{block name="extra_js"}}
  <script type="text/javascript" src="static/js/motif_annotate.js">
  
</script>

{{/block}}

{{block name="main"}}
  <style type="text/css">
          .input_file{position:absolute;opacity:0;filter:alpha(opacity=0);cursor:pointer;width:385px;height:30px;}      
  </style>
 
    
  <div id="content">
  <input id="samplep" type="hidden" value="{{$sample}}"/>

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
{{/block}}
