#!/usr/bin/env bash
php generator.php
if [ -f error.log ]; then
   echo "Error found. Process Terminated."
   cat error.log
   rm error.log
   exit;
fi
rm -rf /var/www/html/penipu.ragnarok.id
cp -rf docs /var/www/html/penipu.ragnarok.id
