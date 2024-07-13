<?php
include '../././db/connect.php';
if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
}
if (isset($_POST['submit'])) {
    $sql = "SELECT maSanPham as ma,tenSanPham as ten,gia,soLuong,hinhAnh,moTa,maNSX 
    from sanpham where maSanPham='$this_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (isset($_GET['this_id'])) {
        $id = $_GET['this_id'];
    }
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $errors = [];
    if (isset($_FILES['anh'])) {
        $anh = $_FILES['anh']['name'];
    }
    $moTa = $_POST['mota'];
    $nsx = $_POST['hang'];
    $loai = $_POST['loai'];
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên sản phẩm không được bỏ trống';
    }
    if (empty($gia)) {
        $errors['gia']['required'] = 'Giá không được bỏ trống';
    } else if (!is_numeric($gia)) {
        $errors['gia']['required'] = 'Giá phải là số';
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
    if (count($errors) == 0) {
        if (empty($anh)) {
            $anh = $row['hinhAnh'];
            $sql = "UPDATE sanpham set tenSanPham='$ten', gia=$,soLuong=$soluong ,hinhAnh='$anh' ,moTa='$moTa' ,maNSX='$nsx',maLSP='$loai'
            where maSanPham='$id'";
            mysqli_query($conn, $sql);
            header('location: ./index.php?action=quanlysanpham&&query=no');
        }
        $sql = "UPDATE sanpham set tenSanPham='$ten', gia=$gia,soLuong=$soluong ,hinhAnh='$anh' ,moTa='$moTa' ,maNSX='$nsx',maLSP='$loai'
        where maSanPham='$id'";
        mysqli_query($conn, $sql);
        header('location: ./index.php?action=quanlysanpham&&query=no');
    }
}
?>

<form class="form" action="./index.php?action=quanlysanpham&&query=sua&&this_id=<?php echo $this_id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin sản phẩm</h1>
        </div>
        <div class="form-content">
            <?php
            $sql = "SELECT maSanPham as ma,tenSanPham as ten,gia,soLuong,hinhAnh,moTa,maNSX,maLSP
                    from sanpham where maSanPham='$this_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['anh'] = $row['hinhAnh'];
            ?>

                <label class="label">Mã sản phẩm</label>
                <input class="text" type="text" name="ma" value="<?php echo $row['ma'] ?>" disabled>
                <label class="label">Tên sản phẩm</label>
                <input class="text" type="text" name="ten" value="<?php echo (!empty($ten) ? $ten : $row['ten']) ?>">
                <?php echo (!empty($errors['ten']['required'])) ? "<span
                        class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
                <label class="label">Giá</label>
                <input class="text" type="text" name="gia" value="<?php echo (!empty($gia) ? $gia : $row['gia']) ?>">
                <?php echo (!empty($errors['gia']['required'])) ? "<span
                        class='message-error'>" . $errors['gia']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['gia']['invalid'])) ? "<span
                        class='message-error'>" . $errors['gia']['invalid'] . "</span>" : false ?>
                <label class="label">Số lượng</label>
                <input class="text" type="text" name="soluong" value="<?php echo (!empty($soluong) ? $soluong : $row['soLuong']) ?>">
                <?php echo (!empty($errors['soluong']['required'])) ? "<span
                        class='message-error'>" . $errors['soluong']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['soluong']['invalid'])) ? "<span
                        class='message-error'>" . $errors['soluong']['invalid'] . "</span>" : false ?>
                <label class="label">Ảnh</label>
                <input type="file" name="anh" value="<?php echo $row['hinhAnh'] ?>">
                <img src="../../././assets/img/<?php echo $row['hinhAnh'] ?> " alt="img" style="width: 80px;height:80px;margin:10px 0">
                <?php echo (!empty($errors['anh']['required'])) ? "<span
                        class='message-error'>" . $errors['anh']['required'] . "</span>" : false ?>
                <label class="label">Mô tả</label>
                <textarea class="text" name="mota" value="" rows="9" cols="70"><?php echo (!empty($moTa) ? $gia : $row['moTa']) ?></textarea>
                <?php
                $ma = $row['maNSX'];
                $maloai = $row['maLSP'];
                ?>
                <label class="label">Nhà sản xuất</label>
            <?php

            }
            ?>

            <select name="hang" id="Hang">
                <?php
                $sql = "SELECT maNhaSanXuat as id,tenNhaSanXuat as ten from nhasanxuat";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $row['id'] ?>" <?php
                                                                if ($ma == $row['id']) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>
                        <?php echo $row['ten'] ?></option>

                <?php
                }
                ?>
            </select>
            <label class="label">Loại sản phẩm</label>

            <select name="loai">
                <?php
                $sql = "SELECT maLoaiSanPham as id,tenLoaiSanPham as ten from loaisanpham";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $row['id'] ?>" <?php
                                                                if ($maloai == $row['id']) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>
                        <?php echo $row['ten'] ?></option>

                <?php
                }
                ?>
            </select>

            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>

    </div>

</form>