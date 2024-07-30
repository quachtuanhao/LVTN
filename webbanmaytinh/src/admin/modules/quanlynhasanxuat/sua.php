<?php
include '../././db/connect.php';

// Kiểm tra xem có nhận được ID từ URL không
if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
}

// Xử lý khi người dùng gửi form
if (isset($_POST['submit'])) {
    $id = $_GET['this_id']; // Lấy ID từ URL
    $ten = $_POST['ten'];
    $moTa = $_POST['mota'];
    $errors = [];

    // Kiểm tra lỗi nhập liệu
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên nhà sản xuất không được bỏ trống';
    }

    // Nếu không có lỗi thì thực hiện cập nhật dữ liệu
    if (count($errors) == 0) {
        // Câu lệnh cập nhật dữ liệu
        $sql = "UPDATE nhasanxuat SET tenNhaSanXuat=?, truSoChinh=? WHERE maNhaSanXuat=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $ten, $moTa, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        // Chuyển hướng về trang quản lý nhà sản xuất
        header('location: ./index.php?action=quanlynhasanxuat&&query=no');
        exit();
    }
}
?>

<form class="form" action="./index.php?action=quanlynhasanxuat&&query=sua&&this_id=<?php echo htmlspecialchars($this_id); ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin nhà sản xuất</h1>
        </div>
        <div class="form-content">
            <?php
            // Lấy thông tin nhà sản xuất từ cơ sở dữ liệu
            $sql = "SELECT maNhaSanXuat AS ma, tenNhaSanXuat AS ten, truSoChinh FROM nhasanxuat WHERE maNhaSanXuat=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $this_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ma, $ten, $truSoChinh);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            ?>
            
            <label class="label">Mã nhà sản xuất</label>
            <input class="text" type="text" name="ma" value="<?php echo htmlspecialchars($ma); ?>" disabled>
            
            <label class="label">Tên nhà sản xuất</label>
            <input class="text" type="text" name="ten" value="<?php echo htmlspecialchars($ten); ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['required']) . "</span>" : false ?>
            
            <label class="label">Địa chỉ</label>
            <input class="text" type="text" name="mota" value="<?php echo htmlspecialchars($truSoChinh); ?>">
            
            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>
    </div>
</form>
