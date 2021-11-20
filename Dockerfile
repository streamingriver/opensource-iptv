FROM php:8.0-apache

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

RUN apt-get update \
  && apt-get upgrade -y \
  && apt-get install -y --no-install-recommends \
      locales \
      locales-all \
      git \
      gosu \
      zip \
      unzip \
      libzip-dev \
      libcurl4-openssl-dev \
      optipng \
      pngquant \
      jpegoptim \
      gifsicle \
      libjpeg62-turbo-dev \
      libpng-dev \
      libmagickwand-dev \
      libxpm4 \
      libxpm-dev \
      libwebp6 \
      libwebp-dev \
      ffmpeg \
      libsqlite3-dev \
  && sed -i '/en_US/s/^#//g' /etc/locale.gen \
  && locale-gen \
  && update-locale \
  && docker-php-source extract \
  && pecl install imagick \
  && docker-php-ext-enable imagick \
  && docker-php-ext-configure gd \
      --with-freetype \
      --with-jpeg \
      --with-webp \
      --with-xpm \
  && docker-php-ext-install -j$(nproc) gd \
  && pecl install redis \
  && docker-php-ext-enable redis \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-configure intl \
  && docker-php-ext-install -j$(nproc) intl bcmath zip pcntl exif curl \

#APACHE Bootstrap
  && a2enmod rewrite remoteip \
 && {\
     echo RemoteIPHeader X-Real-IP ;\
     echo RemoteIPTrustedProxy 10.0.0.0/8 ;\
     echo RemoteIPTrustedProxy 172.16.0.0/12 ;\
     echo RemoteIPTrustedProxy 192.168.0.0/16 ;\
     echo SetEnvIf X-Forwarded-Proto "https" HTTPS=on ;\
    } > /etc/apache2/conf-available/remoteip.conf \
 && a2enconf remoteip \
#Cleanup
  && docker-php-source delete \
  && apt-get autoremove --purge -y \
  && apt-get clean \
  && rm -rf /var/cache/apt \
  && rm -rf /var/lib/apt/lists/

FROM composer:latest as vendor

USER www-data

COPY --chown=www-data:www-data . /app/sr-admin-gui


RUN chown -R www-data:www-data /app/sr-admin-gui
WORKDIR /app/sr-admin-gui

ENV COMPOSER_HOME /app/sr-admin-gui

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist


CMD ["php", "artisan", "migrate", "--seed"]

