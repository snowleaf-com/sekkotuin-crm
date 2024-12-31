FROM php:8.3-fpm

# 必要なPHP拡張機能をインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql

# 作業ディレクトリを設定
WORKDIR /var/www/html

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# php.ini設定ファイルをコピー
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Node.jsとnpmをインストール（Node.js 20.xを使用）
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest

# 権限の設定（必要に応じて）
RUN chown -R www-data:www-data /var/www/html

# Laravel用エントリーポイント
CMD ["php-fpm"]