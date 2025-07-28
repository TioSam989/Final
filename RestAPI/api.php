<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'models/Produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

$request_method = $_SERVER["REQUEST_METHOD"];
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path_parts = explode('/', $path);
$id = isset($path_parts[3]) ? $path_parts[3] : null;

switch($request_method) {
    case 'GET':
        if($id) {
            $produto->id = $id;
            if($produto->readOne()) {
                $produto_arr = array(
                    "id" => $produto->id,
                    "nome" => $produto->nome,
                    "preco" => $produto->preco,
                    "categoria" => $produto->categoria,
                    "estoque" => $produto->estoque,
                    "descricao" => $produto->descricao,
                    "created_at" => $produto->created_at,
                    "updated_at" => $produto->updated_at
                );
                http_response_code(200);
                echo json_encode($produto_arr);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Produto não encontrado."));
            }
        } else {
            $keywords = isset($_GET['s']) ? $_GET['s'] : "";
            if(!empty($keywords)) {
                $stmt = $produto->search($keywords);
            } else {
                $stmt = $produto->read();
            }
            $num = $stmt->rowCount();
            
            if($num > 0) {
                $produtos_arr = array();
                $produtos_arr["records"] = array();
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $produto_item = array(
                        "id" => $id,
                        "nome" => $nome,
                        "preco" => $preco,
                        "categoria" => $categoria,
                        "estoque" => $estoque,
                        "descricao" => html_entity_decode($descricao),
                        "created_at" => $created_at,
                        "updated_at" => $updated_at
                    );
                    array_push($produtos_arr["records"], $produto_item);
                }
                http_response_code(200);
                echo json_encode($produtos_arr);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Nenhum produto encontrado."));
            }
        }
        break;
        
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->nome) && !empty($data->preco) && !empty($data->categoria)) {
            $produto->nome = $data->nome;
            $produto->preco = $data->preco;
            $produto->categoria = $data->categoria;
            $produto->estoque = isset($data->estoque) ? $data->estoque : 0;
            $produto->descricao = isset($data->descricao) ? $data->descricao : "";
            
            if($produto->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Produto criado com sucesso."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Não foi possível criar o produto."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Dados incompletos. Nome, preço e categoria são obrigatórios."));
        }
        break;
        
    case 'PUT':
        if($id) {
            $data = json_decode(file_get_contents("php://input"));
            
            $produto->id = $id;
            if($produto->readOne()) {
                $produto->nome = !empty($data->nome) ? $data->nome : $produto->nome;
                $produto->preco = !empty($data->preco) ? $data->preco : $produto->preco;
                $produto->categoria = !empty($data->categoria) ? $data->categoria : $produto->categoria;
                $produto->estoque = isset($data->estoque) ? $data->estoque : $produto->estoque;
                $produto->descricao = isset($data->descricao) ? $data->descricao : $produto->descricao;
                
                if($produto->update()) {
                    http_response_code(200);
                    echo json_encode(array("message" => "Produto atualizado com sucesso."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Não foi possível atualizar o produto."));
                }
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Produto não encontrado."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID do produto é necessário."));
        }
        break;
        
    case 'DELETE':
        if($id) {
            $produto->id = $id;
            if($produto->readOne()) {
                if($produto->delete()) {
                    http_response_code(200);
                    echo json_encode(array("message" => "Produto deletado com sucesso."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Não foi possível deletar o produto."));
                }
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Produto não encontrado."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID do produto é necessário."));
        }
        break;
        
    case 'OPTIONS':
        http_response_code(200);
        break;
        
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Método não permitido."));
        break;
}
?>