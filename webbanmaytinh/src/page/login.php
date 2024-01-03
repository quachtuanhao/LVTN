<?php
include '../db/connect.php';
$username = "";
$password = "";
if (isset($_POST['dangnhap'])) {
    // session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $errors = [];
    $pass = "";
    if (empty($username)) {
        $errors['username']['required'] = 'Username không được bỏ trống';
    } else {
        $sql1 = "SELECT userName from taikhoan where userName='$username'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_row($result1);
        if (empty($row1)) {
            $errors['username']['trung'] = 'Username không tồn tại';
        }
        // else{
        //     $errors['username']['trung']='';
        // }
    }
    if (empty($password)) {
        $errors['password']['required'] = 'Password không được bỏ trống';
    } else {
        $pass = md5($password);
        $sql2 = "SELECT password from taikhoan where userName='$username'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        if (!empty($row2)) {
            if ($row2['password'] !== $pass)
                $errors['password']['trung'] = 'Password không đúng';
        }
        // else{
        //     $errors['username']['trung']='';
        // }
    }
    if (count($errors) == 0) {
        $sql = "SELECT userName,password,hoTen,maCV from taikhoan where taikhoan.userName ='$username' and taikhoan.password='$pass'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            if ($row['maCV'] == 'CV02') {
                header('location:index.php');
                $_SESSION['dangnhap'] = $username;
            } else if ($row['maCV'] == 'CV01') {
                header('location: ../admin/index.php');
                $_SESSION['dangnhapadmin'] = $username;
            }
        }
    }
}
?>

<form class="form" action="index.php?action=login" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Đăng nhập</h1>
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
            <?php echo (!empty($errors['password']['trung'])) ? "<span
                class='message-error'>" . $errors['password']['trung'] . "</span>" : false ?>
            <input class="submit--login" type="submit" name="dangnhap" value="Đăng nhập">
        </div>
    </div>
</form>