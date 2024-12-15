
FROM php:8.4-fpm

# 設置工作目錄
WORKDIR /var/www/html

# 安裝基本系統依賴
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    iputils-ping

# 安裝和啟用必要的 PHP 擴展
RUN docker-php-ext-install \
    intl \
    opcache \
    pdo \
    pdo_mysql \
    zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install mysqli

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 複製應用程式到工作目錄
COPY . .

# 設置 Composer 緩存目錄
ENV COMPOSER_CACHE_DIR=/var/www/html/.composer/cache

# 安裝 Composer 依賴
RUN composer install --no-scripts --no-autoloader --no-dev --prefer-dist

# 優化 Composer 安裝
RUN composer dump-autoload --optimize

# 設置 Laravel 權限
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 等待連線
# COPY wait-for-mysql.sh ./
# RUN chmod +x wait-for-mysql.sh
# RUN ./wait-for-mysql.sh

# migrate
# RUN php artisan migrate --force

# 開放端口 9000 給 PHP-FPM
EXPOSE 9000

# 啟動 PHP-FPM
CMD ["php-fpm"]
