<?php
include '../././db/connect.php';

if (isset($_POST['submit'])) {
    $ten = $_POST['name'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $mota = $_POST['mota'];
    $nsx = $_POST['hang'];
    $loai = $_POST['loai'];
    $errors = [];
    
    // Xử lý ảnh
    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $anh = $_FILES['anh']['name'];
        $filetype = $_FILES['anh']['type'];
        $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png"];
        if (!in_array($filetype, $allowed)) {
            $errors['anh']['type'] = 'Chỉ nhận file jpg, jpeg, png!';
        } else {
            // Di chuyển file đến thư mục ảnh
            $target = "../../././assets/img/" . $anh;
            move_uploaded_file($_FILES['anh']['tmp_name'], $target);
        }
    } else {
        $errors['anh']['required'] = 'Chưa chọn ảnh';
    }

    // Kiểm tra tên sản phẩm
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên sản phẩm không được bỏ trống';
    } else {
        // Kiểm tra tên sản phẩm có bị trùng không
        $sql_check = "SELECT * FROM sanpham WHERE tenSanPham = '$ten'";
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
    if (empty($soluong)) {
        $errors['soluong']['required'] = 'Số lượng không được bỏ trống';
    } elseif (!is_numeric($soluong)) {
        $errors['soluong']['invalid'] = 'Số lượng phải là số';
    } elseif ($soluong < 0) {
        $errors['soluong']['invalid'] = 'Số lượng không được âm';
    }

    // Tạo mã sản phẩm mới
    $ma = "";
    $sql_max = "SELECT MAX(maSanPham) AS max_ma FROM sanpham";
    $result_max = mysqli_query($conn, $sql_max);
    $row_max = mysqli_fetch_assoc($result_max);
    $max_ma = $row_max['max_ma'];

    if ($max_ma) {
        $last_id = (int)substr($max_ma, 2); // Lấy số sau 'SP'
        $ma = 'SP' . ($last_id + 1);
    } else {
        $ma = 'SP1';
    }

    // Kiểm tra lỗi và thêm sản phẩm
    if (count($errors) == 0) {
        $sql = "INSERT INTO sanpham (maSanPham, tenSanPham, gia, soLuong, hinhAnh, moTa, maNSX, maLSP) 
                VALUES ('$ma', '$ten', '$gia', '$soluong', '$anh', '$mota', '$nsx', '$loai')";
        mysqli_query($conn, $sql);

        $_SESSION['success_message'] = 'Thêm sản phẩm thành công!';
        header('Location: ./index.php?action=quanlysanpham&query=no');
        exit();
    }
}
?>

<!-- Form thêm sản phẩm -->
<form class="form" action="./index.php?action=quanlysanpham&&query=them" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Thêm sản phẩm</h1>
        </div>
        <div class="form-content">
            <label class="label">Tên sản phẩm</label>
            <input class="text" type="text" name="name" value="<?php echo (!empty($ten) ? $ten : "") ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['duplicate'])) ? "<span class='message-error'>" . $errors['ten']['duplicate'] . "</span>" : false ?>
            
            <label class="label">Giá</label>
            <input class="text" type="text" name="gia" value="<?php echo (!empty($gia) ? $gia : "") ?>">
            <?php echo (!empty($errors['gia']['required'])) ? "<span class='message-error'>" . $errors['gia']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['gia']['invalid'])) ? "<span class='message-error'>" . $errors['gia']['invalid'] . "</span>" : false ?>

            <label class="label">Số lượng</label>
            <input class="text" type="text" name="soluong" value="<?php echo (!empty($soluong) ? $soluong : "") ?>">
            <?php echo (!empty($errors['soluong']['required'])) ? "<span class='message-error'>" . $errors['soluong']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['soluong']['invalid'])) ? "<span class='message-error'>" . $errors['soluong']['invalid'] . "</span>" : false ?>

            <label class="label">Ảnh</label>
            <input class="text" type="file" name="anh" accept="image/*">
            <?php echo (!empty($errors['anh']['required'])) ? "<span class='message-error'>" . $errors['anh']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['anh']['type'])) ? "<span class='message-error'>" . $errors['anh']['type'] . "</span>" : false ?>

            <label class="label">Mô tả</label>
            <textarea class="text" name="mota" rows="9" cols="70"><?php echo (!empty($mota) ? $mota : "") ?></textarea>

            <label class="label">Nhà sản xuất</label>
            <select class="text" name="hang" id="Hang">
                <?php
                $sql = "SELECT maNhaSanXuat as id, tenNhaSanXuat as ten FROM nhasanxuat";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='{$row['id']}'>{$row['ten']}</option>";
                }
                ?>
            </select>

            <label class="label">Loại sản phẩm</label>
            <select class="text" name="loai">
                <?php
                $sql = "SELECT maLoaiSanPham as id, tenLoaiSanPham as ten FROM loaisanpham";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='{$row['id']}'>{$row['ten']}</option>";
                }
                ?>
            </select>

            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>

<?php
// Hiển thị thông báo thành công nếu có
if (isset($_SESSION['success_message'])) {
    echo "<p class='message-success'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']);
}
?>
