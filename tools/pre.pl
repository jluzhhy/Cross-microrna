use File::Path;
use strict;
use File::Basename;
use Getopt::Std;
use FindBin qw($Bin);
my %options;
getopts("p:m:s:r",\%options);
my $species = lc($options{'s'});
  $species =~ s/ //g;
ConvertFastaFile($options{'p'},"/var/www/html/Cross-microrna/referenece/","$species\_precursor",$species);
ConvertFastaFile($options{'m'},"/var/www/html/Cross-microrna/referenece/","$species\_mature",$species);

sub ConvertFastaFile{
    my $file = shift;
    my $outdir= shift;
	my $des = shift;
    my $sp = shift;

    open IN,"$file" or die "File $file not found\n";
        open OUT,">$outdir/$des.converted" or die "file $outdir/$des.converted could not be created\n";
   
print ">$outdir/$des.converted" or die "file $outdir/$des.converted could not be created\n";
    my $line;
    my $id;
	my $tmpid;
	my $seq;
	my $first = 1;

    my $sp_hits=0;

    while($line = <IN>){
		chomp $line;
		if($line =~ /^(>\S+)\s*(\S*)/){
			$tmpid = $1;

			if(not $first){
				if($sp eq 'none'){

					if($des eq ""){
						if($seq !~ /N/){   ## skip reads that contain an N in the sequence
							print OUT "$id\n$seq\n";
							$sp_hits++;
						}

					}else{
						if($seq !~ /N/){
							print OUT "$id\n$seq\n";
							$sp_hits++;
						}
					}
				}elsif($id =~ /$sp/i){
					if($des eq ""){
						if($seq !~ /N/){   ## skip reads that contain an N in the sequence
							print OUT "$id\n$seq\n";
						$sp_hits++;
						}
					}else{
						if($seq !~ /N/){
							print OUT "$id\n$seq\n";
							$sp_hits++;
						}
					}
				}else{}

			}else{
				$first = 0;
			}
			$seq="";
			$id = $tmpid;
		}else{
            $line = uc($line);
			$line =~ s/U/T/g;
			$seq .= $line;
		}
	}

 	if($sp eq 'none'){

		if($des eq ""){
			if($seq !~ /N/){   ## skip reads that contain an N in the sequence
				print OUT "$id\n$seq\n";
				$sp_hits++;
			}
		}else{
			if($seq !~ /N/){
				print OUT "$id\n$seq\n";
			}
			$seq="";
			$sp_hits++;
		}
 	}elsif($id =~ /$sp/i){
		if($des eq ""){
			if($seq !~ /N/){   ## skip reads that contain an N in the sequence
				print OUT "$id\n$seq\n";
				$sp_hits++;
			}
		}else{
			if($seq !~ /N/){
				print OUT "$id\n$seq\n";
				$seq="";
				$sp_hits++;
			}
		}
 	}else{}

    close IN;
    close OUT;

    if(not $sp_hits){
		die "\nError: No entrys for species \"$options{'t'} or $species\" found in file $file
Please make sure that the given species argument matches the species id in your file $file or say none\n\n\n";
	}
}
