FROM php:8.3-fpm


RUN apt-get update && apt-get install -y --no-install-recommends apt-transport-https\
    build-essential \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		libwebp-dev \
    wget \
    libldb-dev \
    unzip \
    libzip-dev \
    zip \
    apt-utils \
    nano && \
    rm -rf /var/lib/apt/lists/ \
# configure, install and enable all php packages
    &&  docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    &&  docker-php-ext-configure zip \
    &&  docker-php-ext-install -j$(nproc) gd \
    &&  docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) bcmath \
    ## Install Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.8.2 \
    && composer --version \
    && curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony



WORKDIR /var/www/html

# Install Laravel dependencies
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html


EXPOSE 9000
CMD ["php-fpm"]