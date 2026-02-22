# Instruções Completas

## Objetivo

Backend PHP Laravel para processar, transformar e sincronizar dados de
produtos e preços usando: - SQL Views para normalização - API REST para
sincronização e consulta - Docker para containerização

------------------------------------------------------------------------

## Requisitos

### Mínimo

-   Docker v20.10+
-   Docker Compose v1.29+
-   2GB RAM
-   500MB disco

Nenhuma outra dependência necessária. Tudo roda dentro do Docker.

------------------------------------------------------------------------

## Iniciar o Projeto

### 1. Ir até a pasta

``` bash
cd "c:\estudos-laravel\Nova pasta"
```

### 2. Subir containers

``` bash
docker compose up -d --build
```

Isso irá: - Construir image PHP 8.2 - Instalar dependências - Criar
banco SQLite - Executar migrations - Criar views - Popular dados - Subir
API na porta 8000

### 3. Verificar

``` bash
curl http://127.0.0.1:8000/up
```

Resposta esperada:

    OK

------------------------------------------------------------------------

## Usar a API

### Sincronizar Produtos

``` bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/produtos
```

### Sincronizar Preços

``` bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/precos
```

### Consultar Dados

``` bash
curl "http://127.0.0.1:8000/api/produtos-precos?page=1&per_page=10"
```

------------------------------------------------------------------------

## Testes

Executar:

``` bash
docker compose exec app php artisan test
```

------------------------------------------------------------------------

## Banco de Dados

Executar migrations:

``` bash
docker compose exec app php artisan migrate
```

Executar seed:

``` bash
docker compose exec app php artisan db:seed
```

Reset completo:

``` bash
docker compose exec app php artisan migrate:refresh --seed
```

------------------------------------------------------------------------

## Desenvolvimento

Entrar no container:

``` bash
docker compose exec app bash
```

Ver logs:

``` bash
docker compose logs -f app
```

Tinker:

``` bash
docker compose exec app php artisan tinker
```

------------------------------------------------------------------------

## Comandos Úteis

Parar:

``` bash
docker compose stop
```

Subir:

``` bash
docker compose start
```

Remover:

``` bash
docker compose down
```

Remover tudo:

``` bash
docker compose down -v
```

Status:

``` bash
docker compose ps
```

------------------------------------------------------------------------

## Troubleshooting

Erro Docker não encontrado: instalar Docker Desktop.

Porta ocupada: alterar mapeamento no docker-compose.

Banco não gravável:

``` bash
docker compose exec app chmod 777 database/database.sqlite
```

Rebuild completo:

``` bash
docker compose build --no-cache
docker compose up -d --build
```

------------------------------------------------------------------------

## Reset Total

``` bash
docker compose down -v
docker compose up -d --build
docker compose exec app php artisan test
```

Projeto pronto para rodar apenas com Docker.
