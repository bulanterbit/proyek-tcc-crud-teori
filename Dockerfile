# Gunakan base image PHP dengan Apache
FROM php:8.2-apache

# Install ekstensi PHP yang dibutuhkan
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# (Opsional) Install ekstensi lain jika dibutuhkan, contoh:
# RUN apt-get update && apt-get install -y \
#     libfreetype-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev \
#     zip \
#     unzip \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip

# Salin file aplikasi Anda ke direktori web root Apache di container
COPY ./web-manajemen-mhs/ /var/www/html/

# (Opsional) Atur kepemilikan file jika ada masalah permission
# RUN chown -R www-data:www-data /var/www/html

# Expose port 80 yang digunakan Apache
EXPOSE 80