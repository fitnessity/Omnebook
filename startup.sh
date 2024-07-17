#!/bin/bash

echo "Current directory: $(pwd)"
echo "Contents of /var/www/html:"
ls -la /var/www/html
echo "Contents of /var/www/html/public (first 30 items):"
ls -la /var/www/html/public | head -n 30
echo "Content of /var/www/html/index.php:"
cat /var/www/html/index.php
echo "PHP include_path:"
php -i | grep include_path
echo "Starting PHP server..."
php -S 0.0.0.0:80 -t .