<?php
$sql = "SELECT tenKhuyenMai as ten, ngayBatDau as nbd, ngayKetThuc as nkt, maLKM as mlkm, giaTriKhuyenMai as gtkm FROM khuyenmai ORDER BY ngayBatDau DESC";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    // Xử lý lỗi truy vấn SQL
    echo "Lỗi truy vấn: " . mysqli_error($conn);
} elseif ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result);
?>
    <div class="container">
        <div class="promotion" style="height:70px;margin: 0 10px;background-color:#ffd400;font-size:18px;font-weight:600">
            <div class="" style="padding:10px 0;display: flex;justify-content:center;font-size:20px">
                <div class="name"><?php echo $row['ten'] ?></div>
                <div class="title">&nbsp;giảm đến
                    <?php if ($row['mlkm'] == "KM1") {
                        echo number_format($row['gtkm'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ';
                    } else {
                        echo $row['gtkm'] . '%';
                    } ?>
                </div>
            </div>
            <div class="" style="padding:0 10px 10px;display: flex;justify-content:center;align-items: center;">
                <div class="date" style="display: flex;justify-content: center; align-items: center;">
                    <div class="start">Từ ngày <?php echo date("d/m/Y", strtotime($row['nbd'])) ?> </div>
                    <div class="end">&nbsp;đến hết ngày <?php echo date("d/m/Y", strtotime($row['nkt'])) ?></div>
                </div>
                <div class="link" style="margin-left: 20px;"><a href="./index.php?action=khuyenmai" class="">Xem Ngay</a></div>
            </div>
        </div>
    </div>
<?php
} else {
    echo "Không có khuyến mãi nào để hiển thị.";
}
?>
