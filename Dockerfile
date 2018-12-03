FROM php:7.2-cli

MAINTAINER Mikhail Samarkin mikhail.samarkin@simbirsoft.com

# Install required system packages
RUN apt-get update && \
    apt-get -y install \
            git \
            zlib1g-dev \
            libssl-dev \
        --no-install-recommends && \
        apt-get clean && \
        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install php extensions
RUN docker-php-ext-install \
    bcmath \
    zip

WORKDIR /

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin

RUN composer global require "fxp/composer-asset-plugin:*"

# Prepare application
WORKDIR /repo

# Install vendor
COPY ./composer.json /repo/composer.json
RUN composer install --prefer-dist --optimize-autoloader

RUN php yii environment/init

RUN echo "db_dsn=pgsql:host=127.0.0.1;port=5432;dbname=job_manager" >> /config/serv.env
RUN echo "db_username=job_manager" >> /config/serv.env
RUN echo "db_password=job_manager" >> /config/serv.env

RUN php yii migrate -y

RUN php yii vacancy/generate

WORKDIR /web