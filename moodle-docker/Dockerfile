FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system and PHP extension dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    libldap2-dev \
    zlib1g-dev \
    libmagickwand-dev \
    imagemagick \
    unzip \
    curl \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install \
        gd \
        pdo_mysql \
        mysqli \
        zip \
        intl \
        soap \
        mbstring \
        exif \
        bcmath \
        calendar \
        gettext \
        ldap \
        opcache \
        simplexml \
        xmlwriter

# Install PECL extensions
RUN pecl install redis imagick \
    && docker-php-ext-enable redis imagick

# (Optional) Install Xdebug for dev
# RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache modules
RUN a2enmod rewrite headers ssl

# PHP Config
COPY php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Apache Config
COPY apache/moodle.conf /etc/apache2/sites-available/000-default.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Health Check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

EXPOSE 80

