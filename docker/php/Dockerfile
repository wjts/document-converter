FROM php:7.2-fpm-alpine

LABEL maintainer="wojtas@wojtas.net.pl"

RUN docker-php-ext-install pdo pdo_mysql
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug

ENV TZ=Europe/Warsaw

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "'${TZ}'"\n' > /usr/local/etc/php/conf.d/tzone.ini

RUN printf 'xdebug.remote_connect_back = 1\n' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && printf 'xdebug.remote_enable = 1\n' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


WORKDIR /app
