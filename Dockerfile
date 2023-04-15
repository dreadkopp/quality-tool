FROM php:8.1.17-cli-alpine3.17

RUN apk add --no-cache npm
RUN curl -s https://getcomposer.org/download/2.5.4/composer.phar -o /usr/bin/composer && chmod 755 /usr/bin/composer

RUN apk add --no-cache ruby
RUN gem install mdl

RUN npm install -g prettier
RUN npm install -g eslint
RUN npm install -g eslint-config-prettier
RUN npm install -g eslint-plugin-prettier
RUN npm install -g eslint-plugin-vue

WORKDIR /analyze

RUN addgroup -S myswooop -g 1000 \
    && adduser -S myswooop -G myswooop -u 1000 \
    && chown myswooop:myswooop /analyze

RUN apk add --no-cache python3 py3-pip \
    && pip install djlint

USER myswooop

RUN composer global require friendsofphp/php-cs-fixer
RUN composer global config --no-plugins allow-plugins.dealerdirect/phpcodesniffer-composer-installer true
RUN composer global require nunomaduro/phpinsights
RUN composer global require kubawerlos/php-cs-fixer-custom-fixers
RUN composer global require phpstan/phpstan:1.10.3
RUN composer global require rector/rector
RUN echo 'adding laravel rules'
RUN composer global require driftingly/rector-laravel

COPY entry.sh /entry.sh

ENTRYPOINT ["/entry.sh"]

COPY config /config

HEALTHCHECK CMD exit 0

# decide files, lint, check

# add configs

# cs fixer, stan, insights, prettier, markdownlint
