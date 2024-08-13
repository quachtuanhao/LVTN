<?php
include '../././db/connect.php';

if (isset($_GET['this_id'])) {
    $id = $_GET['this_id'];

    // Kiểm tra xem mã khuyến mãi đã được sử dụng trong đơn hàng chưa
    $sql = "SELECT * FROM dondathang WHERE maKM='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Mã khuyến mãi đã được sử dụng, không thể xóa
        echo "<script>
                alert('Mã khuyến mãi này đang được sử dụng trong đơn hàng! Không thể xóa.');
                window.location = 'index.php?action=quanlykhuyenmai&&query=no';
              </script>";
    } else {
        // Mã khuyến mãi chưa được sử dụng, cho phép xóa
        $sql1 = "DELETE FROM khuyenmai WHERE maKhuyenMai='$id'";
        $result1 = mysqli_query($conn, $sql1);

        if ($result1) {
            echo "<script>
                    alert('Xóa mã khuyến mãi thành công!');
                    window.location = 'index.php?action=quanlykhuyenmai&&query=no';
                  </script>";
        } else {
            echo "<script>
                    alert('Xóa khuyến mãi thất bại. Vui lòng thử lại.');
                    window.location = 'index.php?action=quanlykhuyenmai&&query=no';
                  </script>";
        }
    }

    mysqli_close($conn);
} else {
    echo "<script>
            alert('Xóa không thành công');
            window.location = 'index.php?action=quanlykhuyenmai&&query=no';
          </script>";
}
?>
