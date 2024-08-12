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
        <td class="cart-item width100"><b>Thao tác</b></td> <!-- Thêm cột mới -->
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
            <td class="cart-item width100">
                <button onclick="copyToClipboard('<?php echo $row['maKhuyenMai'] ?>')">Copy</button>
            </td>
        </tr>
    <?php
    }
    mysqli_close($conn);
    ?>
</table>

<script>
function copyToClipboard(text) {
    // Tạo một phần tử input ẩn để chứa mã khuyến mãi
    var input = document.createElement('input');
    input.setAttribute('value', text);
    document.body.appendChild(input);
    input.select();
    
    try {
        // Sao chép nội dung của input vào clipboard
        document.execCommand('copy');
        alert('Mã khuyến mãi đã được sao chép: ' + text);
    } catch (err) {
        alert('Lỗi sao chép mã khuyến mãi!');
    }
    
    // Xóa phần tử input sau khi sao chép
    document.body.removeChild(input);
}
</script>
