FROM php:7.3-cli

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    g++ git libicu-dev zip \
    libzip-dev \
    bash \
    nano \
    vim \
    mc \
    iputils-ping

RUN docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu xdebug-3.0.4 \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

WORKDIR /code

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/php.ini
