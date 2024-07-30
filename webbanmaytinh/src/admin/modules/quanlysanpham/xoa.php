<?php
include '../././db/connect.php';

if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
} else {
    echo "<script>
        alert('ID sản phẩm không được xác định.');
        window.location.href = document.referrer;
    </script>";
    exit();
}

// Kiểm tra xem sản phẩm có trong đơn hàng không
$sql_check_order = "SELECT * FROM chitietdathang WHERE maSP='$this_id'";
$result_check_order = mysqli_query($conn, $sql_check_order);

if (!$result_check_order) {
    echo "<script>
        alert('Lỗi truy vấn kiểm tra đơn hàng: " . mysqli_error($conn) . "');
        window.location.href = document.referrer;
    </script>";
    exit();
}

if (mysqli_num_rows($result_check_order) > 0) {
    // Sản phẩm đã có trong đơn hàng, không xóa
    echo "<script>
        alert('Sản phẩm không thể xóa vì đã tồn tại trong đơn hàng.');
        window.location.href = document.referrer;
    </script>";
} else {
    // Xóa sản phẩm
    $sql_delete = "DELETE FROM sanpham WHERE maSanPham='$this_id'";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>
            alert('Xóa sản phẩm thành công!');
            window.location.href = './index.php?action=quanlysanpham&query=no';
        </script>";
    } else {
        echo "<script>
            alert('Có lỗi xảy ra trong quá trình xóa sản phẩm: " . mysqli_error($conn) . "');
            window.location.href = document.referrer;
        </script>";
    }
}

mysqli_close($conn);
?>
