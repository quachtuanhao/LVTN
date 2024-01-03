<?php
include '../db/connect.php';

$total = 0;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$sql2 = "SELECT khuyenmai.maLKM as maLKM,khuyenmai.giaTriKhuyenMai as gtKM  from khuyenmai join dondathang on dondathang.maKM=khuyenmai.maKhuyenMai where dondathang.maDonDatHang=$id";
$result2 = mysqli_query($conn, $sql2);
while ($row2 = mysqli_fetch_array($result2)) {
    $maLKM = $row2['maLKM'];
    $gtKM = $row2['gtKM'];
}
?>
<div class="content-header">
    <h3 class="content-title">Chi Tiết Đơn Hàng</h3>
</div>
<table class="cart">
    <tr class="cart-list">
        <td class="cart-item width100"> <b>Sản phẩm</b></td>
        <td class="cart-item width200"> <b>Tên sản phẩm</b></td>
        <td class="cart-item width100"> <b>Đơn giá</b></td>
        <td class="cart-item width100"> <b>Số lượng</b></td>
        <td class="cart-item width200"> <b>Số tiền</b></td>

    </tr>
    <?php
    $sql = "SELECT * from chitietdathang where maDDH = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $total = $total + $row["tongTien"];
        $maSP = $row['maSP'];
    ?>
        <tr class="cart-list">
            <td class="cart-item width100">
                <img src="../../assets/img/<?php $sql1 = "SELECT * from sanpham where maSanPham = '$maSP'";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row1 = mysqli_fetch_array($result1);
                                            echo $row1['hinhAnh'] ?>" alt="">
            </td>
            <td class="cart-item width200"><?php echo $row['tenSP'] ?></td>
            <td class="cart-item width100"><?php echo number_format($row['giaSP'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
            <td class="cart-item width100"><?php echo $row['soLuong'] ?></td>
            <td class="cart-item width200"><?php echo number_format($row['tongTien'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
        </tr>
    <?php
    }
    mysqli_close($conn);
    ?>
</table>
<?php

?>
<p>Tổng cộng : <?php
                if ($maLKM == "KM1") {
                    $total -= $gtKM;
                } else if ($maLKM == "KM2") {
                    $total -= $total * $gtKM / 100;
                }
                echo number_format($total, $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ';
                ?>
</p>