<?php 
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action']; // ตรวจสอบว่ากำลังทำอะไร (create, update, delete)

    if ($action === "create") {
        // เพิ่มสินค้าใหม่
        $name = $_POST['name'];
        $price = $_POST['price'];
        $details = $_POST['details']; // รับข้อมูลรายละเอียด
        $image = $_FILES['image'];

        if (!empty($image['name']) && $image['error'] === 0) {
            $target_dir = "uploads";
            $image_name = time() . "_" . basename($image["name"]);
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO products (name, price, details, image) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $price, $details, $target_file]);

                echo json_encode(["message" => "Product added successfully", "image" => $target_file]);
            } else {
                echo json_encode(["error" => "File upload failed"]);
            }
        } else {
            echo json_encode(["error" => "Image upload required"]);
        }
    } elseif ($action === "update") {
        // อัปเดตสินค้า
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $details = $_POST['details']; // รับข้อมูลรายละเอียด
        $image = $_FILES['image'];

        if (!empty($image['name']) && $image['error'] === 0) {
            // กรณีมีอัปโหลดรูปใหม่
            $target_dir = "uploads";
            $image_name = time() . "_" . basename($image["name"]);
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, details = ?, image = ? WHERE id = ?");
                $stmt->execute([$name, $price, $details, $target_file, $id]);
                echo json_encode(["message" => "Update successful", "image" => $target_file]);
            } else {
                echo json_encode(["error" => "File upload failed"]);
            }
        } else {
            // ไม่อัปโหลดภาพใหม่
            $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, details = ? WHERE id = ?");
            $stmt->execute([$name, $price, $details, $id]);
            echo json_encode(["message" => "Update successful without image change"]);
        }
    } elseif ($action === "delete") {
        // ลบสินค้า
        $id = $_POST['id'];

        // ดึงชื่อไฟล์ภาพก่อนลบ
        $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // ลบไฟล์ภาพถ้ามี
            if (!empty($product['image']) && file_exists($product['image'])) {
                unlink($product['image']);
            }

            // ลบข้อมูลสินค้าออกจากฐานข้อมูล
            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);

            echo json_encode(["message" => "Product deleted successfully"]);
        } else {
            echo json_encode(["error" => "Product not found"]);
        }
    } else {
        echo json_encode(["error" => "Invalid action"]);
    }
}
?>
