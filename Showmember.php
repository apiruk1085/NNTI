<?php
include 'condb.php'; // เชื่อมต่อฐานข้อมูล
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member List</title>
    <!-- เชื่อมโยง Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- เชื่อมโยง Font Awesome สำหรับไอคอน -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* สีพื้นหลัง */
        }
        .table thead th {
            background-color: #0d6efd;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-edit {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-edit:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">แสดงข้อมูลสมาชิก</h2>
        <div class="d-flex justify-content-end mb-4">
            <a href="add_member.php" class="btn btn-success"><i class="fas fa-plus"></i> เพิ่มสมาชิก</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>รหัสสมาชิก</th>
                    <th>ชื่อสมาชิก</th>
                    <th>นามสกุล</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>วันที่</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM member";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) { 
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]) ?></td>
                            <td><?= htmlspecialchars($row["name"]) ?></td>
                            <td><?= htmlspecialchars($row["surname"]) ?></td>
                            <td><?= htmlspecialchars($row["telephone"]) ?></td>
                            <td><?= htmlspecialchars($row["time"]) ?></td>
                            <td>
                                <a href="edit_member.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm btn-edit">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                            </td>
                            <td>
                                <a href="delete_member.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?')">
                                    <i class="fas fa-trash-alt"></i> ลบ
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>ไม่มีข้อมูลสมาชิก</td></tr>";
                }
                mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล
                ?>
            </tbody>
        </table>
    </div>

    <!-- เชื่อมโยง Bootstrap JS และ Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>