<?php
include '../././db/connect.php';

if (isset($_GET['this_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['this_id']); // Chuẩn hóa đầu vào

    // Kiểm tra sản phẩm còn tồn tại không
    $sql = "SELECT * FROM sanpham WHERE maNSX='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // Xóa nhà sản xuất
        $sql1 = "DELETE FROM nhasanxuat WHERE maNhaSanXuat='$id'";
        if (mysqli_query($conn, $sql1)) {
            header('Location: index.php?action=quanlynhasanxuat&query=no');
            exit(); // Ngừng script sau khi điều hướng
        } else {
            echo "Lỗi khi xóa nhà sản xuất: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
            alert('Có sản phẩm tồn tại! Không thể xóa');
            window.location = 'index.php?action=quanlynhasanxuat&query=no';
        </script>";
    }

    mysqli_close($conn);
} else {
    echo 'Xóa không thành công';
}
?>
