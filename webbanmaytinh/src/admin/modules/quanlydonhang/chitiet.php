<?php
include '../././db/connect.php';
$total = 0;

// Khởi tạo biến với giá trị mặc định
$maLKM = '';
$gtKM = 0; // Khởi tạo với giá trị số
$tenKM = '';
$maKM = '';

// Kiểm tra nếu ID được cung cấp
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Lấy thông tin khuyến mãi
    $sql2 = "SELECT khuyenmai.maLKM as maLKM, khuyenmai.giaTriKhuyenMai as gtKM, maKhuyenMai, tenKhuyenMai, dondathang.maKM as mKMDDH 
             FROM khuyenmai 
             JOIN dondathang ON dondathang.maKM = khuyenmai.maKhuyenMai 
             WHERE dondathang.maDonDatHang = $id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    if ($row2) {
        $maLKM = $row2['maLKM'];
        $gtKM = $row2['gtKM'];
        $tenKM = $row2['tenKhuyenMai'];
        $maKM = $row2['mKMDDH'];
    }
    $_SESSION['maKM'] = '';
}
?>
<div class="content-header">
    <h3 class="content-title">Chi Tiết Đơn Hàng</h3>
</div>
<table class="content-wrapper">
    <tr class="content-list head">
        <td class="content-item width200 head"><b>Mã sản phẩm</b></td>
        <td class="content-item width200 head"><b>Tên sản phẩm</b></td>
        <td class="content-item width150 head"><b>Giá</b></td>
        <td class="content-item width150 head"><b>Số lượng</b></td>
        <td class="content-item width200 head"><b>Tổng tiền</b></td>
    </tr>
    <?php
    $sql = "SELECT * FROM chitietdathang WHERE maDDH = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $total += $row["tongTien"];
        $maSP = $row['maSP'];
        // Lấy mã sản phẩm
        $sql1 = "SELECT * FROM sanpham WHERE maSanPham = '$maSP'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $maSanPham = $row1['maSanPham'];
    ?>
        <tr class="content-list">
            <td class="content-item width200"><?php echo htmlspecialchars($maSanPham) ?></td>
            <td class="content-item width200"><?php echo htmlspecialchars($row['tenSP']) ?></td>
            <td class="content-item width150"><?php echo number_format($row['giaSP'], 0, ',', '.') . 'đ' ?></td>
            <td class="content-item width150"><?php echo htmlspecialchars($row['soLuong']) ?></td>
            <td class="content-item width200"><?php echo number_format($row['tongTien'], 0, ',', '.') . 'đ' ?></td>
        </tr>
    <?php
    }

    // Lấy thông tin mã khuyến mãi từ đơn hàng
    $sql1 = "SELECT maKM FROM dondathang WHERE maDonDatHang = $id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $maKM = $row1 ? $row1['maKM'] : '';

    if ($maKM) {
        $sql2 = "SELECT maLKM, giaTriKhuyenMai FROM khuyenmai WHERE maKhuyenMai LIKE '$maKM'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        
        $_SESSION['maLKM'] = $row2['maLKM'] ?? '';
        $_SESSION['giaTriKhuyenMai'] = $row2['giaTriKhuyenMai'] ?? 0;
    } else {
        $_SESSION['maLKM'] = '';
        $_SESSION['giaTriKhuyenMai'] = 0;
    }
    mysqli_close($conn);
    ?>
    <?php if (!empty($maKM) && $maKM !== 'NULL') { ?>
        <!-- Hiển thị tổng cộng tiền trước giảm giá -->
        <tr class="content-list">
            <td class="content-item width200" colspan="4"><b>Tổng cộng trước giảm giá:</b></td>
            <td class="content-item width200"><b><?php echo number_format($total, 0, ',', '.') . 'đ' ?></b></td>
        </tr>
        
        <!-- Hiển thị thông tin khuyến mãi và giảm giá -->
        <tr class="content-list">
            <td class="content-item width200"><?php echo htmlspecialchars($tenKM) ?></td>
            <td class="content-item width150"><?php echo ($maKM ? 'Mã: ' . htmlspecialchars($maKM) : '') ?></td>
            <td class="content-item width150">Giảm: <?php echo ($maLKM == 'KM1' ? number_format($gtKM, 0, ',', '.') . 'đ' : $gtKM . '%') ?></td>
            <td class="content-item width200">
                <?php 
                if ($maLKM == 'KM1') {
                    echo '-' . number_format($gtKM, 0, ',', '.') . 'đ';
                } else if ($maLKM == 'KM2') {
                    echo '-' . number_format($total * $gtKM / 100, 0, ',', '.') . 'đ';
                }
                ?>
            </td>
        </tr>
        
        <!-- Hiển thị tổng cộng sau giảm giá -->
        <?php if ($_SESSION['maLKM'] == 'KM1') { ?>
            <tr class="content-list">
                <td class="content-item width200" colspan="4"><b>Tổng cộng sau giảm giá:</b></td>
                <td class="content-item width200"><b><?php echo number_format($total - $_SESSION['giaTriKhuyenMai'], 0, ',', '.') . 'đ' ?></b></td>
            </tr>
        <?php } else if ($_SESSION['maLKM'] == 'KM2') { ?>
            <tr class="content-list">
                <td class="content-item width200" colspan="4"><b>Tổng cộng sau giảm giá:</b></td>
                <td class="content-item width200"><b><?php echo number_format($total - $total * ($_SESSION['giaTriKhuyenMai'] / 100), 0, ',', '.') . 'đ' ?></b></td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <!-- Hiển thị tổng cộng nếu không có mã giảm giá -->
        <tr class="content-list">
            <td class="content-item width200" colspan="4"><b>Tổng cộng:</b></td>
            <td class="content-item width200"><b><?php echo number_format($total, 0, ',', '.') . 'đ' ?></b></td>
        </tr>
    <?php } ?>
    <b><?php echo htmlspecialchars($_SESSION['maKM']) ?></b>
</table>
