FROM php:8.4-fpm-alpine3.22

# Update de pacotes, correção de vulnerabilidades
RUN apk update

# Instalando Nginx, copiando arquivo de configuração
RUN apk add --no-cache \
    nginx=1.28.0-r3 && \
    rm -rf /var/cache/apk/*
COPY ./nginx.conf /etc/nginx/nginx.conf

# Definindo diretorio de trabalho de execução
WORKDIR /var/www/html

# Copia index.php
COPY ./index.php .

# Porta de acesso ao php-fpm
EXPOSE 80

# Transferindo arquivo de inicialização
COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Script de inicialização
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Executa o php-fpm apos script da inicialização
CMD ["php-fpm"]