<?php
require './header.php';
require './db.php';


$database = new Database();
$db = $database->getConnection();


$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        getProduct();
        break;
    case 'POST':
        // addUser();
        break;
    case 'PUT':
        // updateUser();
        break;
    case 'DELETE':
        // deleteUser();
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}



// Products Functions


function getProduct()
{
    global $db;
    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT p.id, p.name, p.description, p.price, u.name AS vendor_name, u.email AS vendor_email FROM products p JOIN users u ON p.vender_id = u.vender_id WHERE u.id = $id";
        } else {
            $query = "SELECT p.id, p.name, p.description, p.price, u.name AS vendor_name, u.email AS vendor_email FROM products p JOIN users u ON p.vender_id = u.vender_id";
        }
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Faild to fetch prodct", "error" => $e->getMessage()]);
    }
}