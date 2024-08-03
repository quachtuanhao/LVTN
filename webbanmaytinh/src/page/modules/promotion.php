<?php
// Mảng chứa các câu slogan
$slogans = [
    "Cơ hội mua sắm tuyệt vời!",
    "Giảm giá cực sốc!",
    "Ưu đãi không thể bỏ lỡ!",
    "Mua sắm ngay, nhận ưu đãi lớn!",
    "Khuyến mãi siêu hot đang chờ bạn!"
];

// Lấy ngẫu nhiên một câu slogan
$slogan = $slogans[array_rand($slogans)];

$sql = "SELECT tenKhuyenMai as ten, giaTriKhuyenMai as gtkm, maLKM as mlkm FROM khuyenmai ORDER BY ngayBatDau DESC";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    // Xử lý lỗi truy vấn SQL
    echo "Lỗi truy vấn: " . mysqli_error($conn);
} elseif ($result->num_rows > 0) {
?>
    <div class="container">
        <div class="promotion" style="height:100px;margin: 10px;background-color:#ffd400;color:#000000;font-size:24px;font-weight:700;display:flex;align-items:center;justify-content:center;">
            <?php echo $slogan; ?>
        </div>
        <div style="text-align: center; margin-top: 10px;">
            <a href="./index.php?action=khuyenmai" class="btn btn-primary" style="background-color: #ff0000; color: #ffffff; padding: 10px 20px; font-size: 18px; font-weight: bold; text-decoration: none;">Xem Ngay</a>
        </div>
    </div>
<?php
} else {
    echo "Không có khuyến mãi nào để hiển thị.";
}
?>
