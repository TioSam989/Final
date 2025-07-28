<?php
class Produto {
    private $conn;
    private $table = "produtos";
    
    public $id;
    public $nome;
    public $preco;
    public $categoria;
    public $estoque;
    public $descricao;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET nome=:nome, preco=:preco, categoria=:categoria, estoque=:estoque, descricao=:descricao";
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->estoque = htmlspecialchars(strip_tags($this->estoque));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":estoque", $this->estoque);
        $stmt->bindParam(":descricao", $this->descricao);
        
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->nome = $row['nome'];
            $this->preco = $row['preco'];
            $this->categoria = $row['categoria'];
            $this->estoque = $row['estoque'];
            $this->descricao = $row['descricao'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
        }
        return $row ? true : false;
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET nome=:nome, preco=:preco, categoria=:categoria, estoque=:estoque, descricao=:descricao WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->estoque = htmlspecialchars(strip_tags($this->estoque));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":estoque", $this->estoque);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":id", $this->id);
        
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table . " WHERE nome LIKE ? OR categoria LIKE ? OR descricao LIKE ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->execute();
        return $stmt;
    }
}
?>