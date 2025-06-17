# Estágio 1: Estágio de construção com PHP, extensões e Composer
FROM php:8.1-apache AS build

# 1. Instala as dependências do sistema e as extensões PHP necessárias PRIMEIRO
RUN apt-get update && apt-get install -y \
      libicu-dev \
      libonig-dev \
      libzip-dev \
      unzip \
      curl \
    && docker-php-ext-install \
      intl \
      pdo \
      pdo_mysql \
      zip \
      mbstring

# 2. Instala o Composer globalmente neste estágio
COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

# 3. Define o diretório de trabalho
WORKDIR /app

# 4. Copia os arquivos do composer e instala as dependências
#    Agora o comando vai rodar em um ambiente onde 'ext-intl' já existe
COPY composer.json composer.lock* ./
RUN composer install --no-interaction --no-dev --optimize-autoloader

# 5. Copia o resto do código do projeto
COPY . .

# ---

# Estágio 2: Imagem final de produção, limpa e otimizada
FROM php:8.1-apache

WORKDIR /var/www/html

# Instala SOMENTE as extensões necessárias para rodar a aplicação
RUN apt-get update && apt-get install -y \
      libicu-dev \
    && docker-php-ext-install \
      intl \
      pdo \
      pdo_mysql \
      mbstring

# Copia todos os arquivos da aplicação (incluindo a pasta /vendor) do estágio de construção
COPY --from=build /app .

# Dá ao Apache permissão para escrever nas pastas de logs e tmp
RUN chown -R www-data:www-data tmp logs

# Habilita URLs amigáveis do Apache
RUN a2enmod rewrite

# Expõe a porta 80
EXPOSE 80