# Usar imagen oficial de PHP con Apache (versión 7.4)
FROM php:7.4-apache

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Configurar PHP para producción
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configuración personalizada del sitio
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/limb.conf && \
    a2enconf limb

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Configurar variables de entorno (valores por defecto)
ENV TELEGRAM_BOT_TOKEN="" \
    TOKEN_API_BOT="" \
    DB_HOST="localhost" \
    DB_USER="limbBot" \
    DB_PASSWORD="anopeludo" \
    DB_NAME="limbBot"

# --- OPTIMIZACIÓN DE CACHÉ ---
# 1. Copiar primero solo los archivos de definición de dependencias
COPY composer.json composer.lock* ./

# 2. Instalar dependencias
# Intentamos install, si falla (por lock file antiguo o inexistente), hacemos update
RUN composer install --no-dev --optimize-autoloader || composer update --no-dev --optimize-autoloader

# 3. Copiar el resto del código de la aplicación
COPY . .

# Configurar permisos finales
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Exponer puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
