#!/usr/bin/env sh

cd $1


qsub -q sbbi -e $2/error.log  -o $2/success.log $2/cmd.sh

