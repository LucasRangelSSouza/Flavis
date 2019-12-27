FROM php:5.6-fpm-alpine
# Set defaults for variables used
ENV DEBIAN_FRONTEND noninteractive
ENV COMPOSER_HOME=/root/.composer
ENV TZ=America/Sao_Paulo

# Install and configure php plugins
RUN set -xe \
    && buildDeps=" \
        $PHP_EXTRA_BUILD_DEPS \
        autoconf \
        g++ \
        gcc \
        make \
        pkgconf \
        coreutils \
        freetype-dev \
        libjpeg-turbo-dev \
        libltdl \
        libmcrypt-dev \
        libpng-dev \
        icu-dev \
        libxslt \
        libxslt-dev \
        gettext-dev \
        postgresql-dev \
    " \
	&& apk upgrade --update && apk add $buildDeps \
#	&& docker-php-source extract \
#	&& cd /usr/src/php \
#    && ./configure --enable-maintainer-zts \
#    && make \
#    && make install \
## Install PThreads
#    && pecl install -f pthreads-2.0.10 \
    && docker-php-ext-install -j$(nproc) exif gd mbstring intl xsl zip mysqli pdo pdo_mysql pdo_pgsql opcache \
    && docker-php-ext-enable exif gd mbstring intl xsl zip mysqli pdo pdo_mysql pdo_pgsql opcache \
# Set timezone
    && apk add -U tzdata \
    && cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone \
    && apk del tzdata

ADD php.ini ${PHP_INI_DIR}

## Install Xdebug
# RUN pecl install -f xdebug-2.5.3
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_host=10.254.254.254" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_enable = on" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back = off" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart = on" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey = PHPSTORM" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.default_enable = off" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.profiler_enable = on" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.max_nesting_level = 500" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini


## Configure PHP-FPM
RUN sed -i "s/pm.max_children = 5/pm.max_children = 15/" /usr/local/etc/php-fpm.d/www.conf
RUN docker-php-ext-install mysqli