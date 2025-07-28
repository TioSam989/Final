# PHP Database & REST API Exercises

Complete collection of PHP exercises covering database operations, web services, and RESTful API development.

## 📁 Project Structure

```
Final/
├── README.md                    # This file
├── bd.sql                      # Main database setup
├── cnn.php                     # Database connection
├── EXERCISE_GUIDE.txt          # Exercise overview
│
├── RestAPI/                    # RESTful API Project
│   ├── api.php                 # Main API endpoint
│   ├── database.sql            # Products database
│   ├── test_api.php            # API testing script
│   ├── config/
│   │   └── database.php        # API database config
│   └── models/
│       └── Produto.php         # Product model
│
└── [20 Exercise Files]         # Individual PHP exercises
```

## 🚀 Quick Start

### 1. Database Setup

**Main Database (bdstandds):**
```sql
mysql -u root -p < bd.sql
```

**API Database (api_db):**
```sql
mysql -u root -p < RestAPI/database.sql
```

### 2. Configure Database Connection

Copy and configure the database files:
```bash
cp cnn.example.php cnn.php
cp RestAPI/config/database.example.php RestAPI/config/database.php
```

Then update your MySQL password in:
- `cnn.php` (line 5): `$pass = 'your_password';`
- `RestAPI/config/database.php` (line 6): `private $password = "your_password";`

### 3. Start PHP Server

```bash
cd Final
php -S localhost:8081
```

## 📚 Exercise Categories

### Core Database Operations (4 exercises)
- **um.php** - SELECT all client IDs
- **dois.php** - SELECT specific client with parameters
- **tres.php** - INSERT new client record
- **quatro.php** - UPDATE existing client

### Web Services & API (6 exercises)
- **servico.php** - Complete REST API for clients (GET/POST/PUT/DELETE)
- **getClientes.php** - Display clients in HTML table using cURL
- **curl_get.php** - GET request example
- **curl_post.php** - POST request example
- **curl_sender.php** - Send data via cURL
- **curl_receiver.php** - Receive cURL data

### Additional Exercises (10 exercises)
- **delete.php** - DELETE operation via cURL
- **usarServico.php** - Service consumption example
- **srv.php** - Service handler
- **curl_sendjson.php** - JSON data transmission
- **Jogo.php**, **Dez.php**, **one.php** - Additional practice files
- **dados.json** - Sample JSON data
- **test_connection.php** - Database connection test

## 🔧 RESTful API Usage

### Base URL
```
http://localhost:8081/RestAPI/api.php
```

### Endpoints

**GET All Products:**
```bash
curl http://localhost:8081/RestAPI/api.php
```

**GET Product by ID:**
```bash
curl http://localhost:8081/RestAPI/api.php/1
```

**Search Products:**
```bash
curl "http://localhost:8081/RestAPI/api.php?s=Galaxy"
```

**CREATE Product:**
```bash
curl -X POST http://localhost:8081/RestAPI/api.php \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Teste","preco":99.99,"categoria":"Teste"}'
```

**UPDATE Product:**
```bash
curl -X PUT http://localhost:8081/RestAPI/api.php/1 \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Atualizado","preco":149.99}'
```

**DELETE Product:**
```bash
curl -X DELETE http://localhost:8081/RestAPI/api.php/1
```

## 🧪 Complete Testing Guide

### Prerequisites
1. **Import both databases** (bd.sql and RestAPI/database.sql)
2. **Configure passwords** in cnn.php and RestAPI/config/database.php
3. **Start PHP server**: `php -S localhost:8081`

### Step 1: Test Database Connection
**Browser Test:**
```
http://localhost:8081/test_connection.php
```
**Expected Result:** ✓ Database connection successful + client list

### Step 2: Core Database Operations (4 exercises)

**2.1 - SELECT All Clients (um.php)**
```bash
# Browser
http://localhost:8081/um.php

# cURL
curl http://localhost:8081/um.php
```
**Expected:** List of client IDs (1, 2, 3, 4)

**2.2 - SELECT Specific Client (dois.php)**
```bash
# Browser - Default client ID=3
http://localhost:8081/dois.php

# Browser - Specific client
http://localhost:8081/dois.php?id=1

# cURL
curl "http://localhost:8081/dois.php?id=1"
```
**Expected:** Client details array

