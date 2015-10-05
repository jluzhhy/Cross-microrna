#!/usr/bin/env sh

cd $1

<<<<<<< HEAD


qsub -q sbbi -e $2/error.log  -o $2/success.log $2/cmd.sh
=======
source /cloud/subsystem/sge/default/common/settings.sh

qsub  -l h_vmem=10G -l arch=linux-x64 -e $2/error.log  -o $2/success.log $2/cmd.sh
>>>>>>> b77fbded6c543b8f340bdc50a6ee5c5e48d0cf10
