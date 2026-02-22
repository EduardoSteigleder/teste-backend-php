# Índice de Documentação

Este projeto é um backend PHP Laravel para sincronização de produtos e
preços.

Se você acabou de abrir o repositório, abaixo está um guia simples para
saber por onde começar.

------------------------------------------------------------------------

## Por onde começar

### Quer rodar o projeto agora?

Abra o terminal na pasta do projeto e execute:

``` bash
docker compose up -d --build
```

Se quiser um passo a passo mais detalhado, veja o arquivo:

-   QUICKSTART.md

------------------------------------------------------------------------

### Quer entender melhor o que foi feito?

-   INSTRUÇÕES.md -- guia completo em português
-   ESTRUTURA.md -- organização de pastas e arquivos
-   README.md -- documentação técnica mais detalhada

------------------------------------------------------------------------

### Quer testar a API?

Veja exemplos práticos em:

-   TESTES.md

Você encontrará exemplos usando cURL e outras formas de testar os
endpoints.

------------------------------------------------------------------------

## O que esse projeto faz

O fluxo é simples:

Dados brutos nas tabelas base\
→ passam por Views SQL para normalização\
→ são sincronizados via Controller\
→ ficam disponíveis para consulta pela API REST

A API permite:

-   Sincronizar produtos
-   Sincronizar preços
-   Consultar produtos com preços (com paginação)

------------------------------------------------------------------------

## Endpoints disponíveis

POST /api/sincronizar/produtos\
POST /api/sincronizar/precos\
GET /api/produtos-precos

Para exemplos completos de requisição e resposta, consulte o README.md.

------------------------------------------------------------------------

## Banco de Dados

Tabelas base: - produtos_base - precos_base

Tabelas de destino: - produto_insercao - preco_insercao

Views SQL: - view_produtos_processados - view_precos_processados

As views são responsáveis por normalizar os dados e filtrar apenas
registros ativos.

------------------------------------------------------------------------

## Tecnologias utilizadas

-   PHP 8.2
-   Laravel 11
-   SQLite
-   Docker e Docker Compose
-   PHPUnit para testes

------------------------------------------------------------------------

## Comandos úteis

Subir o projeto:

``` bash
docker compose up -d --build
```

Parar:

``` bash
docker compose down
```

Rodar testes:

``` bash
docker compose exec app php artisan test
```

Acessar o container:

``` bash
docker compose exec app bash
```

------------------------------------------------------------------------

## Observação

O projeto foi estruturado para rodar integralmente via Docker, sem
necessidade de instalar PHP ou banco de dados localmente.

Se quiser entender decisões técnicas, arquitetura ou detalhes de
implementação, recomendo começar pelo README.md.
