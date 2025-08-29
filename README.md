# Mini Projeto: PHP + Nginx + MariaDB com Docker

Este projeto é um ambiente Docker simples que roda:

- **Nginx** como servidor web
- **PHP-FPM** para processar arquivos PHP
- **MariaDB** como banco de dados relacional
- Uma página `index.php` que mostra:
  - O hostname do container PHP
  - O status de conexão com o banco de dados `meu_db`

---

## 🐳 Serviços (via Docker Compose)

| Serviço   | Função                          | Porta Externa |
|-----------|----------------------------------|---------------|
| nginx     | Servidor web                    | `8080`        |
| php       | Interpretador PHP (via FPM)     | -             |
| mariadb   | Banco de dados relacional       | `3306` (interna) |

---

## 🚀 Como rodar

1. **Clone o projeto** ou copie os arquivos para uma pasta:

```bash
git clone git@github.com:carlosalbertomagnoferreira/docker_pagina_php_hostname.git
cd docker_pagina_php_hostname
````

2. **Suba os containers**:

```bash
docker-compose up --build -d
```

3. **Acesse no navegador**:

```
http://localhost:8080
```

Você verá uma página de boas-vindas informando o hostname do container PHP e a conexão com o banco MariaDB.

---

## 📂 Estrutura do Projeto

```
.
├── docker-compose.yml
├── nginx/
│   └── default.conf          # Configuração do Nginx
├── php/
│   ├── Dockerfile            # Instala pdo_mysql no PHP
│   └── index.php             # Página principal
├── mariadb/
│   └── my.cnf (opcional)     # Configuração otimizada de memória
```

---

## ⚙️ Configurações

### Banco de Dados

* Banco: `meu_db`
* Usuário: `root`
* Senha: `root`
* Host (interno no Docker): `mariadb`

### Otimizações de Memória

* MariaDB utilizado no lugar do MySQL por ser mais leve
* Arquivo `my.cnf` opcional pode ser montado para controle de uso de RAM

---

## 🐾 Comandos úteis

Parar os containers:

```bash
docker-compose down
```

Parar e remover volumes (inclui dados do banco):

```bash
docker-compose down -v
```

---

## 📝 Possíveis melhorias

* Adicionar Adminer ou phpMyAdmin para gerenciar o banco via navegador
* Usar variáveis de ambiente com `.env`
* Criar dados de exemplo automaticamente no banco
* Incluir testes e CI/CD

---

## 📄 Licença

Este projeto é livre para uso e modificação.
