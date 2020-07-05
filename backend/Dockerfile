# PHP Version alpine image to install based on the PHP_VERSION environment variable
FROM php:7.4-fpm

# ARGUMENTS
ARG APPLICATION_ENVIRONMENT=production
ARG uid=1000
ARG user=widgets_master

LABEL maintainer="Andrew Bilenduke <andrewbilenduke@gmail.com>"

RUN apt-get update && apt-get install -y \
        git \
        curl \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath
RUN docker-php-ext-enable pdo_mysql

# install sqlite and enable it if the development environment is local
RUN if [ "$APPLICATION_ENVIRONMENT" = "local" ] ; then \
  apt-get install -y sqlite3 libsqlite3-dev && \
  docker-php-ext-install pdo_sqlite && \
  docker-php-ext-enable pdo_sqlite \
;fi

# install xdebug and enable it if the development environment is local
RUN if [ "$APPLICATION_ENVIRONMENT" = "local" ] ; then \
  pecl install xdebug \
  && docker-php-ext-enable xdebug \
;fi

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Remove Cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Change current user to www
USER $user

# Run php-fpm
CMD ["php-fpm"]

EXPOSE 9000
