<?php
include 'condb.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $pname = mysqli_real_escape_string($conn, $_POST['pname'] ?? ''); // ชื่อสินค้า
    $typeid = mysqli_real_escape_string($conn, $_POST['typeid'] ?? ''); // ประเภทสินค้า
    $price = mysqli_real_escape_string($conn, $_POST['price'] ?? ''); // ราคา
    $num = mysqli_real_escape_string($conn, $_POST['num'] ?? ''); // จำนวน

    // ตรวจสอบว่ามีไฟล์ที่อัปโหลดหรือไม่
    if (isset($_FILES['file1']) && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "./image/"; // โฟลเดอร์สำหรับเก็บไฟล์
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
        }

        // สร้างชื่อไฟล์ใหม่เพื่อป้องกันการซ้ำซ้อน
        $new_image_name = 'pr_' . uniqid() . "." . pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
        $image_upload_path = $target_dir . $new_image_name;

        // อัปโหลดไฟล์
        if (move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path)) {
            $new_image_name = $new_image_name; // เก็บชื่อไฟล์ใหม่
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์');</script>";
            exit;
        }
    } else {
        $new_image_name = ""; // หากไม่มีไฟล์ กำหนดค่าว่าง
    }

    // บันทึกข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO product (pro_name, type_id, price, amount, image)
            VALUES ('$pname', '$typeid', '$price', '$num', '$new_image_name')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script>window.location.href='ft_product.php';</script>"; // กลับไปหน้ารายการสินค้า
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้: " . mysqli_error($conn) . "');</script>";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
}
?>