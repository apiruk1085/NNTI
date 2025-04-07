<?php
include 'condb.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง ID มาผ่าน URL หรือไม่
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); // ป้องกัน SQL Injection

    // คำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM member WHERE id = '$id'";

    // ดำเนินการ Query และตรวจสอบผลลัพธ์
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='Showmember.php';</script>"; // Redirect กลับไปยังหน้าแสดงข้อมูล
    } else {
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
        echo "<script>window.location='Showmember.php';</script>";
    }
} else {
    echo "<script>alert('ไม่พบ ID ของสมาชิก');</script>";
    echo "<script>window.location='Showmember.php';</script>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>