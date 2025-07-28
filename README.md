# Exercícios PHP - Base de Dados e API REST

Coleção completa de exercícios PHP cobrindo operações de base de dados, serviços web e desenvolvimento de APIs RESTful.

## Estrutura do Projeto

```
Final/
├── README.md                    # Este ficheiro
├── bd.sql                      # Configuração da base de dados principal
├── cnn.php                     # Ligação à base de dados
├── EXERCISE_GUIDE.txt          # Visão geral dos exercícios
│
├── RestAPI/                    # Projeto API RESTful
│   ├── api.php                 # Endpoint principal da API
│   ├── database.sql            # Base de dados dos produtos
│   ├── test_api.php            # Script de teste da API
│   ├── config/
│   │   └── database.php        # Configuração da base de dados da API
│   └── models/
│       └── Produto.php         # Modelo do produto
│
└── [20 Ficheiros de Exercícios] # Exercícios PHP individuais
```

## Início Rápido

### 1. Configuração da Base de Dados

**Base de Dados Principal (bdstandds):**
```sql
mysql -u root -p < bd.sql
```

**Base de Dados da API (api_db):**
```sql
mysql -u root -p < RestAPI/database.sql
```

### 2. Configurar Ligação à Base de Dados

Copiar e configurar os ficheiros da base de dados:
```bash
cp cnn.example.php cnn.php
cp RestAPI/config/database.example.php RestAPI/config/database.php
```

Depois atualizar a password do MySQL em:
- `cnn.php` (linha 5): `$pass = 'sua_password';`
- `RestAPI/config/database.php` (linha 6): `private $password = "sua_password";`

### 3. Iniciar Servidor PHP

```bash
cd Final
php -S localhost:8081
```

## Categorias dos Exercícios

### Operações Core da Base de Dados (4 exercícios)
- **um.php** - SELECT todos os IDs dos clientes
- **dois.php** - SELECT cliente específico com parâmetros
- **tres.php** - INSERT novo registo de cliente
- **quatro.php** - UPDATE cliente existente

### Serviços Web e API (6 exercícios)
- **servico.php** - API REST completa para clientes (GET/POST/PUT/DELETE)
- **getClientes.php** - Mostrar clientes em tabela HTML usando cURL
- **curl_get.php** - Exemplo de pedido GET
- **curl_post.php** - Exemplo de pedido POST
- **curl_sender.php** - Enviar dados via cURL
- **curl_receiver.php** - Receber dados cURL

### Exercícios Adicionais (10 exercícios)
- **delete.php** - Operação DELETE via cURL
- **usarServico.php** - Exemplo de consumo de serviço
- **srv.php** - Manipulador de serviço
- **curl_sendjson.php** - Transmissão de dados JSON
- **Jogo.php**, **Dez.php**, **one.php** - Ficheiros de prática adicional
- **dados.json** - Dados JSON de exemplo
- **test_connection.php** - Teste de ligação à base de dados

## Utilização da API RESTful

### URL Base
```
http://localhost:8081/RestAPI/api.php
```

### Endpoints

**GET Todos os Produtos:**
```bash
curl http://localhost:8081/RestAPI/api.php
```

**GET Produto por ID:**
```bash
curl http://localhost:8081/RestAPI/api.php/1
```

**Pesquisar Produtos:**
```bash
curl "http://localhost:8081/RestAPI/api.php?s=Galaxy"
```

**CRIAR Produto:**
```bash
curl -X POST http://localhost:8081/RestAPI/api.php \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Teste","preco":99.99,"categoria":"Teste"}'
```

**ATUALIZAR Produto:**
```bash
curl -X PUT http://localhost:8081/RestAPI/api.php/1 \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Atualizado","preco":149.99}'
```

**APAGAR Produto:**
```bash
curl -X DELETE http://localhost:8081/RestAPI/api.php/1
```

## Guia Completo de Testes

### Pré-requisitos
1. **Importar ambas as bases de dados** (bd.sql e RestAPI/database.sql)
2. **Configurar passwords** em cnn.php e RestAPI/config/database.php
3. **Iniciar servidor PHP**: `php -S localhost:8081`

### Passo 1: Testar Ligação à Base de Dados
**Teste no Browser:**
```
http://localhost:8081/test_connection.php
```
**Resultado Esperado:** Ligação à base de dados bem-sucedida + lista de clientes

### Passo 2: Operações Core da Base de Dados (4 exercícios)

**2.1 - SELECT Todos os Clientes (um.php)**
```bash
# Browser
http://localhost:8081/um.php

# cURL
curl http://localhost:8081/um.php
```
**Esperado:** Lista de IDs dos clientes (1, 2, 3, 4)

**2.2 - SELECT Cliente Específico (dois.php)**
```bash
# Browser - Cliente padrão ID=3
http://localhost:8081/dois.php

# Browser - Cliente específico
http://localhost:8081/dois.php?id=1

# cURL
curl "http://localhost:8081/dois.php?id=1"
```
**Esperado:** Array de detalhes do cliente

