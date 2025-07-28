<?php
include 'cnn.php';
try {
    $sql = "SELECT COUNT(*) as total FROM clientes";
    $result = $pdo->query($sql)->fetch();
    echo "✓ Database connection successful!<br>";
    echo "Total clients: " . $result['total'] . "<br>";
    
    $sql = "SELECT nome FROM clientes LIMIT 3";
    $clientes = $pdo->query($sql)->fetchAll();
    echo "Sample clients:<br>";
    foreach($clientes as $cliente) {
        echo "- " . $cliente['nome'] . "<br>";
    }
} catch(Exception $e) {
    echo "✗ Database error: " . $e->getMessage();
}
?>