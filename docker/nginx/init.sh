#!/bin/sh

mkdir -p etc/nginx/sites-enabled

ln -sf /etc/nginx/sites-available/app.conf /etc/nginx/sites-enabled/app.conf
ln -sf /etc/nginx/sites-available/minio.conf /etc/nginx/sites-enabled/minio.conf

exec "$@"
