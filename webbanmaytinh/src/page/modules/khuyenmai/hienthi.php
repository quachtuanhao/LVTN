<?php
include '../db/connect.php';
?>
<div class="tiltle">
    <p class="content-title">Khuyến mãi</p>
</div>
<table class="cart">
    <tr class="cart-list">
        <td class="cart-item width150"><b>Mã khuyến mãi</b> </td>
        <td class="cart-item width150"><b>Tên khuyến mãi</b></td>
        <td class="cart-item width100"><b>Ngày bắt đầu</b></td>
        <td class="cart-item width100"><b>Ngày kết thúc</b></td>
        <td class="cart-item width150"><b>Giá trị khuyến mãi</b></td>
    </tr>
    <?php
    $sql = "SELECT maKhuyenMai,tenKhuyenMai,ngayBatDau,ngayKetThuc,giaTriKhuyenMai,maLKM
        from khuyenmai where DATEDIFF(ngayKetThuc,CURDATE()) >= 0 ORDER BY ngayBatDau DESC";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr class="cart-list">
            <td class="cart-item width150"><?php echo $row['maKhuyenMai'] ?></td>
            <td class="cart-item width150"><?php echo $row['tenKhuyenMai'] ?></td>
            <td class="cart-item width100"><?php echo date("d/m/Y", strtotime($row['ngayBatDau'])) ?></td>
            <td class="cart-item width100"><?php echo date("d/m/Y", strtotime($row['ngayKetThuc'])) ?></td>
            <td class="cart-item width150">
                <?php if ($row['maLKM'] == "KM1") {
                    echo number_format($row['giaTriKhuyenMai'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ';
                } else {
                    echo $row['giaTriKhuyenMai'] . '%';
                }
                ?>
            </td>
        </tr>

    <?php
    }
    mysqli_close($conn);
    ?>
</table>