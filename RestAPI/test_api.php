<?php
$base_url = "http://localhost:8081/RestAPI/api.php";

function makeRequest($url, $method = 'GET', $data = null, $headers = array()) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $headers[] = 'Content-Type: application/json';
    }
    
    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "=== $method Request ===\n";
    echo "URL: $url\n";
    if ($data) {
        echo "Data: " . json_encode($data) . "\n";
    }
    echo "HTTP Code: $http_code\n";
    echo "Response: $response\n\n";
    
    return json_decode($response, true);
}

echo "=== TESTE COMPLETO DA API RESTful ===\n\n";

echo "1. Criando produtos...\n";
$produto1 = array(
    "nome" => "Smartphone Galaxy",
    "preco" => 2500.99,
    "categoria" => "Eletrônicos",
    "estoque" => 50,
    "descricao" => "Smartphone Android com 128GB de armazenamento"
);

$produto2 = array(
    "nome" => "Notebook Dell",
    "preco" => 3200.00,
    "categoria" => "Informática",
    "estoque" => 25,
    "descricao" => "Notebook para uso profissional com SSD 512GB"
);

$produto3 = array(
    "nome" => "Mesa Gamer",
    "preco" => 450.50,
    "categoria" => "Móveis",
    "estoque" => 15,
    "descricao" => "Mesa ergonômica para setup gamer"
);

makeRequest($base_url, 'POST', $produto1);
makeRequest($base_url, 'POST', $produto2);
makeRequest($base_url, 'POST', $produto3);

echo "2. Listando todos os produtos...\n";
$produtos = makeRequest($base_url, 'GET');

echo "3. Buscando produto específico (ID: 1)...\n";
makeRequest($base_url . "/1", 'GET');

echo "4. Buscando produtos por palavra-chave...\n";
makeRequest($base_url . "?s=Galaxy", 'GET');

echo "5. Atualizando produto (ID: 1)...\n";
$update_data = array(
    "nome" => "Smartphone Galaxy S24",
    "preco" => 2799.99,
    "estoque" => 75
);
makeRequest($base_url . "/1", 'PUT', $update_data);

echo "6. Verificando produto atualizado...\n";
makeRequest($base_url . "/1", 'GET');

echo "7. Testando produto inexistente...\n";
makeRequest($base_url . "/999", 'GET');

echo "8. Testando criação com dados incompletos...\n";
$produto_incompleto = array("nome" => "Produto Sem Preço");
makeRequest($base_url, 'POST', $produto_incompleto);

echo "9. Listando produtos finais...\n";
makeRequest($base_url, 'GET');

echo "10. Deletando produto (ID: 2)...\n";
makeRequest($base_url . "/2", 'DELETE');

echo "11. Verificando lista após deleção...\n";
makeRequest($base_url, 'GET');

echo "=== FIM DOS TESTES ===\n";
?>