FROM php:8.3-fpm
WORKDIR /root
#обновляем пакеты
RUN apt-get update -y && apt-get upgrade -y && apt-get install locales -y \
    && localedef -i ru_RU -c -f UTF-8 -A /usr/share/locale/locale.alias ru_RU.UTF-8
ENV LANG ru_RU.utf8
#устанавливаем php
RUN apt-get install curl zip wget git cron openssl ca-certificates ffmpeg \
    libpq-dev \
    libmcrypt-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libz-dev \
    libxml2-dev \
    libssl-dev \
    libmemcached-dev \
    libldap2-dev \
    libxslt-dev -y
# Install Node js
RUN apt-get install -y nodejs npm
# Install extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions openssl calendar opcache \
    bcmath exif gd gettext pdo_mysql mysqli imagick opcache mbstring iconv intl \
    pdo_pgsql pgsql shmop sockets sysvmsg sysvsem sysvshm zip pcntl xsl \
    ldap gd
# Очищаем кэш
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
#установка composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

#устанавливаем рабочую директорию
WORKDIR /var/www/taskflow
RUN chmod -R 755 /var/www/taskflow

CMD ["php-fpm"]
