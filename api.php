<?php


function getProduct(){
    global $db;
    try{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT p.id, p.name, p.description, p.price, u.name AS vendor_name, u.email AS vendor_email FROM products p JOIN users u ON p.vender_id = u.vender_id WHERE u.id = $id";
        }else{
            $query = "SELECT p.id, p.name, p.description, p.price, u.name AS vendor_name, u.email AS vendor_email FROM products p JOIN users u ON p.vender_id = u.vender_id";
        }
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }catch (Exception $e){
        http_response_code(500);
        echo json_encode(["message"=>"Faild to fetch prodct","error"=>$e->getMessage()]);
    }
}



// User Table functions 



function getUsers()
{
    global $db;
    try {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM users WHERE id=$id";
        }else{
            $query = "SELECT * FROM users"; 
        }
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Faild to fetch users", "error" => $e->getMessage()]);
    }
}
function addUser()
{
    global $db;
    try {
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data->name) || !isset($data->email) || !isset($data->password)) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }
        $query = "INSERT INTO users (name, email,password) VALUES(:name,:email,:password)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':name', $data->name);
        $stmt->bindValue(':email', $data->email);
        $stmt->bindValue(':password', password_hash($data->password, PASSWORD_BCRYPT));
        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(["message" => "User added succefully"]);
        } else {
            throw new Exception("Faild to add user");
        }

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Faild to add users", "error" => $e->getMessage()]);
    }
}
function updateUser()
{
    global $db;
    try {
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data->name) || !isset($data->email) || !isset($data->password)) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }
        $query = "UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':name', $data->name);
        $stmt->bindValue(':email', $data->email);
        $stmt->bindValue(':password', password_hash($data->password, PASSWORD_BCRYPT));
        $stmt->bindValue(':id', $data->id);
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["message" => "User updated succefully"]);
        } else {
            throw new Exception("Faild to Update user");
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Faild to Update users details", "error" => $e->getMessage()]);
    }
}
function deleteUser()
{
    global $db;
    try {
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data->id)) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid input']);
            return;
        }
        $query = "DELETE FROM users WHERE id=:id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $data->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'User Deleted successfully']);
        } else {
            throw new Exception("Failed to delete user");
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Faild delete users", "error" => $e->getMessage()]);
    }
}


