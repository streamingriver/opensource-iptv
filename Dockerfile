FROM php:8.0-apache

ENV APACHE_DOCUMENT_ROOT /app/sr-admin-gui/public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

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
  && a2enmod rewrite remoteip \
 && {\
     echo RemoteIPHeader X-Real-IP ;\
     echo RemoteIPTrustedProxy 10.0.0.0/8 ;\
     echo RemoteIPTrustedProxy 172.16.0.0/12 ;\
     echo RemoteIPTrustedProxy 192.168.0.0/16 ;\
     echo SetEnvIf X-Forwarded-Proto "https" HTTPS=on ;\
    } > /etc/apache2/conf-available/remoteip.conf \
 && a2enconf remoteip \
  && docker-php-source delete \
  && apt-get autoremove --purge -y \
  && apt-get clean \
  && rm -rf /var/cache/apt \
  && rm -rf /var/lib/apt/lists/

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN mkdir -p /data
RUN chown www-data:www-data /data

VOLUME /data

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
    --prefer-dist \
    --no-dev

EXPOSE 80

ENTRYPOINT ["bash", "/app/sr-admin-gui/scripts/Docker.sh"]



