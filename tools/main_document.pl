#!/usr/bin/perl


###########################################################################
## Description:
## a script to generate an HTML main document with CAP-miRSeq results
##
## Author: Jared Evans
## Date: 6/27/13
##
## Parameters:
## <run_info.txt> - The CAP-miRSeq run_info.txt config file
## <output file> - ouput HTML file name
## <sample_summary.txt> - table of per-sample statistics
## <SNVs called (0/1)> - Boolean to indicate whether SNVs were called in this analysis
## <trim adapter(0/1)> - Boolean to indicate whether adapters were trimmed in this analysis
## <diff expression analysis> - Optional colon seperated list of differential expression labels
##
############################################################################


use strict;
use warnings;
use Data::Dumper;

if (scalar(@ARGV) < 5)	
{
	die ( "USAGE: main_document.pl [run_info.txt] [output_file] [sample_summary.txt] [SNVs Called(0/1)] [trim adapter(0/1)] [diff expression analyses (optional)]\n" );
}


open RUN_INFO, "$ARGV[0]" or die "opening file: $ARGV[0]";
open OUT, ">", "$ARGV[1]" or die "opening file: $ARGV[1]";
open STATS, "$ARGV[2]" or die "opening file: $ARGV[2]";

my $snvs_called = $ARGV[3];
my $adapters_trimmed = $ARGV[4];
my $diff_expression_analyses = $ARGV[5] if defined $ARGV[5];
my %config = ();
my @diff_exprs = ();

if(defined $diff_expression_analyses){
	@diff_exprs = split(":",$diff_expression_analyses);
}

# read config variables
while(<RUN_INFO>){
	my $row = $_;
	chomp $row;
	my @line = split("=",$row);
	$config{$line[0]} = $line[1];
}

my @samples = split(":",$config{"SAMPLENAMES"});

#print Dumper(%config);

print OUT <<ENDHTML;
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CAP-miRseq | miRNA Analysis Main Document</title>
<style type="text/css">
html {
	height: 100%;
}
body {
	width: 100%;
	height: 100%;
	background: #fefefe;
	/*background-color: #fefefe;*/
	background-repeat: repeat;
	text-align: left;
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	font-family:verdana, Arial, Helvetica, sans-serif;
	font-weight: normal;
	color: #333;
	font-size: 12px;
}
h1,h2,h3 {
	font-family:Georgia, "Times New Roman", Times, serif;
}
ul {
	margin-bottom: 10px;
}
ul li {
	margin-bottom: 5px;
}
table {
	border: none;
}
td {
	padding: 5px 15px 5px 15px;
	margin: 0px 0px 0px 0px;
}
tr {

}
tr.shade {
	background: #ddd;
}
.strong {
	font-weight: bold;
	background: #ddd;
}
table.summary {
	font-size: 12px;
}
#wrapper {
	margin: 0px auto 0px auto;
	padding: 0px 50px 10px 100px;
}
#header {
	/*width: 800px;*/
	height: 100px;
	margin: 0px auto 0px auto;
	padding: 0px 50px 0px 100px;
	/*background: #444;*/
	/*background: #336699;*/
	background: #506987;
	text-align: left;
	font-family:Georgia, "Times New Roman", Times, serif;
}
#header h1 {
	color: #fefefe;
	font-size: 50px;
	margin: 0px 0px 0px 0px;
	padding: 5px 5px 5px 0px;
}
#header h3 {
	color: #fefefe;
	font-size: 20px;
	margin: 0px 0px 0px 0px;
	padding: 0px 5px 5px 0px;
}
#footer {
	margin: 0px auto 0px auto;
	padding: 10px 50px 20px 100px;
	background: #444;
	color: #fefefe;
}
#footer a{
	color: #fefefe;
}
</style>
</head>
<body>
<div id="header">
<h1>CAP-miRSeq <span style="font-size: 25px;">v1.1</span></h1>
<h3>Comprehensive Analysis Pipeline for miRNA-seq data</h3>
</div>
<div id="wrapper">
<h2>Project Overview</h2>
<table>

ENDHTML

my @date = localtime(time);
my $day = $date[3];
my $month = $date[4]+1;
my $year = $date[5]+1900;

my $finger_bin = `which finger` ; 

my @name ; 

if($finger_bin ne ""){
	chomp(my @finger = `finger $ENV{"USER"}`);
	my @name_row = split("Name:",$finger[0]);
	@name = split(";",$name_row[1]);
} else {
	my $whoami = `whoami`; 
	chomp($whoami);
	push(@name, $whoami);
} 


print OUT '<tr class="shade"><td>Date</td><td>'."$month/$day/$year".'</td></tr>
<tr><td>Number of Samples</td><td>'.scalar(@samples).'</td></tr>
<tr class="shade"><td>Genome Build</td><td>'.$config{"GENOME_BUILD"}.'</td></tr>
<tr><td>miRBase Version</td><td>'.$config{"MIRBASE_VERSION"}.'</td></tr>
<tr class="shade"><td>Analysis Performed By</td><td>'.$name[0].'</td></tr>';

print OUT '
</table>
<h2>Analysis Workflow</h2>
<img src="CAP-miRSeq_workflow.png" alt="CAP-miRseq Workflow Diagram" style="width:768px; height:576px;" />

<h2>Quality Control Reports</h2>
<ul>
';
if($adapters_trimmed){
	print OUT '<li><a href="qc/fastqc_pretrim"><strong>FASTQC Reports (Before Trimming)</strong></a></li>
';
}
print OUT '<li><a href="qc/fastqc_posttrim"><strong>FASTQC Reports (After Trimming)</strong></a></li>
<li><a href="qc/other_rna"><strong>Quantification of Other RNA</strong></a></li>
<li><a href="differential_expression/expression_boxplots.pdf"><strong>Differential Expression QC</strong></a></li>
</ul>

