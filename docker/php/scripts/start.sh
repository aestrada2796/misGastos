#!/bin/bash

echo "Otorgando permisos..."
chown -R www-data:www-data /var/www/app/storage
chmod -R 777 /var/www/app/storage

echo "Creando carpetas de logs..."
mkdir "/var/www/app/storage/logs"
mkdir "/var/www/app/storage/logs/supervisor"

echo "Configurando Cron..."
echo "" >> /etc/cron.d/app-cron
chmod 0644 /etc/cron.d/app-cron
crontab /etc/cron.d/app-cron

echo "Iniciando cron..."
cron -f &

echo "Iniciando supervisord..."
/usr/bin/supervisord -c /etc/supervisor/supervisord.conf
