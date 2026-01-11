FROM nginx:alpine

COPY ./init.sh /docker-entrypoint-init.d/init.sh
COPY ./certs /etc/nginx/certs

# Asegurar que el script tiene permisos de ejecución
RUN chmod +x /docker-entrypoint-init.d/init.sh

# Reemplazar el entrypoint de Nginx para que ejecute el script
ENTRYPOINT ["/bin/sh", "/docker-entrypoint-init.d/init.sh"]

# Usar el entrypoint original de Nginx para iniciar Nginx
CMD ["nginx", "-g", "daemon off;"]
