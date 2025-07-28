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

## 🧪 Testing

### Test Individual Exercises
Visit in browser:
- http://localhost:8081/um.php
- http://localhost:8081/dois.php
- http://localhost:8081/tres.php
- etc.

### Test REST API
Run the complete API test suite:
```bash
php RestAPI/test_api.php
```

### Test Database Connection
```bash
http://localhost:8081/test_connection.php
```

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

---

**Ready to start?** Import the databases, start the server, and begin with `um.php`!