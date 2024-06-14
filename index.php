<?php
require './header.php';
require './db.php';
require './api.php';


$database = new Database();
$db = $database->getConnection();


$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        getUsers();
        break;
    case 'POST':
        addUser();
        break;
    case 'PUT':
        updateUser();
        break;
    case 'DELETE':
        deleteUser();
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}


