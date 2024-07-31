<?php
include '../././db/connect.php';

if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
}

if (isset($_POST['submit'])) {
    // Lấy thông tin sản phẩm hiện tại từ cơ sở dữ liệu
    $sql = "SELECT maSanPham as ma, tenSanPham as ten, gia, soLuong, hinhAnh, moTa, maNSX, maLSP
            FROM sanpham WHERE maSanPham='$this_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $moTa = $_POST['mota'];
    $nsx = $_POST['hang'];
    $loai = $_POST['loai'];
    $anh = $row['hinhAnh'];
    $errors = [];

    // Xử lý ảnh
    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $new_anh = $_FILES['anh']['name'];
        $filetype = $_FILES['anh']['type'];
        $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png"];
        if (!in_array($filetype, $allowed)) {
            $errors['anh']['type'] = 'Chỉ nhận file jpg, jpeg, png!';
        } else {
            // Di chuyển file đến thư mục ảnh
            $target = "../../././assets/img/" . $new_anh;
            move_uploaded_file($_FILES['anh']['tmp_name'], $target);
            $anh = $new_anh; // Cập nhật tên ảnh mới
        }
    }

    // Kiểm tra lỗi trùng tên sản phẩm
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên sản phẩm không được bỏ trống';
    } else {
        $sql_check = "SELECT * FROM sanpham WHERE tenSanPham='$ten' AND maSanPham != '$this_id'";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            $errors['ten']['duplicate'] = 'Tên sản phẩm đã tồn tại';
        }
    }

    // Kiểm tra giá
    if (empty($gia)) {
        $errors['gia']['required'] = 'Giá không được bỏ trống';
    } elseif (!is_numeric($gia)) {
        $errors['gia']['invalid'] = 'Giá phải là số';
    } elseif ($gia < 0) {
        $errors['gia']['invalid'] = 'Giá không được âm';
    }

    // Kiểm tra số lượng
    if (!isset($soluong)) {
        $errors['soluong']['required'] = 'Số lượng không được bỏ trống';
    } elseif (!is_numeric($soluong)) {
        $errors['soluong']['invalid'] = 'Số lượng phải là số';
    } elseif ($soluong < 0) {
        $errors['soluong']['invalid'] = 'Số lượng không được âm';
    }

    // Cập nhật sản phẩm nếu không có lỗi
    if (count($errors) == 0) {
        $sql_update = "UPDATE sanpham 
                       SET tenSanPham='$ten', gia='$gia', soLuong='$soluong', hinhAnh='$anh', moTa='$moTa', maNSX='$nsx', maLSP='$loai'
                       WHERE maSanPham='$this_id'";
        if (mysqli_query($conn, $sql_update)) {
            echo "<script>
                alert('Cập nhật sản phẩm thành công!');
                window.location.href = './index.php?action=quanlysanpham&query=no';
            </script>";
        } else {
            echo "<script>
                alert('Cập nhật sản phẩm thất bại. Vui lòng thử lại.');
                window.location.href = document.referrer; // Trở về trang trước đó
            </script>";
        }
        exit();
    } else {
        echo "<script>
            alert('Có lỗi trong khi cập nhật sản phẩm. Vui lòng kiểm tra thông tin và thử lại.');
            window.location.href = document.referrer; // Trở về trang trước đó
        </script>";
        exit();
    }
}
?>

<!-- Form sửa sản phẩm -->
<form class="form" action="./index.php?action=quanlysanpham&&query=sua&&this_id=<?php echo $this_id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin sản phẩm</h1>
        </div>
        <div class="form-content">
            <?php
            $sql = "SELECT maSanPham as ma, tenSanPham as ten, gia, soLuong, hinhAnh, moTa, maNSX, maLSP
                    FROM sanpham WHERE maSanPham='$this_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>

            <label class="label">Mã sản phẩm</label>
            <input class="text" type="text" name="ma" value="<?php echo $row['ma'] ?>" disabled>

            <label class="label">Tên sản phẩm</label>
            <input class="text" type="text" name="ten" value="<?php echo $row['ten'] ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['duplicate'])) ? "<span class='message-error'>" . $errors['ten']['duplicate'] . "</span>" : false ?>

            <label class="label">Giá</label>
            <input class="text" type="text" name="gia" value="<?php echo $row['gia'] ?>">
            <?php echo (!empty($errors['gia']['required'])) ? "<span class='message-error'>" . $errors['gia']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['gia']['invalid'])) ? "<span class='message-error'>" . $errors['gia']['invalid'] . "</span>" : false ?>

            <label class="label">Số lượng</label>
            <input class="text" type="text" name="soluong" value="<?php echo $row['soLuong'] ?>">
            <?php echo (!empty($errors['soluong']['required'])) ? "<span class='message-error'>" . $errors['soluong']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['soluong']['invalid'])) ? "<span class='message-error'>" . $errors['soluong']['invalid'] . "</span>" : false ?>

            <label class="label">Ảnh</label>
            <input class="text" type="file" name="anh" accept="image/*">
            <img src="../../././assets/img/<?php echo $row['hinhAnh'] ?>" alt="img" style="width: 80px; height: 80px; margin: 10px 0">

            <label class="label">Mô tả</label>
            <textarea class="text" name="mota" rows="9" cols="70"><?php echo $row['moTa'] ?></textarea>

            <label class="label">Nhà sản xuất</label>
            <select class="text" name="hang" id="Hang">
                <?php
                $sql = "SELECT maNhaSanXuat as id, tenNhaSanXuat as ten FROM nhasanxuat";
                $result = mysqli_query($conn, $sql);
                while ($row_nhaxuat = mysqli_fetch_array($result)) {
                    echo "<option value='{$row_nhaxuat['id']}' " . ($row['maNSX'] == $row_nhaxuat['id'] ? 'selected' : '') . ">{$row_nhaxuat['ten']}</option>";
                }
                ?>
            </select>

            <label class="label">Loại sản phẩm</label>
            <select class="text" name="loai">
                <?php
                $sql = "SELECT maLoaiSanPham as id, tenLoaiSanPham as ten FROM loaisanpham";
                $result = mysqli_query($conn, $sql);
                while ($row_loai = mysqli_fetch_array($result)) {
                    echo "<option value='{$row_loai['id']}' " . ($row['maLSP'] == $row_loai['id'] ? 'selected' : '') . ">{$row_loai['ten']}</option>";
                }
                ?>
            </select>

            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>
    </div>
</form>
