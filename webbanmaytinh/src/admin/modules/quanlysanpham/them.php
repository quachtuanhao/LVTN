<?php
include '../././db/connect.php';
$nsx = "";
if (isset($_POST['submit'])) {
    $ma = $_POST['ma'];
    $ten = $_POST['name'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    if (isset($_FILES["anh"]) ) {
        $anh = $_FILES["anh"]["name"];
        $filetype = $_FILES["anh"]["type"];
        $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png"];
        if (!in_array($filetype, $allowed)) {
            $errors['anh']['type'] = 'Chỉ nhận file jpg, jpeg, png!';
        }
    }
    $mota = $_POST['mota'];
    $nsx = $_POST['hang'];
    $loai = $_POST['loai'];
    $errors = [];
    if (empty($ma)) {
        $errors['ma']['required'] = 'Mã không được bỏ trống';
    } else {
        $sql1 = "SELECT maSanPham from sanpham where maSanPham='$ma'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        if (!empty($row1)) {
            $errors['ma']['trung'] = 'Mã sản phẩm đã tồn tại';
        }
        
    }
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên sản phẩm không được bỏ trống';
    } else {
        $sql2 = "SELECT tenSanPham from sanpham where tenSanPham='$ten'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        if (!empty($row2)) {
            $errors['ten']['trung'] = 'Tên sản phẩm đã tồn tại';
        }
    }if (empty($gia)) {
        $errors['gia']['required'] = 'Giá không được bỏ trống';
    } else if (!is_numeric($gia)) {
        $errors['gia']['invalid'] = 'Giá phải là số ';
    }else if ($gia<0) {
        $errors['gia']['required'] = 'Giá không được âm';
    }
    if (empty($soluong)) {
        $errors['soluong']['required'] = 'Số lượng không được bỏ trống';
    } else if (!is_numeric($soluong)) {
        $errors['soluong']['invalid'] = 'Số lượng phải là số ';
    }else if ($soluong<0) {
        $errors['soluong']['required'] = 'Số lượng không được âm';
    }
    if (empty($anh)) {
        $errors['anh']['required'] = 'Chưa chọn ảnh';
    }
    if (count($errors) == 0) {
        $sql = "INSERT into sanpham(maSanPham,tenSanPham,gia,soLuong,hinhAnh,moTa,maNSX,maLSP)
            values('$ma','$ten','$gia','$soluong','$anh','$mota','$nsx','$loai')";
        mysqli_query($conn, $sql);
        header('location:./index.php?action=quanlysanpham&&query=no');
    }
}
?>

<form class="form" action="./index.php?action=quanlysanpham&&query=them" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Thêm sản phẩm</h1>
        </div>
        <div class="form-content">
            <label class="label">Mã sản phẩm</label>
            <input class="text" type="text" name="ma" value="<?php echo (!empty($ma) ? $ma : "") ?>">
            <?php echo (!empty($errors['ma']['required'])) ? "<span
            class='message-error'>" . $errors['ma']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span
            class='message-error'>" . $errors['ma']['trung'] . "</span>" : false ?>
            <label class="label">Tên sản phẩm</label>
            <input class="text" type="text" name="name" value="<?php echo (!empty($ten) ? $ten : "") ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span
            class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span
            class='message-error'>" . $errors['ten']['trung'] . "</span>" : false ?>
            <label class="label">Giá</label>
            <input class="text" type="text" name="gia" value="<?php echo (!empty($gia) ? $gia : "") ?>">
            <?php echo (!empty($errors['gia']['required'])) ? "<span
            class='message-error'>" . $errors['gia']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['gia']['invalid'])) ? "<span
            class='message-error'>" . $errors['gia']['invalid'] . "</span>" : false ?>
            <label class="label">Số lượng</label>
            <input class="text" type="text" name="soluong" value="<?php echo (!empty($soluong) ? $soluong : "") ?>">
            <?php echo (!empty($errors['soluong']['required'])) ? "<span
            class='message-error'>" . $errors['soluong']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['soluong']['invalid'])) ? "<span
            class='message-error'>" . $errors['soluong']['invalid'] . "</span>" : false ?>
            <label class="label">Ảnh</label>
            <input class="text" type="file" name="anh" accept="image/*" >
            <?php echo (!empty($errors['anh']['required'])) ? "<span
            class='message-error'>" . $errors['anh']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['anh']['type'])) ? "<span
            class='message-error'>" . $errors['anh']['type'] . "</span>" : false ?>
            <label class="label">Mô tả</label>
            <textarea  name="mota" rows="9" cols="70"><?php echo (!empty($mota) ? $mota : "") ?></textarea>
            <label class="label">Nhà sản xuất</label>
            <select class="text" name="hang" id="Hang">
                <?php
                $sql = "SELECT maNhaSanXuat as id,tenNhaSanXuat as ten from nhasanxuat";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == $nsx) echo 'selected' ?>><?php echo $row['ten'] ?></option>

                <?php
                }
                ?>
            </select>
            <label class="label">Loại sản phẩm</label>
            <select class="text" name="loai">
                <?php
                $sql = "SELECT maLoaiSanPham as id,tenLoaiSanPham as ten from loaisanpham";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == $nsx) echo 'selected' ?>><?php echo $row['ten'] ?></option>
                <?php
                }
                ?>
            </select>
            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>