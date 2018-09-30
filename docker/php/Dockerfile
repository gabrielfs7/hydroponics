FROM php:7.2.9-apache-stretch

# Install necessary dependencies
RUN apt-get update \
    && apt-get install -y git \
    && docker-php-ext-install pdo pdo_mysql

# Configure apache mod rewrite
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

# Exit from html root, cause it will be removed
WORKDIR /var/www

# Create link for public application
RUN rm -rf /var/www/html \
    && mkdir /hydroponics \
    && ln -sf /hydropnics/public /var/www/html
    && chown -R www-data:www-data /var/www/html

# Set new working dit for project root
WORKDIR /hydroponics

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"