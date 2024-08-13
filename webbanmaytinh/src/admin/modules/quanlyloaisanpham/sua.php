<?php
include '../././db/connect.php';

// Kiểm tra xem có nhận được ID từ URL không
if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
}

// Xử lý khi người dùng gửi form
if (isset($_POST['submit'])) {
    $ten = $_POST['ten'];
    $errors = [];

    // Kiểm tra lỗi nhập liệu
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên loại sản phẩm không được bỏ trống';
    } else {
        // Kiểm tra xem tên loại sản phẩm có bị trùng không
        $sql_check = "SELECT tenLoaiSanPham FROM loaisanpham WHERE tenLoaiSanPham=? AND maLoaiSanPham != ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, 'ss', $ten, $this_id);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_bind_result($stmt_check, $existing_name);
        mysqli_stmt_fetch($stmt_check);
        if (!empty($existing_name)) {
            $errors['ten']['trung'] = 'Tên loại sản phẩm đã tồn tại';
        }
        mysqli_stmt_close($stmt_check);
    }

    // Nếu không có lỗi thì thực hiện cập nhật dữ liệu
    if (count($errors) == 0) {
        $sql = "UPDATE loaisanpham SET tenLoaiSanPham=? WHERE maLoaiSanPham=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $ten, $this_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('Cập nhật thông tin loại sản phẩm thành công!');
                window.location.href = './index.php?action=quanlyloaisanpham&&query=no';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Có lỗi xảy ra trong khi cập nhật loại sản phẩm. Vui lòng thử lại.');
                window.location.href = document.referrer;
            </script>";
            exit();
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<form class="form" action="./index.php?action=quanlyloaisanpham&&query=sua&&this_id=<?php echo htmlspecialchars($this_id); ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin loại sản phẩm</h1>
        </div>
        <div class="form-content">
            <?php
            // Lấy thông tin loại sản phẩm từ cơ sở dữ liệu
            $sql = "SELECT maLoaiSanPham as ma, tenLoaiSanPham as ten FROM loaisanpham WHERE maLoaiSanPham=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $this_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ma, $ten);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            ?>

            <label class="label">Mã loại sản phẩm</label>
            <input class="text" type="text" name="ma" value="<?php echo htmlspecialchars($ma); ?>" disabled>
            
            <label class="label">Tên loại sản phẩm</label>
            <input class="text" type="text" name="ten" value="<?php echo htmlspecialchars($ten); ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['trung']) . "</span>" : false ?>
            
            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>
    </div>
</form>
