# Guia de Testes da API

Este guia mostra diferentes formas de testar os endpoints da aplicação. Você pode usar cURL, Postman, Insomnia ou até scripts simples em Python ou JavaScript.

---

## Testando com cURL

### Sincronizar Produtos

```bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/produtos
```

### Sincronizar Preços

```bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/precos
```

### Listar Produtos (página 1)

```bash
curl "http://127.0.0.1:8000/api/produtos-precos?page=1&per_page=10"
```

### Paginação (exemplo)

```bash
curl "http://127.0.0.1:8000/api/produtos-precos?page=2&per_page=5"
```

---

## Testando com Postman

Você pode importar o arquivo `openapi.json` diretamente:

1. Abrir o Postman
2. Clicar em Import
3. Selecionar o arquivo `openapi.json`

Ou criar manualmente:

### POST - Sincronizar Produtos

* URL: [http://127.0.0.1:8000/api/sincronizar/produtos](http://127.0.0.1:8000/api/sincronizar/produtos)
* Método: POST
* Body: vazio

### POST - Sincronizar Preços

* URL: [http://127.0.0.1:8000/api/sincronizar/precos](http://127.0.0.1:8000/api/sincronizar/precos)
* Método: POST
* Body: vazio

### GET - Listar Produtos

* URL: [http://127.0.0.1:8000/api/produtos-precos?page=1&per_page=10](http://127.0.0.1:8000/api/produtos-precos?page=1&per_page=10)
* Método: GET

---

## Testando com Insomnia

Criar requisições simples:

### Sincronizar Produtos

* Método: POST
* URL: [http://127.0.0.1:8000/api/sincronizar/produtos](http://127.0.0.1:8000/api/sincronizar/produtos)

### Listar Produtos

* Método: GET
* URL: [http://127.0.0.1:8000/api/produtos-precos](http://127.0.0.1:8000/api/produtos-precos)
* Query params:

  * page: 1
  * per_page: 10

---

## Testando com Python (requests)

```python
import requests

BASE_URL = "http://127.0.0.1:8000/api"

# Sincronizar produtos
requests.post(f"{BASE_URL}/sincronizar/produtos")

# Sincronizar preços
requests.post(f"{BASE_URL}/sincronizar/precos")

# Listar produtos
response = requests.get(
    f"{BASE_URL}/produtos-precos",
    params={"page": 1, "per_page": 10}
)
print(response.json())
```

---

## Testando com JavaScript (fetch)

```javascript
const BASE_URL = "http://127.0.0.1:8000/api";

fetch(`${BASE_URL}/sincronizar/produtos`, { method: "POST" });

fetch(`${BASE_URL}/sincronizar/precos`, { method: "POST" });

fetch(`${BASE_URL}/produtos-precos?page=1&per_page=10`)
  .then(res => res.json())
  .then(data => console.log(data));
```

---

## Sequência recomendada de teste

1. Subir os containers
2. Executar sincronização de produtos
3. Executar sincronização de preços
4. Fazer GET /produtos-precos
5. Testar paginação

---

## O que você deve validar

* Apenas produtos ativos aparecem
* Dados estão normalizados (maiúsculo, sem espaços extras)
* Reexecutar sincronização não cria duplicidade
* Paginação funciona corretamente

---

## Status HTTP esperados

* 200 para sucesso
* 500 em caso de erro interno

---

## Problemas comuns

### Connection refused

Verifique se o container está rodando:

```bash
docker compose ps
```

### 404

Confira se a URL contém `/api/`

### 500

Verifique os logs:

```bash
docker compose logs app
```



