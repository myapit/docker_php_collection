FROM php:5.6.40-fpm-alpine3.8

LABEL MAINTAINER="myapit" \
      "PHP"="5.6.40" \
      "Alpine"="3.8"

RUN wget https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -O /usr/local/bin/install-php-extensions

RUN apk add --no-cache --virtual .build-deps git autoconf  $PHPIZE_DEPS \
	&& apk del .build-deps git autoconf $PHPIZE_DEPS \
    	&& chmod uga+x /usr/local/bin/install-php-extensions && sync \
    	&& install-php-extensions bcmath \
            bz2 \
            calendar \
            curl \
            exif \
            fileinfo \
            ftp \
            gd 
	    
RUN install-php-extensions  gettext \
            imagick \
            imap \
            intl \
            ldap \
            mbstring \
            mcrypt \
            memcache \
            mongodb 

RUN install-php-extensions   mysql \
            mysqli \
            opcache \
            pdo \
            pdo_mysql \
            soap \
            sysvsem \
            sysvshm \
            xmlrpc \
            xsl \
            zip 

RUN  echo -e "\n opcache.enable=1 \n opcache.enable_cli=1 \n opcache.memory_consumption=128 \n opcache.interned_strings_buffer=8 \n opcache.max_accelerated_files=4000 \n opcache.revalidate_freq=60 \n opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
        &&  echo -e "\n xdebug.remote_enable=1 \n xdebug.remote_host=localhost \n xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
        &&  echo -e "\n xhprof.output_dir='/var/tmp/xhprof'" >> /usr/local/etc/php/conf.d/docker-php-ext-xhprof.ini \
        && cd ~ \
# Install composer
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "copy('https://composer.github.io/installer.sig', 'signature');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === trim(file_get_contents('signature'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" 

# modify www-data user to have id 1000
RUN apk add \
        --no-cache \
        --repository http://dl-3.alpinelinux.org/alpine/edge/community/ --allow-untrusted \
        --virtual .shadow-deps \
        shadow \
    && usermod -u 1000 www-data \
    && groupmod -g 1000 www-data \
    && apk del .shadow-deps
