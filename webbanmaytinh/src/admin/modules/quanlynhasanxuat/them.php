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
    if (empty($ma)) {
        $errors['ma']['required'] = 'Mã không được bỏ trống';
    } else {
        $sql1 = "SELECT maNhaSanXuat from nhasanxuat where maNhaSanXuat='$ma'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        if (!empty($row1)) {
            $errors['ma']['trung'] = 'Mã đã tồn tại';
        }
        // else{
        //     $errors['username']['trung']='';
        // }
    }
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên không được bỏ trống';
    }
    if (count($errors) == 0) {
        $sql = "INSERT into nhasanxuat(maNhaSanXuat,tenNhaSanXuat,truSoChinh)
            values('$ma','$ten','$mota')";
        mysqli_query($conn, $sql);
        header('location:./index.php?action=quanlynhasanxuat&&query=no');
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
            <?php echo (!empty($errors['ma']['required'])) ? "<span
            class='message-error'>" . $errors['ma']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span
            class='message-error'>" . $errors['ma']['trung'] . "</span>" : false ?>
            <label class="label">Tên nhà sản xuất</label>
            <input class="text" type="text" name="name" value="<?php echo $ten ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span
            class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
            <label class="label">Địa chỉ</label>
            <input class="text" type="text" name="mota" value="<?php echo $mota ?>">
            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>