<h2>Sample Summary</h2>
<table class="summary">

';

# print sample summary table
my $header = 1;
my $shade = 1;
while(<STATS>){
	my $row = $_;
	chomp $row;
	my @line = split("\t",$row);
	my $class = "";
	if($header){
		$class = "class=\"strong\"";
		$header = 0;
	}
	if($shade){
		print OUT "<tr $class class=\"shade\">";
		$shade = 0;
	}else{
		print OUT "<tr>";
		$shade = 1;
	}
	foreach my $value (@line){
		print OUT "<td>".$value."</td>";
	}
	print OUT "</tr>\n";

}



print OUT '
</table>
<h2>Result Reports</h2>
<ul>
<li><a href="expression"><strong>Expression Reports (Merged With All Samples)</strong></a></li>
<ul>
<li><a href="expression/miRNA_expression_raw.xls">miRNA_expression_raw.xls</a> - Raw miRNA expression counts for each sample. Counts are weighted so if a read aligns equally well to two miRNA then they are each given a count of 0.5.</li>
<li><a href="expression/miRNA_expression_norm.xls">miRNA_expression_norm.xls</a> - Normalized miRNA expression counts for each sample. Expression counts are Counts per Million within each sample (1000000 * raw_counts/total_raw_counts).</li></li>
<li><a href="expression/mature_miRNA_expression.xls">mature_miRNA_expression.xls</a> - The mature miRNA that are found on multiple Precursors have been merged and their counts summed. This file can be useful for differential expression.</li>
<li><a href="expression/novel_miRNA.xls">novel_miRNA.xls</a> - Summary of the Novel miRNA predicted by miRDeep2 for each sample.</li>
</ul>
<li><a href="mirdeep2"><strong>miRDeep2 Reports (Individual Sample Reports)</strong></a></li>
<!--<p>Per-sample results from miRDeep2. The overall results are summarized in the Expression Report Excel sheets, but even more detail can be found in these miRDeep2 reports.</p>-->
<ul>
<li><strong>result.html</strong> - Novel and Known miRNA discovered by miRDeep2\'s prediction algorithm.</li>
<li><strong>expression.html</strong> - Raw and normalized expression counts for known miRNA.</li>
</ul>
';
if($snvs_called){
	print OUT '<li><a href="variants"><strong>Single-Nucleotide Variants (SNVs)</strong></a></li>
<ul>
<li><a href="variants/miRNA_variants.xls">miRNA_variants.xls</a> - miRNA SNV Report</li>
<li><a href="variants/mirna_variants.vcf">mirna_variants.vcf</a> - Raw VCF file</li>
</ul>
';
}

if(defined $diff_expression_analyses){
	print OUT '<li><a href="differential_expression"><strong>Differential Expression Reports</strong></a></li>
<ul>
';
	foreach my $de (@diff_exprs){
		print OUT '<li><a href="differential_expression/'.$de.'.differential_expression.xls">'.$de.'.differential_expression.xls</a> - Differential Expression Results for '.$de.' comparison.</li>
';
		print OUT '<li><a href="differential_expression/'.$de.'_plots.pdf">'.$de.'_plots.pdf</a> - Plots from '.$de.' differential expression.</li>
';
	}
	print OUT '</ul>
';
}

print OUT '</ul>
';
print OUT <<ENDHTML;
<h2>View Alignments in IGV</h2>
<ul>
<li><a href="igv/igv_session.xml"><strong>igv_session.xml</strong></a> - Open this session file in <a href="http://www.broadinstitute.org/software/igv/download">IGV</a> to view aligned reads.</li>
</ul>
<h2>What's Next?</h2>
<ul>
<li>Differentially expressed miRNAs among conditions</li>
<li>Integration with gene expression data</li>
<li>miRNA target identification</li>
<li>Pathway analysis (miRNA target canonical pathway or network analysis)</li>
<li>Variant/mutation identification in miRNA coding region</li>
</ul>
<h2>Useful Links</h2>
<ul>
<li><a href="http://bioinformaticstools.mayo.edu" target="_blank">CAP-miRseq</a></li>
<li><a href="http://www.mirbase.org" target="_blank">miRBase</a></li>
<li><a href="https://www.mdc-berlin.de/8551903/en/research/research_teams/systems_biology_of_gene_regulatory_elements/projects/miRDeep" target="_blank">miRDeep2</a></li>
<li><a href="http://www.broadinstitute.org/software/igv/download" target="_blank">Integrative Genomics Viewer (IGV)</a></li>
<li><a href="http://www.bioconductor.org/packages/2.13/bioc/html/edgeR.html" target="_blank">edgeR</a></li>

</ul>

</div>
<div id="footer">
<h2>About Mayo Bioinformatics</h2>
<p>Authorship Consideration: Advancing scientific research is a primary motivation of all bioinformaticians and acknowledgment of contribution through authorship on manuscripts arising from this analysis is one way our work is assessed and attributed. We request to be considered for authorship on any manuscripts using the analysis results provided if you believe we have made substantive intellectual contributions to the study.</p>
<p>Check out other tools at <a href="http://bioinformaticstools.mayo.edu" target="_blank">http://bioinformaticstools.mayo.edu</a></p>
</div>
</body>
</html>
ENDHTML


close RUN_INFO;
close OUT;
close STATS;


