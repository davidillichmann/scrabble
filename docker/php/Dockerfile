FROM php:7.1-fpm

# Installing dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    locales \
    zip \
    nano cron supervisor procps \
    jpegoptim optipng pngquant gifsicle sqlite3 \
    ghostscript-x \
    libmagickwand-dev --no-install-recommends

# Extensions
RUN docker-php-ext-install mbstring zip exif pcntl bcmath opcache pdo pdo_mysql

# GD library
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# Redis
RUN pecl install redis && docker-php-ext-enable redis

# Imagick
RUN pecl install imagick && docker-php-ext-enable imagick

RUN echo "memory_limit=-1" >> /usr/local/etc/php/conf.d/local.ini;
RUN echo "upload_max_filesize=30M" >> /usr/local/etc/php/conf.d/local.ini;
RUN echo "post_max_size=30M" >> /usr/local/etc/php/conf.d/local.ini;

# Xdebug
ARG xdebug
RUN if [ -n "$xdebug" ]; then \
    pecl install xdebug; \
    docker-php-ext-enable xdebug; \
    echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    fi

ENV PHP_IDE_CONFIG="serverName=php"

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Locales
RUN echo en_UK.UTF-8 UTF-8 > /etc/locale.gen && locale-gen

# Workdir
WORKDIR /application

# Permissions
RUN chown -R www-data:www-data /application
RUN chmod 755 /application
