<?php
include '../././db/connect.php';

if (isset($_GET['this_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['this_id']); // Chuẩn hóa đầu vào

    // Kiểm tra sản phẩm còn tồn tại không
    $sql_check = "SELECT * FROM sanpham WHERE maNSX=?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, 's', $id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) == 0) {
        // Xóa nhà sản xuất
        $sql_delete = "DELETE FROM nhasanxuat WHERE maNhaSanXuat=?";
        $stmt_delete = mysqli_prepare($conn, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, 's', $id);
        
        if (mysqli_stmt_execute($stmt_delete)) {
            echo "<script>
                alert('Xóa nhà sản xuất thành công!');
                window.location.href = 'index.php?action=quanlynhasanxuat&query=no';
            </script>";
            exit(); // Ngừng script sau khi điều hướng
        } else {
            echo "<script>
                alert('Có lỗi xảy ra khi xóa nhà sản xuất. Vui lòng thử lại.');
                window.location.href = document.referrer;
            </script>";
            exit();
        }
        mysqli_stmt_close($stmt_delete);
    } else {
        echo "<script>
            alert('Có sản phẩm tồn tại của nhà sản xuất này! Không thể xóa.');
            window.location.href = 'index.php?action=quanlynhasanxuat&query=no';
        </script>";
        exit();
    }
    mysqli_stmt_close($stmt_check);
    mysqli_close($conn);
} else {
    echo "<script>
        alert('Yêu cầu xóa không hợp lệ.');
        window.location.href = 'index.php?action=quanlynhasanxuat&query=no';
    </script>";
}
?>