**2.3 - INSERT New Client (tres.php)**
```bash
# Browser
http://localhost:8081/tres.php

# cURL
curl http://localhost:8081/tres.php
```
**Expected:** "Afetou 1 registos" (inserts Maga Min)

**2.4 - UPDATE Client (quatro.php)**
```bash
# Browser
http://localhost:8081/quatro.php

# cURL
curl http://localhost:8081/quatro.php
```
**Expected:** "Afetou 1 registos" (updates client ID=9 to 'Pata')

### Step 3: Web Services & cURL Examples (6 exercises)

**3.1 - Main REST API Service (servico.php)**
```bash
# GET all clients
curl http://localhost:8081/servico.php

# GET specific client
curl "http://localhost:8081/servico.php?id=1"

# POST new client
curl -X POST http://localhost:8081/servico.php \
  -H "Content-Type: application/json" \
  -d '{"nome":"Teste cURL","categoria":"bravo","datanasc":"1995-01-01"}'

# PUT update client
curl -X PUT http://localhost:8081/servico.php \
  -H "Content-Type: application/json" \
  -d '{"idcli":1,"nome":"Nome Atualizado","categoria":"alfa","datanasc":"1990-01-01"}'

# DELETE client
curl -X DELETE http://localhost:8081/servico.php \
  -H "Content-Type: application/json" \
  -d '{"idcli":5}'
```

**3.2 - Display Clients Table (getClientes.php)**
```bash
# Browser
http://localhost:8081/getClientes.php

# cURL
curl http://localhost:8081/getClientes.php
```
**Expected:** HTML table with client data

**3.3 - cURL GET Example (curl_get.php)**
```bash
# Browser - All data
http://localhost:8081/curl_get.php

# Browser - Specific ID
http://localhost:8081/curl_get.php?id=1

# cURL
curl "http://localhost:8081/curl_get.php?id=2"
```
**Expected:** HTML table or specific user data

**3.4 - cURL POST Example (curl_post.php)**
```bash
# Browser
http://localhost:8081/curl_post.php

# cURL
curl http://localhost:8081/curl_post.php
```
**Expected:** Response from srv.php with posted data

**3.5 - cURL Sender (curl_sender.php)**
```bash
# Browser
http://localhost:8081/curl_sender.php

# cURL
curl http://localhost:8081/curl_sender.php
```
**Expected:** Data sent to curl_receiver.php

**3.6 - cURL JSON Sender (curl_sendjson.php)**
```bash
# Browser
http://localhost:8081/curl_sendjson.php

# cURL
curl http://localhost:8081/curl_sendjson.php
```
**Expected:** JSON data transmission result

### Step 4: Additional Exercises (10 exercises)

**4.1 - DELETE via cURL (delete.php)**
```bash
# Browser
http://localhost:8081/delete.php

# cURL
curl http://localhost:8081/delete.php
```
**Expected:** Delete confirmation message

**4.2 - Service Usage (usarServico.php)**
```bash
# Browser
http://localhost:8081/usarServico.php

# cURL
curl http://localhost:8081/usarServico.php
```

**4.3 - Service Handler (srv.php)**
```bash
# GET request
curl http://localhost:8081/srv.php

# POST request
curl -X POST http://localhost:8081/srv.php \
  -d "name=Test&email=test@example.com"
```
**Expected:** JSON response from dados.json or POST confirmation

**4.4-4.10 - Additional Files**
```bash
# Test remaining exercises
curl http://localhost:8081/Jogo.php
curl http://localhost:8081/Dez.php
curl http://localhost:8081/one.php
```

### Step 5: RESTful API Testing (Products)

**5.1 - Automated Test Suite**
```bash
php RestAPI/test_api.php
```
**Expected:** Complete test sequence with HTTP codes and responses

**5.2 - Manual API Testing**
```bash
# GET all products
curl http://localhost:8081/RestAPI/api.php

# GET product by ID
curl http://localhost:8081/RestAPI/api.php/1

# Search products
curl "http://localhost:8081/RestAPI/api.php?s=Galaxy"

# CREATE product
curl -X POST http://localhost:8081/RestAPI/api.php \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Manual","preco":199.99,"categoria":"Teste","estoque":10,"descricao":"Produto criado manualmente"}'

# UPDATE product
curl -X PUT http://localhost:8081/RestAPI/api.php/1 \
  -H "Content-Type: application/json" \
  -d '{"nome":"Produto Atualizado","preco":299.99,"estoque":20}'

# DELETE product
curl -X DELETE http://localhost:8081/RestAPI/api.php/1
```

