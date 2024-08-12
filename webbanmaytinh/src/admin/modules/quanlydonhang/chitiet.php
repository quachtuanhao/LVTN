<?php
include '../db/connect.php';

$total = 0;
$total_before_discount = 0; // Thêm biến lưu tổng cộng trước khi giảm giá

// Khởi tạo biến với giá trị mặc định
$maLKM = '';
$gtKM = 0; // Khởi tạo với giá trị số
$tenKM = '';
$maKM = '';

// Kiểm tra nếu ID được cung cấp
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Lấy thông tin khuyến mãi
    $sql2 = "SELECT khuyenmai.maLKM as maLKM, khuyenmai.giaTriKhuyenMai as gtKM, maKhuyenMai, tenKhuyenMai 
             FROM khuyenmai 
             JOIN dondathang ON dondathang.maKM = khuyenmai.maKhuyenMai 
             WHERE dondathang.maDonDatHang = $id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    if ($row2) {
        $maLKM = $row2['maLKM'];
        $gtKM = $row2['gtKM'];
        $tenKM = $row2['tenKhuyenMai'];
        $maKM = $row2['maKhuyenMai'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
        .cart {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-list {
            border-bottom: 1px solid #ddd;
        }
        .cart-item {
            padding: 8px;
            text-align: left;
        }
        .width100 { width: 100px; }
        .width200 { width: 200px; }
        .width150 { width: 150px; }
        .total-row {
            background-color: #f9f9f9; /* Màu nền để phân biệt */
        }
        .total-before-discount, .total-after-discount {
            padding-left: 8px; /* Giữ khoảng cách nhỏ hơn */
        }
        .total-label {
            padding-left: 2px; /* Đưa gần lại số tiền */
        }
        .btn-comment {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-comment:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="content-header">
    <h3 class="content-title">Chi Tiết Đơn Hàng</h3>
</div>
<table class="cart">
    <tr class="cart-list">
        <td class="cart-item width100"> <b>Mã sản phẩm</b></td>
        <td class="cart-item width100"> <b>Hình ảnh</b></td>
        <td class="cart-item width200"> <b>Tên sản phẩm</b></td>
        <td class="cart-item width100"> <b>Đơn giá</b></td>
        <td class="cart-item width150"> <b>Số lượng</b></td>
        <td class="cart-item width150"> <b>Số tiền</b></td>
    </tr>
    <?php
    $sql = "SELECT * FROM chitietdathang WHERE maDDH = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $total_before_discount += $row["tongTien"]; // Cộng tổng cộng trước khi giảm giá
        $total += $row["tongTien"];
        $maSP = $row['maSP'];
        
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql1 = "SELECT * FROM sanpham WHERE maSanPham = '$maSP'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
    ?>
        <tr class="cart-list">
            <td class="cart-item width100"><?php echo htmlspecialchars($row1['maSanPham']); ?></td>
            <td class="cart-item width100">
                <img src="../../assets/img/<?php echo htmlspecialchars($row1['hinhAnh']); ?>" alt="Hình ảnh sản phẩm" style="max-width: 100px; max-height: 100px;">
            </td>
            <td class="cart-item width200"><?php echo htmlspecialchars($row['tenSP']); ?></td>
            <td class="cart-item width100"><?php echo number_format($row['giaSP'], 0, ',', '.'); ?>đ</td>
            <td class="cart-item width150"><?php echo htmlspecialchars($row['soLuong']); ?></td>
            <td class="cart-item width150"><?php echo number_format($row['tongTien'], 0, ',', '.'); ?>đ</td>
        </tr>
    <?php
    }
    ?>
    <!-- Hiển thị tổng cộng trước giảm giá -->
    <tr class="cart-list total-row">
        <td colspan="5" class="cart-item total-label"><b>Tổng cộng trước giảm giá:</b></td>
        <td class="cart-item total-before-discount"><b><?php echo number_format($total_before_discount, 0, ',', '.'); ?>đ</b></td>
    </tr>
    <?php if (!empty($maKM) && $maKM !== 'null') { ?>
        <!-- Hiển thị thông tin khuyến mãi và giảm giá -->
        <tr class="cart-list">
            <td class="cart-item width100"><?php echo htmlspecialchars($tenKM); ?></td>
            <td class="cart-item width100"><?php echo ($maKM ? 'Mã: ' . htmlspecialchars($maKM) : ''); ?></td>
            <td class="cart-item width100">Giảm: <?php echo ($maLKM == 'KM1' ? number_format($gtKM, 0, ',', '.') . 'đ' : $gtKM . '%'); ?></td>
            <td class="cart-item width200">
                <?php 
                if ($maLKM == 'KM1') {
                    echo '-' . number_format($gtKM, 0, ',', '.') . 'đ';
                } else if ($maLKM == 'KM2') {
                    echo '-' . number_format($total_before_discount * $gtKM / 100, 0, ',', '.') . 'đ';
                }
                ?>
            </td>
        </tr>
        
        <!-- Hiển thị tổng cộng sau giảm giá -->
        <tr class="cart-list total-row">
            <td colspan="5" class="cart-item total-label"><b>Tổng cộng sau giảm giá:</b></td>
            <td class="cart-item total-after-discount"><b><?php
                if ($maLKM == "KM1") {
                    $total -= $gtKM;
                } else if ($maLKM == "KM2") {
                    $total -= $total_before_discount * $gtKM / 100;
                }
                echo number_format($total, 0, ',', '.'); ?>đ
            </b></td>
        </tr>
    <?php } else { ?>
        <!-- Hiển thị tổng cộng nếu không có mã giảm giá -->
        <tr class="cart-list">
            <td colspan="5" class="cart-item total-label"><b>Tổng cộng:</b></td>
            <td class="cart-item total-before-discount"><b><?php echo number_format($total_before_discount, 0, ',', '.'); ?>đ</b></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
