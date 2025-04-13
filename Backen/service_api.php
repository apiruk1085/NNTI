<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$username = "root";  // แก้ไขตามการตั้งค่าของคุณ
$password = "";  // แก้ไขตามการตั้งค่าของคุณ
$dbname = "service_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['customer_name']) && !empty($data['email']) && !empty($data['phone']) && !empty($data['description'])) {
    $stmt = $conn->prepare("INSERT INTO services (customer_name, email, phone, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data['customer_name'], $data['email'], $data['phone'], $data['description']);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Data saved successfully"]);
    } else {
        echo json_encode(["error" => "Data not saved"]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$conn->close();
?>
