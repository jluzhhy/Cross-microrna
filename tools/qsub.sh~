#!/usr/bin/env sh

cd $1

source /cloud/subsystem/sge/default/common/settings.sh

qsub  -l h_vmem=10G -l arch=linux-x64 -e $2/error.log  -o $2/success.log $2/cmd.sh
