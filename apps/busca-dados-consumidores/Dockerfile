FROM php:8.0.0rc1-fpm

#Update!
RUN apt-get update

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Install zip+icu dev libs + pgsql dev support
RUN apt-get install libzip-dev zip libicu-dev libpq-dev -y

#Install PHP extensions zip and intl (intl requires to be configured)
RUN docker-php-ext-install zip

# Add MySQL and Postgres/pgsql support
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

# Set working directory

COPY ./composer.* /var/www

WORKDIR /var/www

EXPOSE 8000

CMD bash -c "composer install && composer dump-autoload -o && php-fpm --nodaemonize"