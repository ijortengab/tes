#!/usr/bin/env bash
php generator.php
NOW=$(date +%Y-%m-%d-%H-%M-%S)
read -p "Commit Message: " -i "Update $NOW" -e COMMIT
git add -A
git commit -m $COMMIT
git push origin master
