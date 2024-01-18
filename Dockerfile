# Utilisez l'image PHP avec Apache
FROM php:8.1-apache

# Installation des dépendances
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        git \
    && docker-php-ext-install zip pdo_mysql

# Configuration Apache
RUN a2enmod rewrite

# Copiez les fichiers du projet dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances de composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction

# Exposer le port 80
EXPOSE 80

# Commande par défaut pour démarrer le serveur Apache
CMD ["apache2-foreground"]
