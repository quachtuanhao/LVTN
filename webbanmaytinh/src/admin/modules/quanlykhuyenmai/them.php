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
    if (empty($giatri)) {
        $errors['giatri']['required'] = 'Giá trị không được bỏ trống';
    } else if (!is_numeric($giatri)) {
        $errors['giatri']['invalid'] = 'Giá trị phải là số';
    } else if ($giatri < 0) {
        $errors['giatri']['negative'] = 'Giá trị không được âm';
    } else if ($loaikm == "KM2" && $giatri > 100) { // Giảm giá theo phần trăm
        $errors['giatri']['max'] = 'Giá trị phần trăm không được vượt quá 100';
    }

    // Kiểm tra ngày kết thúc không được trước ngày bắt đầu
    if (strtotime($ngaykt) < strtotime($ngaybd)) {
        $errors['ngaykt']['invalid'] = 'Ngày kết thúc không được trước ngày bắt đầu';
    }

    // Kiểm tra ngày bắt đầu và ngày kết thúc không được trùng nhau
    if ($ngaybd === $ngaykt) {
        $errors['ngaykt']['trung'] = 'Ngày kết thúc không được trùng với ngày bắt đầu';
    }

    // Nếu không có lỗi thì thực hiện thêm khuyến mãi
    if (count($errors) == 0) {
        $sql = "INSERT INTO khuyenmai(maKhuyenMai, tenKhuyenMai, ngayBatDau, ngayKetThuc, maLKM, giaTriKhuyenMai)
                VALUES('$ma', '$ten', '$ngaybd', '$ngaykt', '$loaikm', '$giatri')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            echo "<script>
                alert('Thêm khuyến mãi thành công!');
                window.location.href = 'index.php?action=quanlykhuyenmai&query=no';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Thêm khuyến mãi thất bại. Vui lòng thử lại.');
                window.location.href = document.referrer;
            </script>";
            exit();
        }
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
            <input class="text" type="text" name="ma" value="<?php echo (!empty($ma) ? htmlspecialchars($ma) : "") ?>">
            <?php echo (!empty($errors['ma']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['trung']) . "</span>" : false ?>
            
            <label class="label">Tên khuyến mãi</label>
            <input class="text" type="text" name="name" value="<?php echo (!empty($ten) ? htmlspecialchars($ten) : "") ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['trung']) . "</span>" : false ?>
            
            <label class="label">Ngày bắt đầu</label>
            <input class="text" type="date" name="ngaybd" value="<?php echo (!empty($ngaybd) ? htmlspecialchars($ngaybd) : "") ?>">
            
            <label class="label">Ngày kết thúc</label>
            <input class="text" type="date" name="ngaykt" value="<?php echo (!empty($ngaykt) ? htmlspecialchars($ngaykt) : "") ?>">
            <?php echo (!empty($errors['ngaykt']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ngaykt']['invalid']) . "</span>" : false ?>
            <?php echo (!empty($errors['ngaykt']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ngaykt']['trung']) . "</span>" : false ?>
            
            <label class="label">Loại khuyến mãi</label>
            <select name="loaikm" id="Hang">
                <?php
                $sql = "SELECT maLoai, tenLoai FROM loaikhuyenmai";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo htmlspecialchars($row['maLoai']) ?>"><?php echo htmlspecialchars($row['tenLoai']) ?></option>
                <?php
                }
                ?>
            </select>
            
            <label class="label">Giá trị khuyến mãi</label>
            <?php echo (!empty($errors['giatri']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['invalid']) . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['negative'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['negative']) . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['max'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['max']) . "</span>" : false ?>
            <input class="text" type="text" name="giatri" value="<?php echo (!empty($giatri) ? htmlspecialchars($giatri) : "") ?>">
            
            <input class="submit" type="submit" name="submit" value="Thêm">
        </div>
    </div>
</form>