**2.3 - INSERT Novo Cliente (tres.php)**
```bash
# Browser
http://localhost:8081/tres.php

# cURL
curl http://localhost:8081/tres.php
```
**Esperado:** "Afetou 1 registos" (insere Maga Min)

**2.4 - UPDATE Cliente (quatro.php)**
```bash
# Browser
http://localhost:8081/quatro.php

# cURL
curl http://localhost:8081/quatro.php
```
**Esperado:** "Afetou 1 registos" (atualiza cliente ID=9 para 'Pata')

### Passo 3: Serviços Web e Exemplos cURL (6 exercícios)

**3.1 - Serviço API REST Principal (servico.php)**
```bash
# GET todos os clientes
curl http://localhost:8081/servico.php

# GET cliente específico
curl "http://localhost:8081/servico.php?id=1"

# POST novo cliente
curl -X POST http://localhost:8081/servico.php \
  -H "Content-Type: application/json" \
  -d '{"nome":"Teste cURL","categoria":"bravo","datanasc":"1995-01-01"}'

# PUT atualizar cliente
curl -X PUT http://localhost:8081/servico.php \
  -H "Content-Type: application/json" \
  -d '{"idcli":1,"nome":"Nome Atualizado","categoria":"alfa","datanasc":"1990-01-01"}'

# DELETE cliente
curl -X DELETE http://localhost:8081/servico.php \
  -H "Content-Type: application/json" \
  -d '{"idcli":5}'
```

**3.2 - Mostrar Tabela de Clientes (getClientes.php)**
```bash
# Browser
http://localhost:8081/getClientes.php

# cURL
curl http://localhost:8081/getClientes.php
```
**Esperado:** Tabela HTML com dados dos clientes

**3.3 - Exemplo cURL GET (curl_get.php)**
```bash
# Browser - Todos os dados
http://localhost:8081/curl_get.php

# Browser - ID específico
http://localhost:8081/curl_get.php?id=1

# cURL
curl "http://localhost:8081/curl_get.php?id=2"
```
**Esperado:** Tabela HTML ou dados específicos do utilizador

**3.4 - Exemplo cURL POST (curl_post.php)**
```bash
# Browser
http://localhost:8081/curl_post.php

# cURL
curl http://localhost:8081/curl_post.php
```
**Esperado:** Resposta do srv.php com dados enviados

**3.5 - Remetente cURL (curl_sender.php)**
```bash
# Browser
http://localhost:8081/curl_sender.php

# cURL
curl http://localhost:8081/curl_sender.php
```
**Esperado:** Dados enviados para curl_receiver.php

**3.6 - Remetente JSON cURL (curl_sendjson.php)**
```bash
# Browser
http://localhost:8081/curl_sendjson.php

# cURL
curl http://localhost:8081/curl_sendjson.php
```
**Esperado:** Resultado da transmissão de dados JSON

### Passo 4: Exercícios Adicionais (10 exercícios)

**4.1 - DELETE via cURL (delete.php)**
```bash
# Browser
http://localhost:8081/delete.php

# cURL
curl http://localhost:8081/delete.php
```
**Esperado:** Mensagem de confirmação de eliminação

**4.2 - Utilização de Serviço (usarServico.php)**
```bash
# Browser
http://localhost:8081/usarServico.php

# cURL
curl http://localhost:8081/usarServico.php
```

**4.3 - Manipulador de Serviço (srv.php)**
```bash
# Pedido GET
curl http://localhost:8081/srv.php

# Pedido POST
curl -X POST http://localhost:8081/srv.php \
  -d "name=Test&email=test@example.com"
```
**Esperado:** Resposta JSON de dados.json ou confirmação POST

**4.4-4.10 - Ficheiros Adicionais**
```bash
# Testar exercícios restantes
curl http://localhost:8081/Jogo.php
curl http://localhost:8081/Dez.php
curl http://localhost:8081/one.php
```

### Passo 5: Teste da API RESTful (Produtos)

**5.1 - Suite de Teste Automatizada**
```bash
php RestAPI/test_api.php
```
**Esperado:** Sequência completa de teste com códigos HTTP e respostas

**5.2 - Teste Manual da API**
```bash
# GET todos os produtos
curl http://localhost:8081/RestAPI/api.php

# GET produto por ID
curl http://localhost:8081/RestAPI/api.php/1

# Pesquisar produtos
curl "http://localhost:8081/RestAPI/api.php?s=Galaxy"

# CRIAR produto
curl -X POST http://localhost:8081/RestAPI/api.php \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Manual","preco":199.99,"categoria":"Teste","estoque":10,"descricao":"Produto criado manualmente"}'

# ATUALIZAR produto
curl -X PUT http://localhost:8081/RestAPI/api.php/1 \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Atualizado","preco":299.99,"estoque":20}'

# APAGAR produto
curl -X DELETE http://localhost:8081/RestAPI/api.php/1
```

### Passo 6: Lista de Verificação de Validação

