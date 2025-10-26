# docker_pagina_php_hostname

## Objetivo do projeto

Criar uma imagem Docker que combina Nginx e PHP-FPM para servir uma página `index.php` que exibe o hostname onde está sendo executada (útil para testar e demonstrar deploys em containers/hosts diferentes).

## Estrutura e função de cada arquivo

- `Dockerfile`
  - Define a imagem baseada em `php:8.4-fpm-alpine3.22`.
  - Instala o `nginx`, copia a configuração (`nginx.conf`), define o diretório de trabalho, copia a `index.php`, expõe a porta 80 e adiciona o `entrypoint.sh` que inicia o `nginx` e o `php-fpm`.

- `nginx.conf`
  - Configuração do Nginx usada dentro do container.
  - Escuta na porta 80, define `root /var/www/html` e encaminha requisições PHP para `127.0.0.1:9000` (FastCGI).

- `entrypoint.sh`
  - Script de inicialização do container.
  - Inicia o processo do Nginx em background (com `nohup nginx -g "daemon off;" &`) e depois executa o comando padrão (`exec "$@"`) — que por padrão inicia o `php-fpm` (via `CMD ["php-fpm"]` no `Dockerfile`).

- `index.php`
  - Página HTML simples que mostra o hostname do sistema onde está rodando, usando `<?php echo gethostname(); ?>`.

- `README.md`
  - Este arquivo: objetivo do projeto, funções dos arquivos, instruções de build/execution e observações.

## Como construir a imagem

No diretório do projeto (onde está o `Dockerfile`), execute:

```bash
docker build -t docker_pagina_php_hostname .
```

Opcional (forçar rebuild):

```bash
docker build --no-cache -t docker_pagina_php_hostname .
```

## Como executar

Rode o container mapeando a porta 80 do container para uma porta local (por exemplo 8080):

```bash
docker run --rm -p 8080:80 docker_pagina_php_hostname
```

Abra no navegador: http://localhost:8080 — a página mostrará o hostname do container (ou do host quando rodar em host network).

Teste rápido via terminal:

```bash
curl -i http://localhost:8080
```
