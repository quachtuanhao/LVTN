<?php
include '../././db/connect.php';
$total = 0;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$_SESSION['maKM'] = '';
?>
<div class="content-header">
    <h3 class="content-title">Chi Tiết Đơn Hàng</h3>
</div>
<table class="content-wrapper">
    <tr class="content-list head">
        <td class="content-item width200 head"> <b>Tên sản phẩm</b></td>
        <td class="content-item width100 head"> <b>giá</b></td>
        <td class="content-item width100 head"> <b>Số lượng</b></td>
        <td class="content-item width200 head"> <b>Tổng tiền</b></td>

    </tr>
    <?php
    $sql = "SELECT * from chitietdathang where maDDH = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $total = $total + $row["tongTien"];
    ?>
        <tr class="content-list">
            <td class="content-item width200"><?php echo $row['tenSP'] ?></td>
            <td class="content-item width100"><?php echo number_format($row['giaSP'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
            <td class="content-item width100"><?php echo $row['soLuong'] ?></td>
            <td class="content-item width200"><?php echo number_format($row['tongTien'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
        </tr>
    <?php
    }
    $sql1 = "SELECT maKM from dondathang where maDonDatHang = $id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $maKM = $row1['maKM'];
    $sql2 = "SELECT maLKM,giaTriKhuyenMai from khuyenmai where maKhuyenMai like '$maKM'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    $_SESSION['maLKM'] = $row2['maLKM'];
    $_SESSION['giaTriKhuyenMai'] = $row2['giaTriKhuyenMai'];
    mysqli_close($conn);
    ?>
</table>
<?php if ($_SESSION['maLKM'] == 'KM1') { ?>
    <b>Tổng cộng : <?php echo number_format($total - $_SESSION['giaTriKhuyenMai'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></b>
<?php
} else if ($_SESSION['maLKM'] == 'KM2') { ?>
    <b>Tổng cộng : <?php echo number_format($total - $total * ($_SESSION['giaTriKhuyenMai'] / 100), $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></b>
<?php
} else {
?>
    <b>Tổng cộng : <?php echo number_format($total, $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></b>
<?php
}
?>
<b><?php echo $_SESSION['maKM'] ?></b>