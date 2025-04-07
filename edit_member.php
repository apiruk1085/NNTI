<?php
include 'condb.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง ID มาผ่าน URL หรือไม่
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); // ป้องกัน SQL Injection

    // ดึงข้อมูลสมาชิกที่ต้องการแก้ไข
    $sql = "SELECT * FROM member WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('ไม่พบข้อมูลสมาชิก');</script>";
        echo "<script>window.location='Showmember.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ไม่พบ ID ของสมาชิก');</script>";
    echo "<script>window.location='Showmember.php';</script>";
    exit;
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $f_name = mysqli_real_escape_string($conn, $_POST['fname']);
    $l_name = mysqli_real_escape_string($conn, $_POST['lname']);
    $tel = mysqli_real_escape_string($conn, $_POST['telephone']);

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql_update = "UPDATE member SET name='$f_name', surname='$l_name', telephone='$tel' WHERE id='$id'";

    // ดำเนินการ Query และตรวจสอบผลลัพธ์
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('อัปเดตข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='Showmember.php';</script>"; // Redirect กลับไปยังหน้าแสดงข้อมูล
    } else {
        echo "<script>alert('ไม่สามารถอัปเดตข้อมูลได้');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <!-- เชื่อมโยง Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- เชื่อมโยง Font Awesome สำหรับไอคอน -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">แก้ไขข้อมูลสมาชิก</h2>
        <form method="POST" action="">
            <!-- ชื่อ -->
            <div class="mb-3">
                <label for="fname" class="form-label">ชื่อ:</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?= htmlspecialchars($row['name']) ?>" required>
            </div>
            <!-- นามสกุล -->
            <div class="mb-3">
                <label for="lname" class="form-label">นามสกุล:</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?= htmlspecialchars($row['surname']) ?>" required>
            </div>
            <!-- เบอร์โทรศัพท์ -->
            <div class="mb-3">
                <label for="telephone" class="form-label">เบอร์โทรศัพท์:</label>
                <input type="number" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($row['telephone']) ?>" required>
            </div>
            <!-- ปุ่ม Submit และ Cancel -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึก</button>
                <a href="Showmember.php" class="btn btn-danger"><i class="fas fa-times"></i> ยกเลิก</a>
            </div>
        </form>
    </div>

    <!-- เชื่อมโยง Bootstrap JS และ Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>