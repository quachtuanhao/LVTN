<?php
include '../././db/connect.php';

$message = '';

if (isset($_GET['this_id'])) {
    $username = $_GET['this_id'];
}

if (isset($_POST['sua'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $errors = [];

    // Kiểm tra họ tên
    if (empty($name)) {
        $errors['name']['required'] = 'Họ tên không được bỏ trống';
    } else if (strlen($name) < 6) {
        $errors['name']['min'] = 'Họ tên phải lớn hơn 6 ký tự';
    } else {
        $sql_check_name = "SELECT * FROM taikhoan WHERE hoTen = '$name' AND userName != '$username'";
        $result_check_name = mysqli_query($conn, $sql_check_name);
        if (mysqli_num_rows($result_check_name) > 0) {
            $errors['name']['duplicate'] = 'Họ tên đã được sử dụng bởi tài khoản khác';
        }
    }

    // Kiểm tra email
    if (empty($email)) {
        $errors['email']['required'] = 'Email không được bỏ trống';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email']['invalid'] = 'Email không hợp lệ';
    }

    // Kiểm tra số điện thoại
    if (empty($sdt)) {
        $errors['sdt']['required'] = 'Số điện thoại không được bỏ trống';
    } else if (!is_numeric($sdt)) {
        $errors['sdt']['invalid'] = 'Số điện thoại phải là số';
    } else if (strlen($sdt) < 10) {
        $errors['sdt']['min'] = 'Số điện thoại phải lớn hơn 10 ký tự';
    }

    // Kiểm tra địa chỉ
    if (empty($diachi)) {
        $errors['diachi']['required'] = 'Địa chỉ không được bỏ trống';
    }

    // Nếu không có lỗi
    if (count($errors) == 0) {
        $sql = "UPDATE taikhoan SET hoTen = '$name', email = '$email', sdt = '$sdt', diachi = '$diachi' WHERE userName = '$username'";
        if (mysqli_query($conn, $sql)) {
            $message = 'Cập nhật tài khoản thành công!';
        } else {
            $message = 'Cập nhật tài khoản thất bại. Vui lòng thử lại.';
        }
        mysqli_close($conn);
        echo "<script>
            alert('$message');
            window.location.href = './index.php?action=quanlytaikhoan&query=no';
        </script>";
        exit();
    }
}
?>

<form class="form" action="./index.php?action=quanlytaikhoan&query=sua&this_id=<?php echo $username ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Thông tin tài khoản</h1>
        </div>
        <div class="form-content">
            <?php
            if (isset($_GET['this_id'])) {
                $sql = "SELECT hoTen, email, sdt, diachi FROM taikhoan WHERE userName='$username'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Lỗi truy vấn chọn tài khoản: ' . mysqli_error($conn));
                }
                $row = mysqli_fetch_array($result);
            ?>
                <label class="label">Họ tên</label>
                <input class="text" type="text" name="name" value="<?php echo isset($name) ? $name : $row['hoTen']; ?>">
                <?php echo !empty($errors['name']['required']) ? "<span class='message-error'>{$errors['name']['required']}</span>" : ''; ?>
                <?php echo !empty($errors['name']['min']) ? "<span class='message-error'>{$errors['name']['min']}</span>" : ''; ?>
                <?php echo !empty($errors['name']['duplicate']) ? "<span class='message-error'>{$errors['name']['duplicate']}</span>" : ''; ?>

                <label class="label">Email</label>
                <input class="text" type="text" name="email" value="<?php echo isset($email) ? $email : $row['email']; ?>">
                <?php echo !empty($errors['email']['required']) ? "<span class='message-error'>{$errors['email']['required']}</span>" : ''; ?>
                <?php echo !empty($errors['email']['invalid']) ? "<span class='message-error'>{$errors['email']['invalid']}</span>" : ''; ?>

                <label class="label">Số điện thoại</label>
                <input class="text" type="text" name="sdt" value="<?php echo isset($sdt) ? $sdt : $row['sdt']; ?>">
                <?php echo !empty($errors['sdt']['required']) ? "<span class='message-error'>{$errors['sdt']['required']}</span>" : ''; ?>
                <?php echo !empty($errors['sdt']['invalid']) ? "<span class='message-error'>{$errors['sdt']['invalid']}</span>" : ''; ?>
                <?php echo !empty($errors['sdt']['min']) ? "<span class='message-error'>{$errors['sdt']['min']}</span>" : ''; ?>

                <label class="label">Địa chỉ</label>
                <input class="text" type="text" name="diachi" value="<?php echo isset($diachi) ? $diachi : $row['diachi']; ?>">
                <?php echo !empty($errors['diachi']['required']) ? "<span class='message-error'>{$errors['diachi']['required']}</span>" : ''; ?>

                <input class="submit" type="submit" name="sua" value="Cập nhật">
            <?php } ?>
        </div>
    </div>
</form>
