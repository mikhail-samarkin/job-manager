FROM php:7.2-cli

MAINTAINER Mikhail Samarkin mikhail.samarkin@simbirsoft.com

RUN composer install --prefer-dist --optimize-autoloader

RUN php yii environment/init

RUN echo "db_dsn=pgsql:host=127.0.0.1;port=5432;dbname=job_manager" >> /config/serv.env
RUN echo "db_username=job_manager" >> /config/serv.env
RUN echo "db_password=job_manager" >> /config/serv.env

RUN php yii migrate -y

RUN php yii vacancy/generate

WORKDIR /web