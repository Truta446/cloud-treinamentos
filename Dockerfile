# Usa a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Habilita extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita o módulo de reescrita do Apache (caso necessário)
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]