<?php
include 'condb.php'; // เชื่อมต่อฐานข้อมูล
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">รายการสินค้า</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภทสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รูปภาพ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT product.pro_id, product.pro_name, type.type_name, product.price, product.amount, product.image 
                        FROM product 
                        INNER JOIN type ON product.type_id = type.type_id 
                        ORDER BY product.pro_id ASC";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['pro_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['pro_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['type_name']) . "</td>";
                        echo "<td>" . htmlspecialchars(number_format($row['price'], 2)) . "</td>";
                        echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                        echo "<td>";
                        if (!empty($row['image'])) {
                            echo "<img src='image/" . htmlspecialchars($row['image']) . "' width='100' height='70' alt='Product Image'>";
                        } else {
                            echo "ไม่มีรูปภาพ";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลสินค้า</td></tr>";
                }

                // ปิดการเชื่อมต่อฐานข้อมูล
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>