### Step 6: Validation Checklist

**✅ Database Operations:**
- [ ] um.php shows client IDs
- [ ] dois.php shows client details
- [ ] tres.php inserts new client
- [ ] quatro.php updates client

**✅ Web Services:**
- [ ] servico.php handles GET/POST/PUT/DELETE
- [ ] getClientes.php displays HTML table
- [ ] cURL examples work correctly

**✅ REST API:**
- [ ] All CRUD operations work
- [ ] Search functionality works
- [ ] Error handling works (404, 400, etc.)
- [ ] JSON responses are valid

**✅ Error Testing:**
```bash
# Test non-existent endpoints
curl http://localhost:8081/nonexistent.php
curl http://localhost:8081/RestAPI/api.php/999

# Test invalid data
curl -X POST http://localhost:8081/RestAPI/api.php \
  -H "Content-Type: application/json" \
  -d '{"nome":""}'
```

### Expected HTTP Status Codes
- **200**: Successful GET/PUT/DELETE
- **201**: Successful POST (created)
- **400**: Bad request (missing data)
- **404**: Not found
- **405**: Method not allowed
- **503**: Service unavailable

## 📊 Database Schema

### Main Database (bdstandds)

**clientes table:**
- `idcli` - Auto increment ID
- `nome` - Client name (varchar 120)
- `datanasc` - Birth date (datetime)
- `categoria` - Category (enum: alfa, bravo, charlie)
- `tutor` - Self-referencing foreign key
- `idade` - Calculated age field

**carros table:**
- `idcar` - Auto increment ID
- `modelo` - Car model (varchar 120)
- `phora` - Price per hour (decimal 10,2)

**alugueres table:**
- `idal` - Auto increment ID
- `idcli` - Client foreign key
- `idcar` - Car foreign key
- `inicio` - Start datetime
- `fim` - End datetime
- `tempo` - Calculated duration (virtual)
- `custo` - Calculated cost

### API Database (api_db)

**produtos table:**
- `id` - Auto increment ID
- `nome` - Product name
- `preco` - Price (decimal 10,2)
- `categoria` - Category
- `estoque` - Stock quantity
- `descricao` - Description
- `created_at` - Creation timestamp
- `updated_at` - Update timestamp

## 🛠️ What You Learn

### Database Concepts
- PDO connections and prepared statements
- CRUD operations (Create, Read, Update, Delete)
- Foreign keys and relationships
- Stored procedures and triggers
- Generated/calculated columns

### Web Development
- REST API design and implementation
- HTTP methods (GET, POST, PUT, DELETE)
- JSON data handling
- cURL for HTTP requests
- Error handling and status codes

### PHP Best Practices
- Object-oriented programming
- MVC pattern basics
- Input validation and sanitization
- Security considerations

## 🔍 Troubleshooting

### Common Issues

**Database Connection Error:**
- Check MySQL is running
- Verify credentials in `cnn.php` and `RestAPI/config/database.php`
- Ensure databases exist

**Port 8081 Already in Use:**
```bash
php -S localhost:8082  # Use different port
```

**API Not Working:**
- Check if both databases are imported
- Verify file permissions
- Check PHP error logs

### Debug Mode
Add to any PHP file for debugging:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 📝 Notes

- All exercises use the same database connection (`cnn.php`)
- REST API uses separate database for products
- Test files included for validation
- CORS headers enabled for API
- Input sanitization implemented
- Proper HTTP status codes used

## 🎯 Exercise Objectives

1. **Master database operations** - Learn PDO, prepared statements, CRUD
2. **Understand web services** - Create and consume APIs
3. **Practice HTTP methods** - GET, POST, PUT, DELETE
4. **Handle JSON data** - Encoding, decoding, validation
5. **Implement security** - Input sanitization, error handling
6. **Use modern PHP** - OOP, namespaces, best practices

## 🔄 Git Setup

### Clone Repository
```bash
git clone https://github.com/YOUR_USERNAME/php-database-exercises.git
cd php-database-exercises
```

### Setup Configuration
```bash
cp cnn.example.php cnn.php
cp RestAPI/config/database.example.php RestAPI/config/database.php
```

Update passwords in both files, then follow the Quick Start guide.

---

**Ready to start?** Import the databases, start the server, and begin with `um.php`!