**Operações da Base de Dados:**
- [ ] um.php mostra IDs dos clientes
- [ ] dois.php mostra detalhes do cliente
- [ ] tres.php insere novo cliente
- [ ] quatro.php atualiza cliente

**Serviços Web:**
- [ ] servico.php trata GET/POST/PUT/DELETE
- [ ] getClientes.php mostra tabela HTML
- [ ] Exemplos cURL funcionam corretamente

**API REST:**
- [ ] Todas as operações CRUD funcionam
- [ ] Funcionalidade de pesquisa funciona
- [ ] Tratamento de erros funciona (404, 400, etc.)
- [ ] Respostas JSON são válidas

**Teste de Erros:**
```bash
# Testar endpoints inexistentes
curl http://localhost:8081/nonexistent.php
curl http://localhost:8081/RestAPI/api.php/999

# Testar dados inválidos
curl -X POST http://localhost:8081/RestAPI/api.php \
  -H "Content-Type: application/json" \
  -d '{"nome":""}'
```

### Códigos de Status HTTP Esperados
- **200**: GET/PUT/DELETE bem-sucedido
- **201**: POST bem-sucedido (criado)
- **400**: Pedido inválido (dados em falta)
- **404**: Não encontrado
- **405**: Método não permitido
- **503**: Serviço indisponível

## Esquema da Base de Dados

### Base de Dados Principal (bdstandds)

**Tabela clientes:**
- `idcli` - ID auto incremento
- `nome` - Nome do cliente (varchar 120)
- `datanasc` - Data de nascimento (datetime)
- `categoria` - Categoria (enum: alfa, bravo, charlie)
- `tutor` - Chave estrangeira auto-referenciante
- `idade` - Campo de idade calculada

**Tabela carros:**
- `idcar` - ID auto incremento
- `modelo` - Modelo do carro (varchar 120)
- `phora` - Preço por hora (decimal 10,2)

**Tabela alugueres:**
- `idal` - ID auto incremento
- `idcli` - Chave estrangeira do cliente
- `idcar` - Chave estrangeira do carro
- `inicio` - Datetime de início
- `fim` - Datetime de fim
- `tempo` - Duração calculada (virtual)
- `custo` - Custo calculado

### Base de Dados da API (api_db)

**Tabela produtos:**
- `id` - ID auto incremento
- `nome` - Nome do produto
- `preco` - Preço (decimal 10,2)
- `categoria` - Categoria
- `estoque` - Quantidade em stock
- `descricao` - Descrição
- `created_at` - Timestamp de criação
- `updated_at` - Timestamp de atualização

## O Que Vai Aprender

### Conceitos de Base de Dados
- Ligações PDO e declarações preparadas
- Operações CRUD (Create, Read, Update, Delete)
- Chaves estrangeiras e relacionamentos
- Procedimentos armazenados e triggers
- Colunas geradas/calculadas

### Desenvolvimento Web
- Design e implementação de API REST
- Métodos HTTP (GET, POST, PUT, DELETE)
- Manipulação de dados JSON
- cURL para pedidos HTTP
- Tratamento de erros e códigos de status

### Boas Práticas PHP
- Programação orientada a objetos
- Bases do padrão MVC
- Validação e sanitização de entrada
- Considerações de segurança

## Resolução de Problemas

### Problemas Comuns

**Erro de Ligação à Base de Dados:**
- Verificar se o MySQL está a correr
- Verificar credenciais em `cnn.php` e `RestAPI/config/database.php`
- Assegurar que as bases de dados existem

**Porta 8081 Já Em Uso:**
```bash
php -S localhost:8082  # Usar porta diferente
```

**API Não Funciona:**
- Verificar se ambas as bases de dados estão importadas
- Verificar permissões de ficheiros
- Verificar logs de erro do PHP

### Modo Debug
Adicionar a qualquer ficheiro PHP para debug:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## Notas

- Todos os exercícios usam a mesma ligação à base de dados (`cnn.php`)
- API REST usa base de dados separada para produtos
- Ficheiros de teste incluídos para validação
- Headers CORS ativados para API
- Sanitização de entrada implementada
- Códigos de status HTTP apropriados utilizados

## Objetivos dos Exercícios

1. **Dominar operações de base de dados** - Aprender PDO, declarações preparadas, CRUD
2. **Compreender serviços web** - Criar e consumir APIs
3. **Praticar métodos HTTP** - GET, POST, PUT, DELETE
4. **Manipular dados JSON** - Codificação, descodificação, validação
5. **Implementar segurança** - Sanitização de entrada, tratamento de erros
6. **Usar PHP moderno** - OOP, namespaces, boas práticas

## Configuração Git

### Clonar Repositório
```bash
git clone https://github.com/SEU_UTILIZADOR/php-database-exercises.git
cd php-database-exercises
```

### Configurar Configuração
```bash
cp cnn.example.php cnn.php
cp RestAPI/config/database.example.php RestAPI/config/database.php
```

Atualizar passwords em ambos os ficheiros, depois seguir o guia de Início Rápido.

---

**Pronto para começar?** Importe as bases de dados, inicie o servidor e comece com `um.php`!