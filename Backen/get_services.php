<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root"; // เปลี่ยนให้ตรงกับการตั้งค่าของคุณ
$password = ""; // เปลี่ยนให้ตรงกับการตั้งค่าของคุณ
$dbname = "service_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$sql = "SELECT id, customer_name, email, phone, description, created_at FROM services ORDER BY created_at DESC";
$result = $conn->query($sql);

$services = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

echo json_encode($services);

$conn->close();
?>
