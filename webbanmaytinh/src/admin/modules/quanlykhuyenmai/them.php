<?php
include '../././db/connect.php';

if (isset($_POST['submit'])) {
    $ma = $_POST['ma'];
    $ten = $_POST['name'];
    $ngaybd = $_POST['ngaybd'];
    $ngaykt = $_POST['ngaykt'];
    $giatri = $_POST['giatri'];
    $loaikm = $_POST['loaikm'];
    $errors = [];

    // Kiểm tra mã khuyến mãi
    if (empty($ma)) {
        $errors['ma']['required'] = 'Mã không được bỏ trống';
    } else {
        $sql1 = "SELECT maKhuyenMai FROM khuyenmai WHERE maKhuyenMai='$ma'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        if (!empty($row1)) {
            $errors['ma']['trung'] = 'Mã đã tồn tại';
        }
    }

    // Kiểm tra tên khuyến mãi
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên không được bỏ trống';
    } else {
        $sql2 = "SELECT tenKhuyenMai FROM khuyenmai WHERE tenKhuyenMai='$ten'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        if (!empty($row2)) {
            $errors['ten']['trung'] = 'Tên khuyến mãi đã tồn tại';
        }
    }

    // Kiểm tra giá trị khuyến mãi
    if ($loaikm == "KM1") {
        if (empty($giatri)) {
            $errors['giatri']['required'] = 'Giá trị không được bỏ trống';
        } else if (!is_numeric($giatri)) {
            $errors['giatri']['invalid'] = 'Giá trị phải là số';
        }
    }
    if ($loaikm == "KM2") {
        if (empty($giatri)) {
            $errors['giatri']['required'] = 'Giá trị không được bỏ trống';
        } else if (!is_numeric($giatri)) {
            $errors['giatri']['invalid'] = 'Giá trị phải là số';
        } else if (strlen($giatri) > 2) {
            $errors['giatri']['max'] = 'Giá trị phải từ 1-99';
        }
    }

    // Nếu không có lỗi thì thực hiện thêm khuyến mãi
    if (count($errors) == 0) {
        if (isset($_POST['hienthi']) && $_POST['hienthi'] == 1) {
            $sql = "INSERT INTO khuyenmai(maKhuyenMai, tenKhuyenMai, ngayBatDau, ngayKetThuc, maLKM, giaTriKhuyenMai, hienThi)
                    VALUES('$ma', '$ten', '$ngaybd', '$ngaykt', '$loaikm', '$giatri', 1)";
        } else {
            $sql = "INSERT INTO khuyenmai(maKhuyenMai, tenKhuyenMai, ngayBatDau, ngayKetThuc, maLKM, giaTriKhuyenMai)
                    VALUES('$ma', '$ten', '$ngaybd', '$ngaykt', '$loaikm', '$giatri')";
        }
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $message = 'Thêm khuyến mãi thành công';
        } else {
            $message = 'Thêm khuyến mãi thất bại';
        }
        header("location: ./index.php?action=quanlykhuyenmai&&query=no&message=" . urlencode($message));
    }
}
?>

<form class="form" action="./index.php?action=quanlykhuyenmai&&query=them" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Thêm Mã Khuyến Mãi</h1>
        </div>
        <div class="form-content">
            <label class="label">Mã khuyến mãi</label>
            <input class="text" type="text" name="ma" value="<?php echo (!empty($ma) ? $ma : "") ?>">
            <?php echo (!empty($errors['ma']['required'])) ? "<span class='message-error'>" . $errors['ma']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span class='message-error'>" . $errors['ma']['trung'] . "</span>" : false ?>
            
            <label class="label">Tên khuyến mãi</label>
            <input class="text" type="text" name="name" value="<?php echo (!empty($ten) ? $ten : "") ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . $errors['ten']['trung'] . "</span>" : false ?>
            
            <label class="label">Ngày bắt đầu</label>
            <input class="text" type="date" name="ngaybd" value="<?php echo (!empty($ngaybd) ? $ngaybd : "") ?>">
            
            <label class="label">Ngày kết thúc</label>
            <input class="text" type="date" name="ngaykt" value="<?php echo (!empty($ngaykt) ? $ngaykt : "") ?>">
            
            <label class="label">Loại khuyến mãi</label>
            <select name="loaikm" id="Hang">
                <?php
                $sql = "SELECT maLoai, tenLoai FROM loaikhuyenmai";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $row['maLoai'] ?>"><?php echo $row['tenLoai'] ?></option>
                <?php
                }
                ?>
            </select>
            
            <label class="label">Giá trị khuyến mãi</label>
            <?php echo (!empty($errors['giatri']['required'])) ? "<span class='message-error'>" . $errors['giatri']['required'] . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['invalid'])) ? "<span class='message-error'>" . $errors['giatri']['invalid'] . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['max'])) ? "<span class='message-error'>" . $errors['giatri']['max'] . "</span>" : false ?>
            <input class="text" type="text" name="giatri" value="<?php echo (!empty($giatri) ? $giatri : "") ?>">
            
            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>

<?php
if (isset($_GET['message'])) {
    echo "<div class='message'>" . $_GET['message'] . "</div>";
}
?>
