#!/bin/bash
apt-get update && apt-get upgrade -y
apt-get install npm php5-fpm php5-curl php5-cli php5-mysql php5-sqlite php5-mcrypt
npm install -g bower
php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === '781c98992e23d4a5ce559daf0170f8a9b3b91331ddc4a3fa9f7d42b6d981513cdc1411730112495fbf9d59cffbf20fb2') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); }"
php composer-setup.php --install-dir=bin --filename=composer
php -r "unlink('composer-setup.php');"
composer update
bower install
php artisan key:generate
php artisan migrate --seed
