<?php
include '../../../db/connect.php';

if (isset($_POST['sua'])) {
    $username = $_SESSION['dangnhap'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $diachi = trim($_POST['diachi']);

    $errors = [];

    // Kiểm tra thông tin
    if (empty($name)) {
        $errors['name'] = 'Tên không được bỏ trống';
    } elseif (strlen($name) < 6) {
        $errors['name'] = 'Tên phải dài hơn 6 ký tự';
    }

    if (empty($email)) {
        $errors['email'] = 'Email không được bỏ trống';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ';
    }

    if (empty($sdt)) {
        $errors['sdt'] = 'Số điện thoại không được bỏ trống';
    } elseif (!is_numeric($sdt)) {
        $errors['sdt'] = 'Số điện thoại phải là số';
    } elseif (strlen($sdt) < 10) {
        $errors['sdt'] = 'Số điện thoại phải dài hơn 10 ký tự';
    }

    if (empty($diachi)) {
        $errors['diachi'] = 'Địa chỉ không được bỏ trống';
    }

    if (count($errors) == 0) {
        // Sử dụng prepared statement để bảo vệ khỏi SQL Injection
        $sql = "UPDATE taikhoan SET hoTen = ?, email = ?, sdt = ?, diachi = ? WHERE userName = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing the SQL statement');
        }
        $stmt->bind_param('sssss', $name, $email, $sdt, $diachi, $username);

        if ($stmt->execute()) {
            mysqli_close($conn);
?>
            <script>
                alert("Thay đổi thông tin thành công!");
                window.location.replace("index.php");
            </script>
<?php
        } else {
            $errors['general'] = 'Lỗi cập nhật thông tin. Vui lòng thử lại.';
        }
        $stmt->close();
    } else {
        // Xử lý lỗi
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>
