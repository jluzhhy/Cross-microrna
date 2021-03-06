{{extends file="base.tpl"}}

{{block name="extra_style"}}

{{/block}}

{{block name="extra_js"}}

 <script type="text/javascript">


 var $J = jQuery.noConflict();
$J(document).ready(function(){ 


var c = 0;
var id ='';
var seq = '';
var processed = 0;
var object=new Set();
var selectfile=0;
$J("#seqdata").change(function(event){
selectfile++;
var total=0;
var discardbyqaulity=0;
var discardbylength=0;
document.getElementById("upfile3").value=document.getElementById("seqdata").value;
var qscore=document.getElementById("qs").value;
var d=new Date();
var prefix=d.valueOf();
$J("#file-listing").append("\<li\>\<div id\=\"progress\_bar"+prefix+"\"\>\<div id=\""+prefix+"\" class\=\"percent\"  \>0\%\<\/div\>\<\/div\>\<\/li\>");
  var progress = document.getElementById(prefix);

  function updateProgress(evt) {
    // evt is an ProgressEvent.
      // var percentLoaded = eval($J("#bar").val());
   
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100 / 2);
      // Increase the progress bar length.
   
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        progress.textContent =  percentLoaded + '%';
      }
    }
  }

 var file = document.getElementById("seqdata").files[0];
var leftsize=file.size;

var buffer=1024*300000;
var start=0;
var stop=0;
var newdata="";
var min1 = document.getElementById("min").value;
var max1 = document.getElementById("max").value;
var ik=0;
while(stop<leftsize)
 { var newdata="";
     var start = stop+1;
     var stop = start+buffer-1; 
     if(stop>leftsize)
       { stop=leftsize;
       }
   
     var file = document.getElementById("seqdata").files[0];
     var blob = file.slice(start, stop);
    
     var reader = new FileReader();
reader.onloadstart = function(e) {
      document.getElementById("progress_bar"+prefix).className = 'loading';
    };

reader.onload = function(e)
 {
        var text = reader.result;  
        var lines = text.split('\n');
        var hash={};
   for(var line = 0; line < lines.length; line++)
  	{
     		if(lines[line].match(/^\@/))
    		{  
       		 var lines2 = lines[line].split();
         	 id = lines2[0];
     		} 
     		else if(lines[line].match(/^[A|C|G|T|U]*$/gi))   
    		 {       total++;

       			 if(lines[line].length<= max1 && lines[line].length>= min1)
        			 {  seq = lines[line];
                                    
          			    line++;
           		            line++;   
           			    qaulity=lines[line];
           				var test=0;
           					for(var i=0;i<qaulity.length;i++)
             					{
                 					if((qaulity.charCodeAt(i)-64)<qscore)
                          					{      
                               						test=1;
                               						discardbyqaulity++;
                          					}
            				        }
                    			if(test==0)
                   			{
                       				if(hash[seq] ===undefined)
                         				{
                              					 hash[seq]=1;    
                         				}
                       				else
                         				{
								hash[seq]=hash[seq]+1;
                         				}
                    			}
                     		     id ='';
                     		     seq ='';
           			  }
      			else
 				{
					discardbylength++;
				}
        	}
        }
       
    
	for (var k in hash) 
	{
		if (hash.hasOwnProperty(k)) 
			{
     				 processed++;
       				 newdata=newdata+">seq_"+processed+"_x"+hash[k]+"\n"+k+"\n";
    			}
	}
        
        var filename=prefix;
         
         object.add(prefix);
       $J.ajax({url: "prepare_file.php",
          type: 'POST',
          data: {data: newdata, filename:filename, seq:ik },
          success: function(data, textStatus, xhr) {
        var percentseq=50/ik;
      
        if(data<ik)
        { progress.style.width = 50+eval(data)*percentseq+"%";
        progress.textContent =50+eval(data)*percentseq+"%";
      
        }
        else
          { progress.style.width = "100%";
        progress.textContent ="100%";
             document.getElementById("upfile3").value="";
                 progress.innerHTML = document.getElementById("seqdata").value+"    \<input type\=\"checkbox\" name\=\"controls\[\]\" class=\"CLASS\" value\="+prefix+"\<\/\> is control?  \<input type\=\"text\" name\=\"controls2\[\]\" class=\"CLA\" value\=\"sample"+selectfile+"\"\\\>";
           }
          }   
          
        });

//alert(discard+"!"+total);
  
}
    
 reader.onprogress = updateProgress;
     
 reader.onloadend = function (evt) 
    {
              progress.style.width = '50%';
        progress.textContent ='50%';  
     
    }
     
     ik++;
  
     reader.readAsText(blob);

   }
 
       
     
});


$J("form").submit(function(form) {
 form.preventDefault();
i=0;
var sData ={}
$J.each($J('.CLASS').serializeArray(), function() {
    sData[i]=this.value;
    i++;
  
});  
i=0;
var sData2 ={}
$J.each($J('.CLA').serializeArray(), function() {
    sData2[i]=this.value;
    i++;
  
}); 
//var sData2 =  $J('.CLA').serializeArray();
var allfile=[];
i=0;
object.forEach(function(value) 
{
allfile[i]=value;
i++;
});


 $J.ajax({url: "prepare_job.php",
          type: 'POST',
          data: { allfile:allfile, selectedfile:sData,tags:sData2, species: $J("#species").val(),species2: $J("#species2").val(),email: $J("#email").val() },
          success: function(data) {window.location.href=data;alert(data);}
    });

 
});
});
      
</script>

{{/block}}

{{block name="main"}}
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
                <td witdh="200px"><input name="max" type="text" id="max" size="5" value="300" ></input></td>
                <td></td>
              </tr>
                 <tr>
                <td witdh="200px">&nbsp;3' Adatptor:</td>
                <td witdh="200px"><input name="ada" type="text" id="ada" size="15" value="" ></input></td>
                <td></td>
              </tr>
                
              <tr>
                <td witdh="200px">&nbsp;Quality score:</td>
                <td witdh="200px"><input name="qs" type="text" id="qs" size="5" value="0" ></input></td>
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
{{/block}}
