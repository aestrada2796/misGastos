# Usa la imagen oficial de PHP
FROM php:8.3-fpm

# Establece el directorio de trabajo
WORKDIR /var/www/app

# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    git \
    cron \
    nano \
    supervisor \
    procps \
    redis-tools \
    default-mysql-client \
    libzip-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libevent-dev \
    libicu-dev \
    && pecl install redis \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_pgsql \
        zip \
        exif \
        ftp \
        curl \
        sockets \
        soap \
        pcntl \
        bcmath \
        intl \
    && docker-php-ext-enable redis opcache sodium \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY ./conf/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./conf/supervisor.d/ /etc/supervisor/conf.d/
COPY ./conf/php-fpm.conf /usr/local/etc/php/fpm/php-fpm.conf
COPY ./conf/www.conf /usr/local/etc/php/fpm/pool.d/www.conf
COPY ./conf/custom-php.ini /usr/local/etc/php/conf.d/99-custom-php.ini
COPY ./conf/crontab /etc/cron.d/app-cron
COPY ./scripts/start.sh /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expone el puerto que utilizará PHP-FPM
EXPOSE 9000

CMD ["/bin/bash", "-c", "/usr/local/bin/start.sh"]
