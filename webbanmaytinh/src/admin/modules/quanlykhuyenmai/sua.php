<?php
include '../././db/connect.php';

$message = '';
$errors = [];

// Lấy ID từ query string
if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];

    // Lấy thông tin khuyến mãi hiện tại từ cơ sở dữ liệu
    $sql = "SELECT * FROM khuyenmai WHERE maKhuyenMai='$this_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $ma = $row['maKhuyenMai'];
        $ten = $row['tenKhuyenMai'];
        $ngaybd = $row['ngayBatDau'];
        $ngaykt = $row['ngayKetThuc'];
        $giatri = $row['giaTriKhuyenMai'];
        $loaikm = $row['maLKM'];
    } else {
        die('Lỗi truy vấn: ' . mysqli_error($conn));
    }
}

if (isset($_POST['submit'])) {
    $ma = $_POST['ma'];
    $ten = $_POST['name'];
    $ngaybd = $_POST['ngaybd'];
    $ngaykt = $_POST['ngaykt'];
    $giatri = $_POST['giatri'];
    $loaikm = $_POST['loaikm'];
    $errors = [];

    // Kiểm tra tên khuyến mãi
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên không được bỏ trống';
    } else {
        $sql2 = "SELECT tenKhuyenMai FROM khuyenmai WHERE tenKhuyenMai='$ten' AND maKhuyenMai != '$this_id'";
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
        $errors['giatri']['min'] = 'Giá trị khuyến mãi không được âm';
    } else if ($loaikm == "KM2" && $giatri > 100) { // Giảm giá theo phần trăm không được vượt quá 100%
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

    // Nếu không có lỗi thì thực hiện cập nhật khuyến mãi
    if (count($errors) == 0) {
        $sql = "UPDATE khuyenmai SET tenKhuyenMai='$ten', ngayBatDau='$ngaybd', ngayKetThuc='$ngaykt', maLKM='$loaikm', giaTriKhuyenMai='$giatri' WHERE maKhuyenMai='$this_id'";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            echo "<script>
                alert('Cập nhật khuyến mãi thành công!');
                window.location.href = 'index.php?action=quanlykhuyenmai&query=no';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Cập nhật khuyến mãi thất bại. Vui lòng thử lại.');
                window.location.href = document.referrer;
            </script>";
            exit();
        }
    }
}
?>

<form class="form" action="./index.php?action=quanlykhuyenmai&&query=sua&&this_id=<?php echo htmlspecialchars($this_id) ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa Mã Khuyến Mãi</h1>
        </div>
        <div class="form-content">
            <label class="label">Mã khuyến mãi</label>
            <input class="text" type="text" name="ma" value="<?php echo htmlspecialchars($ma) ?>" readonly>
            <?php echo (!empty($errors['ma']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['ma']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ma']['trung']) . "</span>" : false ?>
            
            <label class="label">Tên khuyến mãi</label>
            <input class="text" type="text" name="name" value="<?php echo htmlspecialchars($ten) ?>">
            <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ten']['trung']) . "</span>" : false ?>
            
            <label class="label">Ngày bắt đầu</label>
            <input class="text" type="date" name="ngaybd" value="<?php echo htmlspecialchars($ngaybd) ?>">
            
            <label class="label">Ngày kết thúc</label>
            <input class="text" type="date" name="ngaykt" value="<?php echo htmlspecialchars($ngaykt) ?>">
            <?php echo (!empty($errors['ngaykt']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ngaykt']['invalid']) . "</span>" : false ?>
            <?php echo (!empty($errors['ngaykt']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['ngaykt']['trung']) . "</span>" : false ?>
            
            <label class="label">Loại khuyến mãi</label>
            <select name="loaikm" id="Hang">
                <?php
                $sql = "SELECT maLoai, tenLoai FROM loaikhuyenmai";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $selected = ($row['maLoai'] == $loaikm) ? 'selected' : '';
                ?>
                    <option value="<?php echo htmlspecialchars($row['maLoai']) ?>" <?php echo $selected ?>><?php echo htmlspecialchars($row['tenLoai']) ?></option>
                <?php
                }
                ?>
            </select>
            
            <label class="label">Giá trị khuyến mãi</label>
            <?php echo (!empty($errors['giatri']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['required']) . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['invalid']) . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['min'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['min']) . "</span>" : false ?>
            <?php echo (!empty($errors['giatri']['max'])) ? "<span class='message-error'>" . htmlspecialchars($errors['giatri']['max']) . "</span>" : false ?>
            <input class="text" type="text" name="giatri" value="<?php echo htmlspecialchars($giatri) ?>">
            
            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>
    </div>
</form>
