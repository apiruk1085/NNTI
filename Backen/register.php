<?php
require 'condb.php';

$data = json_decode(file_get_contents("php://input"));
if ($data) {
$stmt = $conn->prepare("INSERT INTO customers (first_name, last_name, username, password) 
VALUES ( ?, ?, ?, ?)");
$hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);
$stmt->execute([$data->first_name, 
    $data->last_name, 
    $data->username, 
    $hashedPassword]);

echo json_encode(["message" => "Registration successful"]);
}
?>