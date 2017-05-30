#!/usr/bin/env bash
php generator.php
rm -rf /var/www/html/penipu.ragnarok.id
cp -rf docs /var/www/html/penipu.ragnarok.id
