<?php
include '../././db/connect.php';

$message = '';

if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
}

if (isset($_POST['submit'])) {
    if (isset($_GET['this_id'])) {
        $id = $_GET['this_id'];
    }
    $ten = $_POST['ten'];
    $ngayBatDau = $_POST['ngayBatDau'];
    $ngayKetThuc = $_POST['ngayKetThuc'];
    $maLKM = $_POST['loaikm'];
    $giaTriKhuyenMai = $_POST['giaTriKhuyenMai'];
    $errors = [];

    // Kiểm tra tên khuyến mãi
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên khuyến mãi không được bỏ trống';
    } else {
        $sql_check = "SELECT tenKhuyenMai FROM khuyenmai WHERE tenKhuyenMai='$ten' AND maKhuyenMai != '$id'";
        $result_check = mysqli_query($conn, $sql_check);
        if (!$result_check) {
            die('Lỗi truy vấn kiểm tra tên khuyến mãi: ' . mysqli_error($conn));
        }
        $row_check = mysqli_fetch_array($result_check);
        if (!empty($row_check)) {
            $errors['ten']['trung'] = 'Tên khuyến mãi đã tồn tại';
        }
    }

    // Kiểm tra ngày bắt đầu và ngày kết thúc
    if (empty($ngayBatDau)) {
        $errors['ngayBatDau']['required'] = 'Ngày bắt đầu không được bỏ trống';
    }
    if (empty($ngayKetThuc)) {
        $errors['ngayKetThuc']['required'] = 'Ngày kết thúc không được bỏ trống';
    }

    if (count($errors) == 0) {
            $sql = "UPDATE khuyenmai SET tenKhuyenMai='$ten', ngayBatDau='$ngayBatDau', ngayKetThuc='$ngayKetThuc', maLKM='$maLKM', giaTriKhuyenMai='$giaTriKhuyenMai' WHERE maKhuyenMai='$id'";
        if (mysqli_query($conn, $sql)) {
            $message = 'Sửa thông tin khuyến mãi thành công';
        } else {
            $message = 'Sửa thông tin khuyến mãi thất bại';
        }
        mysqli_close($conn);
        header('location: ./index.php?action=quanlykhuyenmai&&query=no&message=' . urlencode($message));
        exit();
    }
}
?>

<form class="form" action="./index.php?action=quanlykhuyenmai&&query=sua&&this_id=<?php echo $this_id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin khuyến mãi</h1>
        </div>
        <div class="form-content">
            <?php
            $sql = "SELECT maKhuyenMai as ma, tenKhuyenMai as ten, ngayBatDau, ngayKetThuc, maLKM, giaTriKhuyenMai
            FROM khuyenmai 
            JOIN loaikhuyenmai ON khuyenmai.maLKM = loaikhuyenmai.maLoai 
            WHERE maKhuyenMai='$this_id'";
    
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die('Lỗi truy vấn chọn khuyến mãi: ' . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <label class="label">Mã khuyến mãi</label>
                <input class="text" type="text" name="ma" value="<?php echo $row['ma'] ?>" disabled>
                
                <label class="label">Tên khuyến mãi</label>
                <input class="text" type="text" name="ten" value="<?php echo (!empty($ten) ? $ten : $row['ten']) ?>">
                <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . $errors['ten']['trung'] . "</span>" : false ?>

                <label class="label">Ngày bắt đầu</label>
                <input class="text" type="date" name="ngayBatDau" value="<?php echo (!empty($ngayBatDau) ? $ngayBatDau : $row['ngayBatDau']) ?>">
                <?php echo (!empty($errors['ngayBatDau']['required'])) ? "<span class='message-error'>" . $errors['ngayBatDau']['required'] . "</span>" : false ?>

                <label class="label">Ngày kết thúc</label>
                <input class="text" type="date" name="ngayKetThuc" value="<?php echo (!empty($ngayKetThuc) ? $ngayKetThuc : $row['ngayKetThuc']) ?>">
                <?php echo (!empty($errors['ngayKetThuc']['required'])) ? "<span class='message-error'>" . $errors['ngayKetThuc']['required'] . "</span>" : false ?>

                <label class="label">Loại khuyến mãi</label>
                <select name="loaikm" id="Hang">
                    <?php
                    $sql1 = "SELECT maLoai, tenLoai FROM loaikhuyenmai";
                    $result1 = mysqli_query($conn, $sql1);
                    if (!$result1) {
                        die('Lỗi truy vấn chọn loại khuyến mãi: ' . mysqli_error($conn));
                    }
                    while ($row1 = mysqli_fetch_array($result1)) {
                    ?>
                        <option value="<?php echo $row1['maLoai'] ?>" <?php if ($row1['maLoai'] == $row['maLKM']) { echo 'selected'; } ?>>
                            <?php echo $row1['tenLoai'] ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>

                <label class="label">Giá trị khuyến mãi</label>
                <input class="text" type="text" name="giaTriKhuyenMai" value="<?php echo (!empty($giaTriKhuyenMai) ? $giaTriKhuyenMai : $row['giaTriKhuyenMai']) ?>">
                <?php echo (!empty($errors['giaTriKhuyenMai']['required'])) ? "<span class='message-error'>" . $errors['giaTriKhuyenMai']['required'] . "</span>" : false ?>
                
            <?php
            }
            ?>
            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>
    </div>
</form>

<?php
if (isset($_GET['message'])) {
    echo "<div class='message'>" . $_GET['message'] . "</div>";
}
?>
