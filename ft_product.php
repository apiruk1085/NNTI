<?php
include 'condb.php'; // เชื่อมต่อฐานข้อมูล
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
            font-size: 24px;
            font-weight: bold;
        }
        label {
            font-weight: 600;
            color: #495057;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            background: #0d6efd;
            border: none;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #0b5ed7;
        }
        .btn-secondary {
            width: 100%;
            margin-top: 10px;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            background: #6c757d;
            border: none;
            transition: background 0.3s ease;
        }
        .btn-secondary:hover {
            background: #5a6268;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2><i class="fas fa-box-open me-2"></i> เพิ่มสินค้าใหม่</h2>
                <form name="form1" method="POST" action="insert_product.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pname" class="form-label">ชื่อสินค้า:</label>
                        <input type="text" id="pname" name="pname" class="form-control" placeholder="กรอกชื่อสินค้า" required>
                    </div>
                    <div class="mb-3">
                        <label for="typeid" class="form-label">ประเภทสินค้า:</label>
                        <select id="typeid" class="form-select" name="typeid" required>
                            <?php
                            $sql = "SELECT * FROM type ORDER BY type_name";
                            $hand = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($hand)) {
                                echo '<option value="' . $row['type_id'] . '">' . $row['type_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">ราคา:</label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="กรอกราคาสินค้า" required>
                    </div>
                    <div class="mb-3">
                        <label for="num" class="form-label">จำนวน:</label>
                        <input type="number" id="num" name="num" class="form-control" placeholder="กรอกจำนวนสินค้า" required>
                    </div>
                    <div class="mb-3">
                        <label for="file1" class="form-label">รูปภาพ:</label>
                        <input type="file" id="file1" name="file1" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> บันทึกข้อมูล</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-undo me-2"></i> ยกเลิก</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>