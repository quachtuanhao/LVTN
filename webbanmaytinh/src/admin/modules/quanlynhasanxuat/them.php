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
        $row1 = mysqli_fetch_array($result1);
        if (!empty($row1)) {
            $errors['ma']['trung'] = 'Mã đã tồn tại';
        }
    }

    // Kiểm tra tên nhà sản xuất
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên không được bỏ trống';
    } else {
        $sql2 = "SELECT tenNhaSanXuat FROM nhasanxuat WHERE tenNhaSanXuat='$ten'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        if (!empty($row2)) {
            $errors['ten']['trung'] = 'Tên nhà sản xuất đã tồn tại';
        }
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO nhasanxuat(maNhaSanXuat, tenNhaSanXuat, truSoChinh)
                VALUES('$ma', '$ten', '$mota')";
        mysqli_query($conn, $sql);
        header('location: ./index.php?action=quanlynhasanxuat&&query=no');
    }
}
?>

<form class="form" action="./index.php?action=quanlynhasanxuat&&query=them" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Thêm Nhà Sản Xuất</h1>
        </div>
        <div class="form-content">
            <label class="label">Mã nhà sản xuất</label>
            <input class="text" type="text" name="ma" value="<?php echo $ma ?>">
            <?php echo (!empty($errors['ma']['required'])) ? "<span class='message-error'>" . $errors['ma']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span class='message-error'>" . $errors['ma']['trung'] . "</span>" : false ?>
            
            <label class="label">Tên nhà sản xuất</label>
            <input class="text" type="text" name="name" value="<?php echo $ten ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . $errors['ten']['trung'] . "</span>" : false ?>
            
            <label class="label">Địa chỉ</label>
            <input class="text" type="text" name="mota" value="<?php echo $mota ?>">
            
            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>
