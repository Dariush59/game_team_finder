FROM php:8-fpm-alpine
ARG INSTALL_COMPOSER=false
RUN apk update
RUN apk upgrade
RUN docker-php-ext-install pdo pdo_mysql

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug  \
    && docker-php-ext-enable xdebug

# install composer
RUN if [ $INSTALL_COMPOSER = true ] ; then curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer ; fi


