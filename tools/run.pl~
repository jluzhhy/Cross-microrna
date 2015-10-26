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
#system("perl $Bin/fastq2fasta.pl  $input> $output/$species\_reads.fa\n");
  print STDERR ("totalreads to precursor");

#system("perl $Bin/collapse_reads_md.pl  $output/$species\_reads.fa $species > $output/$species\_reads.fa.collapsed");
  system("bowtie  -f -v 1 -a --best --strata --al $output/align_reads2precursor.fa --un $output/unalign_reads2precursor.fa --norc $Bin/../referenece/hairpin $output/totalreads.fa $output/reads_mapped2precursor.bwt");
print STDERR ("totalreads to genome");
 system("bowtie  -f -v 1 -a --best --strata --al $output/align_reads2genome.fa --un $output/unalign_reads2genome.fa  $Bin/../referenece/hg38/hg38 $output/totalreads.fa $output/reads_mapped2genome.bwt");
print STDERR ("totalreads to trna");
system("bowtie  -f -v 1 -a --best --strata --al $output/align_reads2trna.fa --un $output/unalign_reads2trna.fa  $Bin/../referenece/trna/trna $output/totalreads.fa $output/reads_mapped2trna.bwt");

print STDERR ("alignreads2precursor to genome");
 system("bowtie  -f -v 1 -a --best --strata  $Bin/../referenece/hg38/hg38 --un $output/unalign_align_reads_precursor2genome.fa $output/align_reads2precursor.fa $output/align_reads_precursor2genome.bwt");
print STDERR ("unalignreads2precursor to genome");
 system("bowtie  -f -v 1 -a --best --strata  $Bin/../referenece/hg38/hg38 $output/unalign_reads2precursor.fa $output/unalign_reads_precursor2genome.bwt");
system("perl $Bin/maketable2.pl -o $output -s $species");
print STDERR ("perl $Bin/maketable2.pl -o $output -s $species");
#system("perl $Bin/quantifier.pl -p $Bin/../referenece/hairpin.dna.fa -m $Bin/../referenece/mature.dna.fa -r $output/$species\_reads.fa  -y now -t $species -q $output");
#system("cp  $output/$species/$species\_now/$species\_reads_unalign_reads2precursor $output/$species2\_reads.fa");

#print "perl $Bin/collapse_reads_md.pl  $output/$species2\_reads.fa $species > $output/$species2\_reads.fa.collapsed\n";
#system("perl $Bin/collapse_reads_md.pl  $output/$species2\_reads.fa $species > $output/$species2\_reads.fa.collapsed");

#print "perl $Bin/quantifier_2.pl -p $Bin/../referenece/hairpin.dna.fa -m $Bin/../referenece/mature.dna.fa -r $output/$species2\_reads.fa.collapsed  -y now -t $species2 -q $output\n";
#system("perl $Bin/quantifier_2.pl -p $Bin/../referenece/hairpin.dna.fa -m $Bin/../referenece/mature.dna.fa -r $output/$species2\_reads.fa.collapsed  -y now -t $species2 -q $output");
#system("perl $Bin/make_html.pl $output/expression_now.html   > $output/result");

