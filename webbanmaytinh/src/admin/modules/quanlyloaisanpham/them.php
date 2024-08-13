<?php
include '../././db/connect.php';

$ma = "";
$ten = "";

if (isset($_POST['submit'])) {
    $ma = $_POST['ma'];
    $ten = $_POST['name'];
    $errors = [];

    // Kiểm tra mã loại sản phẩm
    if (empty($ma)) {
        $errors['ma']['required'] = 'Mã không được bỏ trống';
    } else {
        $sql1 = "SELECT maLoaiSanPham FROM loaisanpham WHERE maLoaiSanPham='$ma'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            $errors['ma']['trung'] = 'Mã đã tồn tại';
        }
    }

    // Kiểm tra tên loại sản phẩm
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên không được bỏ trống';
    } else {
        $sql2 = "SELECT tenLoaiSanPham FROM loaisanpham WHERE tenLoaiSanPham='$ten'";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            $errors['ten']['trung'] = 'Tên đã tồn tại';
        }
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO loaisanpham(maLoaiSanPham, tenLoaiSanPham) VALUES('$ma', '$ten')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Thêm loại sản phẩm thành công!');
                window.location.href = './index.php?action=quanlyloaisanpham&&query=no';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Có lỗi xảy ra trong khi thêm loại sản phẩm. Vui lòng thử lại.');
                window.location.href = document.referrer;
            </script>";
            exit();
        }
    }
}
?>

<form class="form" action="./index.php?action=quanlyloaisanpham&query=them" method="POST">
    <div class="form-main">
        <div class="form-title">
            <h1>Thêm Loại Sản Phẩm</h1>
        </div>
        <div class="form-content">
            <label class="label">Mã loại sản phẩm</label>
            <input class="text" type="text" name="ma" value="<?php echo htmlspecialchars($ma); ?>">
            <?php echo (!empty($errors['ma']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['required']) . "</span>" : false; ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['trung']) . "</span>" : false; ?>
            
            <label class="label">Tên loại sản phẩm</label>
            <input class="text" type="text" name="name" value="<?php echo htmlspecialchars($ten); ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['required']) . "</span>" : false; ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['trung']) . "</span>" : false; ?>
            
            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>
