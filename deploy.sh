#!/usr/bin/env bash
php generator.php
if [ -f error.log ]; then
   echo "Error found. Process Terminated."
   cat error.log
   rm error.log
   exit;
fi
NOW=$(date +%Y-%m-%d-%H-%M-%S)
read -p "Commit Message: " -i "Update $NOW" -e COMMIT
git add -A
git commit -m "$COMMIT"
git push origin master
