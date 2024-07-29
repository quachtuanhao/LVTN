<?php
include '../db/connect.php';
if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
} else {
    die("Mã sản phẩm không được cung cấp.");
}

// Truy vấn lấy thông tin sản phẩm, nhà sản xuất và loại sản phẩm
$sql = "SELECT sp.tenSanPham, sp.gia, sp.soLuong, sp.hinhAnh, sp.moTa, nsx.tenNhaSanXuat, lsp.tenLoaiSanPham 
        FROM sanpham sp
        JOIN nhasanxuat nsx ON sp.maNSX = nsx.maNhaSanXuat
        JOIN loaisanpham lsp ON sp.maLSP = lsp.maLoaiSanPham
        WHERE sp.maSanPham='$this_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if (!$row) {
    die("Sản phẩm không tồn tại.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .content-product {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .content-product img {
            max-width: 100%;
            height: auto;
        }
        .product-info {
            text-align: center;
        }
        .product-info p {
            margin: 10px 0;
        }
        .comments-section {
            margin-top: 40px;
        }
        .comments-section h2 {
            text-align: center;
        }
        .display-comments {
            margin-top: 20px;
        }
        .display-comments p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="content-product">
        <div class="title">
            <p class="content-title">Chi Tiết Sản Phẩm</p>
        </div>
        <div class="product-info">
            <img src="../../assets/img/<?php echo htmlspecialchars($row['hinhAnh']); ?>" alt="Sản phẩm">
            <p><strong>Tên sản phẩm:</strong> <?php echo htmlspecialchars($row['tenSanPham']); ?></p>
            <p><strong>Giá:</strong> <?php echo number_format($row['gia'], 0, ',', '.'); ?> đ</p>
            <p><strong>Số lượng:</strong> <?php echo htmlspecialchars($row['soLuong']); ?></p>
            <p><strong>Mô tả:</strong><br><?php echo nl2br(htmlspecialchars($row['moTa'])); ?></p>
            <p><strong>Loại sản phẩm:</strong> <?php echo htmlspecialchars($row['tenLoaiSanPham']); ?></p>
            <p><strong>Nhà sản xuất:</strong> <?php echo htmlspecialchars($row['tenNhaSanXuat']); ?></p>
        </div>

        <!-- Hiển thị bình luận -->
        <div class="comments-section">
            <h2>Các Bình Luận</h2>
            <div class="display-comments">
                <?php
                $fetchComments = "SELECT c.rating, c.comment, t.hoTen 
                                  FROM comments c 
                                  JOIN taikhoan t ON c.user_name = t.userName 
                                  WHERE c.product_id = '$this_id'";
                $commentsResult = mysqli_query($conn, $fetchComments);

                if ($commentsResult && mysqli_num_rows($commentsResult) > 0) {
                    while ($commentRow = mysqli_fetch_array($commentsResult)) {
                        echo "<p><strong>Đánh giá:</strong> " . htmlspecialchars($commentRow['rating']) . " sao</p>";
                        echo "<p><strong>Bình luận:</strong> " . htmlspecialchars($commentRow['comment']) . "</p>";
                        echo "<p><strong>Người dùng:</strong> " . htmlspecialchars($commentRow['hoTen']) . "</p><hr>";
                    }
                } else {
                    echo "<p>Chưa có bình luận nào.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
