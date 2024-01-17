<?php
include '../././db/connect.php';
$total = 0;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$sql2 = "SELECT khuyenmai.maLKM as maLKM,khuyenmai.giaTriKhuyenMai as gtKM,maKhuyenMai,tenKhuyenMai,dondathang.maKM as mKMDDH  from khuyenmai join dondathang on dondathang.maKM=khuyenmai.maKhuyenMai where dondathang.maDonDatHang=$id";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
if ($row2['mKMDDH'] != NULL) {

    $maLKM = $row2['maLKM'];
    $gtKM = $row2['gtKM'];
    $tenKM = $row2['tenKhuyenMai'];
    $maKM = $row2['mKMDDH'];
}
$_SESSION['maKM'] = '';
?>
<div class="content-header">
    <h3 class="content-title">Chi Tiết Đơn Hàng</h3>
</div>
<table class="content-wrapper">
    <tr class="content-list head">
        <td class="content-item width200 head"> <b>Tên sản phẩm</b></td>
        <td class="content-item width150 head"> <b>giá</b></td>
        <td class="content-item width150 head"> <b>Số lượng</b></td>
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
            <td class="content-item width150"><?php echo number_format($row['giaSP'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
            <td class="content-item width150"><?php echo $row['soLuong'] ?></td>
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
    <?php if ($maKM != 'NULL') { ?>
        <tr class="content-list">
            <td class="content-item width200"> <?php echo ($tenKM != 'null' ? $tenKM : '')  ?></td>
            <td class="content-item width150"> <?php echo ($maKM != 'null' ? 'Mã: ' . $maKM : '')  ?></td>
            <td class="content-item width150"> Giảm: <?php echo ($maLKM == 'KM1' ? number_format($gtKM, $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' : $gtKM . '%')  ?></td>
            <td class="content-item width200"> <?php echo ($maLKM == 'KM1' ? '-' . number_format($gtKM, $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' : '-' . number_format($total * $gtKM / 100, $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ')  ?></td>
        </tr>
    <?php
    }
    ?>
</table>
<?php if ($_SESSION['maLKM'] == 'KM1') { ?>
    <b style=" float: right;width:294px">Tổng cộng : <?php echo number_format($total - $_SESSION['giaTriKhuyenMai'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></b>
<?php
} else if ($_SESSION['maLKM'] == 'KM2') { ?>
    <b style=" float: right;width:294px">Tổng cộng : <?php echo number_format($total - $total * ($_SESSION['giaTriKhuyenMai'] / 100), $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></b>
<?php
} else {
?>
    <b style=" float: right;width:294px">Tổng cộng : <?php echo number_format($total, $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></b>
<?php
}
?>
<b><?php echo $_SESSION['maKM'] ?></b>