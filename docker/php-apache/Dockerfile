FROM php:8.0.10-apache
# RUN apt-get update && apt-get -y upgrade --no-install-recommends && apt-get autoremove -y
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
# Change document root for Apache
RUN sed -i -e 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode = debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port = 9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && rm -rf /tmp/pear
# Install composer
RUN curl -sSL https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer
