<?php
session_start();
require 'condb.php';

// ตั้งค่า header สำหรับ JSON response
header('Content-Type: application/json');

// รับข้อมูลจาก frontend
$data = json_decode(file_get_contents("php://input"));

if ($data && isset($data->username) && isset($data->password)) {
    try {
        // เตรียม SQL เพื่อค้นหาผู้ใช้
        $stmt = $conn->prepare("SELECT * FROM customers WHERE username = ?");
        $stmt->execute([$data->username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // ตรวจสอบรหัสผ่าน
            if (password_verify($data->password, $user['password'])) {
                // บันทึกข้อมูลใน session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'firstName' => $user['first_name'],
                    'lastName' => $user['last_name'],
                    'username' => $user['username'],
                ];

                // ส่งข้อมูลผู้ใช้กลับไปยัง frontend
                echo json_encode([
                    "message" => "Login successful",
                    "user" => $_SESSION['user']
                ]);
            } else {
                echo json_encode(["message" => "Invalid credentials"]);
            }
        } else {
            echo json_encode(["message" => "Invalid credentials"]);
        }
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาดของฐานข้อมูล
        echo json_encode(["message" => "Database error", "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
