<?php
include 'condb.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $f_name = mysqli_real_escape_string($conn, $_POST['fname']);
    $l_name = mysqli_real_escape_string($conn, $_POST['lname']);
    $tel = mysqli_real_escape_string($conn, $_POST['telephone']);

    // คำสั่ง SQL สำหรับเพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO member (name, surname, telephone) VALUES ('$f_name', '$l_name', '$tel')";
    
    // ดำเนินการ Query และตรวจสอบผลลัพธ์
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='Showmember.php';</script>"; // แก้ไข URL เป็น 'Showmember.php'
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
    }
} else {
    echo "<script>alert('ไม่พบข้อมูลที่ส่งมา');</script>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>