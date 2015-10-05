#!/usr/bin/perl
use FindBin qw($Bin);
use File::Path;
use strict;
use File::Basename;
use Getopt::Std;
my %options=();
my $input;
my $output;
my $species;
my $species2;
getopts("a:i:o:r:s:p",\%options);
$species2 = "all";
$input = $options{'i'} if(defined $options{'i'});
$output = $options{'o'} if(defined $options{'o'});
$species = $options{'s'} if(defined $options{'s'});

print $species2."!!!!!!!!!!!!!!!!!!!!!!!$species\n";
$output = File::Spec->rel2abs($output);
system("export PATH=\$PATH:/home/bin/CAP-miRSEQ/binspace/bin");
system("perl $Bin/fastq2fasta.pl  $input> $output/$species\_reads.fa\n");

system("perl $Bin/collapse_reads_md.pl  $output/$species\_reads.fa $species > $output/$species\_reads.fa.collapsed");


system("perl $Bin/quantifier.pl -p $Bin/../referenece/hairpin.dna.fa -m $Bin/../referenece/mature.dna.fa -r $output/$species\_reads.fa.collapsed  -y now -t $species -q $output");
system("cp  $output/$species/$species\_now/$species\_reads_unalign_reads2precursor $output/$species2\_reads.fa");

print "perl $Bin/collapse_reads_md.pl  $output/$species2\_reads.fa $species > $output/$species2\_reads.fa.collapsed\n";
system("perl $Bin/collapse_reads_md.pl  $output/$species2\_reads.fa $species > $output/$species2\_reads.fa.collapsed");

print "perl $Bin/quantifier_2.pl -p $Bin/../referenece/hairpin.dna.fa -m $Bin/../referenece/mature.dna.fa -r $output/$species2\_reads.fa.collapsed  -y now -t $species2 -q $output\n";
system("perl $Bin/quantifier_2.pl -p $Bin/../referenece/hairpin.dna.fa -m $Bin/../referenece/mature.dna.fa -r $output/$species2\_reads.fa.collapsed  -y now -t $species2 -q $output");
system("perl $Bin/make_html.pl $output/expression_now.html   > $output/result");
