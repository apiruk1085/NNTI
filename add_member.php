<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Member</title>
    <!-- เชื่อมโยง Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- เชื่อมโยง Font Awesome สำหรับไอคอน -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* สีพื้นหลัง */
        }
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }
        label {
            font-weight: bold;
            color: #555555;
        }
        .btn-submit {
            width: 100%;
            margin-top: 10px;
        }
        .btn-cancel {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2><i class="fas fa-user-plus"></i> เพิ่มสมาชิก</h2>
            <form method="POST" action="insert_member.php">
                <!-- ชื่อ -->
                <div class="mb-3">
                    <label for="fname" class="form-label">ชื่อ:</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="กรุณากรอกชื่อ" required>
                </div>
                <!-- นามสกุล -->
                <div class="mb-3">
                    <label for="lname" class="form-label">นามสกุล:</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="กรุณากรอกนามสกุล" required>
                </div>
                <!-- เบอร์โทรศัพท์ -->
                <div class="mb-3">
                    <label for="telephone" class="form-label">เบอร์โทรศัพท์:</label>
                    <input type="number" class="form-control" id="telephone" name="telephone" placeholder="กรุณากรอกเบอร์โทรศัพท์" required>
                </div>
                <!-- ปุ่ม Submit และ Cancel -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i> บันทึก</button>
                    <a href="Showmember.php" class="btn btn-danger btn-cancel"><i class="fas fa-times"></i> ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>

    <!-- เชื่อมโยง Bootstrap JS และ Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>