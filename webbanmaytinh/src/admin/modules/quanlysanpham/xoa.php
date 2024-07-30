<?php
include '../././db/connect.php';

if (isset($_GET['this_id'])) {
    $id = $_GET['this_id'];
    
    // Kiểm tra xem sản phẩm có trong đơn hàng không
    $sql_check_order = "SELECT * FROM donhang_chitiet WHERE maSanPham='$id'";
    $result_check_order = mysqli_query($conn, $sql_check_order);
    
    if (mysqli_num_rows($result_check_order) > 0) {
        // Sản phẩm đã có trong đơn hàng, không xóa
        echo 'Sản phẩm không thể xóa vì đã tồn tại trong đơn hàng.';
    } else {
        // Xóa sản phẩm
        $sql_delete = "DELETE FROM sanpham WHERE maSanPham='$id'";
        if (mysqli_query($conn, $sql_delete)) {
            header('Location: index.php?action=quanlysanpham&&query=no');
        } else {
            echo 'Có lỗi xảy ra trong quá trình xóa sản phẩm.';
        }
    }

    mysqli_close($conn);
} else {
    echo 'Xóa không thành công';
}
?>
