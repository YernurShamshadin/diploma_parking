FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
          apt-utils \
          libpq-dev \
          libpng-dev \
          libzip-dev \
          zip unzip \
          nginx \
          git && \
          docker-php-ext-install pdo_pgsql && \
          docker-php-ext-install pgsql && \
          docker-php-ext-install bcmath && \
          docker-php-ext-install gd && \
          docker-php-ext-install zip && \
          docker-php-ext-enable pgsql && \
          apt-get clean && \
          rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD php.ini /usr/local/etc/php/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

USER 1000

WORKDIR /var/www