#!/usr/bin/perl
use FindBin qw($Bin);
use File::Path;
use strict;
use File::Basename;
use Getopt::Std;
use Data::Dumper;
my %options=();
getopts("a:i:o:r:s:p",\%options);
my $output = $options{'o'} if(defined $options{'o'});
my $species = $options{'s'} if(defined $options{'s'});


my %precursor2mature;
open(IN, "$Bin/../referenece/mature2precursor.bwt") or die "can't open $!";
     while(my $line=<IN>)
         {
           my @arr=split(/\t/,$line);  
                 $precursor2mature{$arr[2]}=$precursor2mature{$arr[2]}."!".$arr[3].":".$arr[0];
                         
         }
  
close(IN);

my %reads2precursor;
print $output."\n";
open(IN, "$output/reads_mapped2precursor.bwt") or die "can't open $!";
     while(my $line=<IN>)
         {
           my @arr=split(/\t/,$line);  
                 $reads2precursor{$arr[0]}=$reads2precursor{$arr[0]}."!".$arr[3].":".$arr[2];
                
                         
         }
  
close(IN);
my %reads2genome;
print $output."\n";
open(IN, "$output/reads_mapped2genome.bwt") or die "can't open $!";
     while(my $line=<IN>)
         {
           my @arr=split(/\t/,$line);  
                 $reads2genome{$arr[0]}=$reads2genome{$arr[0]}."!".$arr[3].":".$arr[2];
                
                         
         }
  
close(IN);

my %reads2trna;
print $output."\n";
open(IN, "$output/reads_mapped2trna.bwt") or die "can't open $!";
     while(my $line=<IN>)
         {
           my @arr=split(/\t/,$line);  
                 $reads2trna{$arr[0]}=$reads2trna{$arr[0]}."!".$arr[3].":".$arr[2];
                
                         
         }
  
close(IN);

my %allcounts;
print $output."\n";
open(IN, "$output/allcounts") or die "can't open $!";
     while(my $line=<IN>)
         {chop($line);
           my @arr=split(/\t/,$line); 
                  for(my $i=1; $i<@arr;$i++) 
                   {$allcounts{$arr[0]}=$allcounts{$arr[0]}."\t".$arr[$i];
                   }
                
                         
         }
  
close(IN);
open(out, ">$output/summary") or die "can't open $!";
print out "seq_name\tseq_len\tseq".$allcounts{'X'}."\t$species"."_miRNA\tMapping2miRNA\tgenome_hits\tMapping2genome\t$species"."_trna\n";
foreach my $aa (keys(%allcounts))
{
    my @arr=split(/\_len_/,$aa);
       my @hits=split(/\!/,$reads2genome{$aa});
       my $genomehits=scalar(@hits)-1;
      if($reads2precursor{$aa}=~/.*\:($species.*[^\!])\!.*/ || $reads2precursor{$aa}=~/.*\:($species.*[^\!])$/ )
       { my @sd=split(/\!/,$1);
     print out "$arr[0]\t$arr[1]$allcounts{$aa}\t$sd[0]\t$reads2precursor{$aa}\t".$genomehits."\t$reads2genome{$aa}\t$reads2trna{$aa}\n";    
       }
      elsif($reads2precursor{$aa})
       { print out "$arr[0]\t$arr[1]$allcounts{$aa}\t0\t$reads2precursor{$aa}\t".$genomehits."\t$reads2genome{$aa}\t$reads2trna{$aa}\n";   
       }
      elsif($reads2trna{$aa})
       { print out "$arr[0]\t$arr[1]$allcounts{$aa}\t2\t$reads2precursor{$aa}\t".$genomehits."\t$reads2genome{$aa}\t$reads2trna{$aa}\n"; 
         }
       else
       { print out "$arr[0]\t$arr[1]$allcounts{$aa}\t-1\t$reads2precursor{$aa}\t".$genomehits."\t$reads2genome{$aa}\t$reads2trna{$aa}\n"; 
         }      
    
}
 close(out);







