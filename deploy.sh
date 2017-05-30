#!/usr/bin/env bash
NOW=$(date +%Y-%m-%d-%H-%M-%S)
echo $NOW
read -p "Commit Message: " -i "Update $NOW" -e COMMIT
git add -A
git commit -m $COMMIT
git push origin master
