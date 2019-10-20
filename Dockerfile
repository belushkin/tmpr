FROM php

ENV APP_DIR /app
ENV APPLICATION_ENV development

WORKDIR $APP_DIR
VOLUME $APP_DIR

RUN apt-get update && apt-get install -y \
        git \
        build-essential \
        nodejs \
        npm

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');    \
    \$sig = file_get_contents('https://composer.github.io/installer.sig');      \
    if (trim(\$sig) === hash_file('SHA384', 'composer-setup.php')) exit(0);     \
    echo 'ERROR: Invalid installer signature' . PHP_EOL;                        \
    unlink('composer-setup.php');                                               \
    exit(1);"                                                                   \
 && php composer-setup.php -- --filename=composer --install-dir=/usr/local/bin  \
 && rm composer-setup.php

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/app/public", "/app/public/index.php"]
