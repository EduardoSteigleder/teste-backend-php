# Estrutura do Projeto

## Diretórios e Arquivos Principais

    projeto/
    ├── app/
    │   ├── Http/
    │   │   └── Controllers/
    │   │       └── SincronizacaoController.php
    │   ├── Models/
    │   │   ├── ProdutoBase.php
    │   │   ├── PrecoBase.php
    │   │   ├── ProdutoInsercao.php
    │   │   └── PrecoInsercao.php
    │   └── Providers/
    │       ├── AppServiceProvider.php
    │       ├── AuthServiceProvider.php
    │       ├── EventServiceProvider.php
    │       └── RouteServiceProvider.php
    │
    ├── bootstrap/
    │   ├── app.php
    │   └── cache/
    │
    ├── config/
    │   ├── app.php
    │   ├── database.php
    │   ├── logging.php
    │   └── queue.php
    │
    ├── database/
    │   ├── migrations/
    │   │   ├── 2024_01_01_000001_create_produtos_base_table.php
    │   │   ├── 2024_01_01_000002_create_precos_base_table.php
    │   │   ├── 2024_01_01_000003_create_produto_insercao_table.php
    │   │   ├── 2024_01_01_000004_create_preco_insercao_table.php
    │   │   └── 2024_01_01_000005_create_views.php
    │   ├── seeders/
    │   │   └── DatabaseSeeder.php
    │   ├── database.sqlite
    │   └── base_scripts.sql
    │
    ├── public/
    │   └── index.php
    │
    ├── resources/
    │   ├── css/
    │   │   └── app.css
    │   ├── js/
    │   │   ├── app.js
    │   │   └── bootstrap.js
    │   └── views/
    │
    ├── routes/
    │   ├── api.php
    │   └── console.php
    │
    ├── storage/
    │   └── logs/
    │
    ├── tests/
    │   ├── Feature/
    │   │   └── SincronizacaoTest.php
    │   ├── Unit/
    │   └── TestCase.php
    │
    ├── .env
    ├── .env.example
    ├── artisan
    ├── composer.json
    ├── Dockerfile
    ├── docker-compose.yml
    ├── Makefile
    ├── package.json
    ├── phpunit.xml
    ├── README.md
    ├── QUICKSTART.md
    └── vite.config.js

## Fluxo de Dados

    produtos_base
        ↓
    view_produtos_processados
        ↓
    SincronizacaoController::sincronizarProdutos()
        ↓
    produto_insercao

    precos_base
        ↓
    view_precos_processados
        ↓
    SincronizacaoController::sincronizarPrecos()
        ↓
    preco_insercao

    GET /api/produtos-precos
        ↓
    JOIN produto_insercao + preco_insercao
        ↓
    JSON paginado

## Banco de Dados

### Tabelas base

-   produtos_base: dados brutos de produto
-   precos_base: dados brutos de preço

### Tabelas processadas

-   produto_insercao: produto normalizado
-   preco_insercao: preço normalizado

### Views

-   view_produtos_processados: UPPER, TRIM, filtra inativos
-   view_precos_processados: ROUND, UPPER, filtra inativos

## Controller

### SincronizacaoController

Endpoints:

-   POST /api/sincronizar/produtos
-   POST /api/sincronizar/precos
-   GET /api/produtos-precos

Fluxo interno:

1.  Lê dados da view
2.  Verifica duplicidade (constraints UNIQUE)
3.  Insere novos registros
4.  Atualiza se houver alteração
5.  Remove o que não existe mais na view
6.  Usa transaction

## Testes

Arquivo: tests/Feature/SincronizacaoTest.php

Cobre:

-   Sincronização de produtos
-   Sincronização de preços
-   Paginação
-   Parâmetros page e per_page
-   Evita duplicidade
-   Processa apenas registros ativos

## Docker

### Dockerfile

-   PHP 8.2 CLI
-   Extensões PDO, SQLite, MySQL
-   Composer
-   Executa migrations
-   Serve na porta 8000

### docker-compose.yml

-   Container da aplicação
-   Volume para dev
-   Porta 8000 exposta
-   Variáveis de ambiente
-   Health check

## Dependências

### PHP

-   Laravel 11
-   PHPUnit
-   Faker

### Node

-   Vite
-   Vue 3
-   Axios

## Inicialização

1.  docker compose up -d --build
2.  Composer instala dependências
3.  Migrations criam tabelas e views
4.  Seeders populam dados
5.  artisan serve na porta 8000
6.  API pronta

## Variáveis de Ambiente

    APP_NAME=Backend
    APP_ENV=local
    APP_DEBUG=true
    APP_KEY=base64:...
    APP_URL=http://localhost:8000

    DB_CONNECTION=sqlite
    DB_DATABASE=/app/database/database.sqlite

    LOG_CHANNEL=stack
    QUEUE_CONNECTION=sync

## Próximos Passos

-   Autenticação (JWT ou OAuth)
-   Cache com Redis
-   Form Requests para validação
-   Logs de auditoria
-   Swagger/OpenAPI
-   CI/CD
-   Observabilidade
