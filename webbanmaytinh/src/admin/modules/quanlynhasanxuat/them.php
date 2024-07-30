<?php
include '../././db/connect.php';

$ma = "";
$ten = "";
$mota = "";

if (isset($_POST['submit'])) {
    $ma = $_POST['ma'];
    $ten = $_POST['name'];
    $mota = $_POST['mota'];
    $errors = [];

    // Kiểm tra mã nhà sản xuất
    if (empty($ma)) {
        $errors['ma']['required'] = 'Mã không được bỏ trống';
    } else {
        $sql1 = "SELECT maNhaSanXuat FROM nhasanxuat WHERE maNhaSanXuat='$ma'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            $errors['ma']['trung'] = 'Mã đã tồn tại';
        }
    }

    // Kiểm tra tên nhà sản xuất
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên không được bỏ trống';
    } else {
        $sql2 = "SELECT tenNhaSanXuat FROM nhasanxuat WHERE tenNhaSanXuat='$ten'";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            $errors['ten']['trung'] = 'Tên nhà sản xuất đã tồn tại';
        }
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO nhasanxuat(maNhaSanXuat, tenNhaSanXuat, truSoChinh) VALUES('$ma', '$ten', '$mota')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Thêm nhà sản xuất thành công!');
                window.location.href = './index.php?action=quanlynhasanxuat&&query=no';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Có lỗi xảy ra trong khi thêm nhà sản xuất. Vui lòng thử lại.');
                window.location.href = document.referrer;
            </script>";
            exit();
        }
    }
}
?>

<form class="form" action="./index.php?action=quanlynhasanxuat&&query=them" method="POST">
    <div class="form-main">
        <div class="form-title">
            <h1>Thêm Nhà Sản Xuất</h1>
        </div>
        <div class="form-content">
            <label class="label">Mã nhà sản xuất</label>
            <input class="text" type="text" name="ma" value="<?php echo htmlspecialchars($ma); ?>">
            <?php echo (!empty($errors['ma']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['trung']) . "</span>" : false ?>
            
            <label class="label">Tên nhà sản xuất</label>
            <input class="text" type="text" name="name" value="<?php echo htmlspecialchars($ten); ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['trung']) . "</span>" : false ?>
            
            <label class="label">Địa chỉ</label>
            <input class="text" type="text" name="mota" value="<?php echo htmlspecialchars($mota); ?>">
            
            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>
