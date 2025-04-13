<?php
include 'condb.php';

// เพิ่มข้อมูล
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $telephone = $_POST['telephone'];

    $sql = "INSERT INTO member (name, surname, telephone) VALUES ('$name', '$surname', '$telephone')";
    if (mysqli_query($conn, $sql)) {
        //echo "Record added successfully!";
    } else {
        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// แก้ไขข้อมูล
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $telephone = $_POST['telephone'];

    $sql = "UPDATE member SET name='$name', surname='$surname', telephone='$telephone' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// ลบข้อมูล
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM member WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        //echo "Record deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM member";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูล</title>
    <!-- ใช้ Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>เพิ่มข้อมูล</h2>
    
    <!-- ฟอร์มเพิ่มข้อมูล -->
    <form method="post" class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">เบอร์โทศัพท์</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <button type="submit" class="btn btn-primary" name="add">เพิ่มสมาชิก</button>
    </form>

    <!-- ตารางแสดงข้อมูล -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Telephone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['surname'] ?></td>
                <td><?= $row['telephone'] ?></td>
                <td>
                    <!-- ลิงก์แก้ไข -->
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <!-- ลิงก์ลบ -->
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap 5 JS และ Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php mysqli_close($conn); ?>
