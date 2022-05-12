FROM php:8.1-fpm as php_app

COPY --from=composer:2.0.9 /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions zip pdo_pgsql ctype iconv intl bcmath soap apcu opcache amqp ds gmp uuid gd redis xdebug

COPY ./docker/php/config/php.ini /usr/local/etc/php/php.ini
COPY ./docker/fpm/pool.d/application.conf /opt/docker/etc/php/fpm/pool.d/application.conf
COPY ./docker/fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p /var/www/app
WORKDIR /var/www/app

COPY ./ ./
RUN chown www-data:www-data ./ -R
USER www-data

ENV PATH="${PATH}:/root/.composer/vendor/bin"
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN set -eux; \
    composer install --prefer-dist --no-progress --optimize-autoloader;

#RUN set -eux; \
#    mkdir -p var/cache var/log var/data config/jwt; \
#    chmod +x bin/console; sync

CMD ["php-fpm"]

FROM nginx:alpine as nginx_app
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
