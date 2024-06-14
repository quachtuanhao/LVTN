<?php
include '../db/connect.php';
$username = "";
$password = "";
$name = "";
$email = "";
$sdt = "";
$diachi = "";

if (isset($_POST['dangky'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];

    $errors = [];
    if (empty($username)) {
        $errors['username']['required'] = 'Username không được bỏ trống';
        
    } else {
        $sql1 = "SELECT userName from taikhoan where userName='$username'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_row($result1);
        if (!empty($row1)) {
            $errors['username']['trung'] = 'Username đã tồn tại';
        }
    }
    if(strpos($username,' ')){
        $errors['username']['required'] = 'Username không được có khoảng trắng';
    }
    $pattern = '/[^a-zA-Z0-9]/'; 
    if(preg_match($pattern, $username)){
        $errors['username']['required'] = 'Username không được có ký tự đặc biệt';
    }
    if (empty($password)) {
        $errors['password']['required'] = 'Password không được bỏ trống';
    } else if (strlen($password) < 6) {
        $errors['password']['min'] = 'Password phải lớn hơn 6 ký tự';
    }
    if (empty($name)) {
        $errors['name']['required'] = 'Họ tên không được bỏ trống';
    } else if (strlen($name) < 6) {
        $errors['name']['min'] = 'Họ tên phải lớn hơn 6 ký tự';
    }
    if (empty($email)) {
        $errors['email']['required'] = 'Email không được bỏ trống';
    } else if (!filter_var(($email), FILTER_VALIDATE_EMAIL)) {
        $errors['email']['invalid'] = 'Email không hợp lệ';
    }
    if (empty($sdt)) {
        $errors['sdt']['required'] = 'Số điện thoại không được bỏ trống';
    } else if (!is_numeric($sdt)) {
        $errors['sdt']['invalid'] = 'Số điện thoại phải là số';
    } else if (strlen($sdt) < 10) {
        $errors['sdt']['min'] = 'Số điện thoại phải lớn hơn 10 ký tự';
    }
    if (empty($diachi)) {
        $errors['diachi']['required'] = 'Địa chỉ không được bỏ trống';
    }
    if (count($errors) == 0) {
        $pass = md5($password);
        $sql = "INSERT INTO taikhoan(userName,password,hoTen,email,sdt,diachi,maCV) 
            values('$username','$pass','$name','$email','$sdt','$diachi','CV02') ";
        mysqli_query($conn, $sql);
?>
        <script language="javascript">
            alert("Đăng ký tài khoản thành công!");
            window.location = "index.php?action=login";
        </script>;
<?php
    } else {
    }
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form class="form" action="index.php?action=register" method="POST" enctype="multipart/form-data">
        <div class="form-main">
            <div class="form-title">
                <h1>Đăng Ký</h1>
            </div>
            <div class="form-content">
                <label class="label">Username</label>
                <input class="text" type="text" name="username" value="<?php echo $username ?>">
                <?php echo (!empty($errors['username']['required'])) ? "<span
                class='message-error'>" . $errors['username']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['username']['trung'])) ? "<span
                class='message-error'>" . $errors['username']['trung'] . "</span>" : false ?>
                <label class="label">Password</label>
                <input class="text" type="password" name="password" value="<?php echo $password ?>">
                <?php echo (!empty($errors['password']['required'])) ? "<span
                class='message-error'>" . $errors['password']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['password']['min'])) ? "<span
                class='message-error'>" . $errors['password']['min'] . "</span>" : false ?>
                <label class="label">Họ tên</label>
                <input class="text" type="text" name="name" value="<?php echo $name ?>">
                <?php echo (!empty($errors['name']['required'])) ? "<span
                class='message-error'>" . $errors['name']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['name']['min'])) ? "<span
                class='message-error'>" . $errors['name']['min'] . "</span>" : false ?>
                <label class="label">Email</label>
                <input class="text" type="text" name="email" value="<?php echo $email ?>">
                <?php echo (!empty($errors['email']['required'])) ? "<span
                class='message-error'>" . $errors['email']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['email']['invalid'])) ? "<span
                class='message-error'>" . $errors['email']['invalid'] . "</span>" : false ?>
                <label class="label">Số điện thoại</label>
                <input class="text" type="text" name="sdt" value="<?php echo $sdt ?>">
                <?php echo (!empty($errors['sdt']['required'])) ? "<span
                class='message-error'>" . $errors['sdt']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['sdt']['invalid'])) ? "<span
                class='message-error'>" . $errors['sdt']['invalid'] . "</span>" : false ?>
                <?php echo (!empty($errors['sdt']['min'])) ? "<span
                class='message-error'>" . $errors['sdt']['min'] . "</span>" : false ?>
                <label class="label">Địa chỉ</label>
                <input class="text" type="text" name="diachi" value="<?php echo $diachi ?>">
                <?php echo (!empty($errors['diachi']['required'])) ? "<span
                class='message-error'>" . $errors['diachi']['required'] . "</span>" : false ?>
                <input class="submit--register" type="submit" name="dangky" value="Đăng ký">
            </div>
        </div>
    </form>
</body>

</html>