<?php
// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Database Configuration
$host = 'localhost';
$dbname = 'top_up_system';
$username = 'root'; // แก้ไขตาม Username ของคุณ
$password = '';     // แก้ไขตาม Password ของคุณ

try {
    // Connect to Database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get POST Data from Frontend
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate Input
    if (
        !isset($data['amount']) || empty(trim($data['amount'])) ||
        !isset($data['paymentMethod']) || empty(trim($data['paymentMethod'])) ||
        !isset($data['phoneNumber']) || empty(trim($data['phoneNumber']))
    ) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'กรุณากรอกข้อมูลให้ครบถ้วน']);
        exit;
    }

    // Sanitize Input
    $amount = filter_var($data['amount'], FILTER_VALIDATE_FLOAT);
    $paymentMethod = filter_var($data['paymentMethod'], FILTER_SANITIZE_STRING);
    $phoneNumber = filter_var($data['phoneNumber'], FILTER_SANITIZE_STRING);

    // Validate Amount
    if ($amount === false || $amount <= 0) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'จำนวนเงินไม่ถูกต้อง']);
        exit;
    }

    // Insert Data into Database
    $stmt = $pdo->prepare("INSERT INTO transactions (amount, payment_method, phone_number) VALUES (:amount, :payment_method, :phone_number)");
    $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
    $stmt->bindParam(':payment_method', $paymentMethod, PDO::PARAM_STR);
    $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'บันทึกข้อมูลสำเร็จ']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database Error: ' . $e->getMessage()]);
}
?>