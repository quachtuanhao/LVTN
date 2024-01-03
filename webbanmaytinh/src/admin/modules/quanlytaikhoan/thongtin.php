<?php
include '../././db/connect.php';
if (isset($_GET['this_id'])) {
    $username = $_GET['this_id'];
}
if (isset($_POST['sua'])) {
    // session_start();
    // echo "y";
    // $username = $_GET['this_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $errors = [];
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
        $sql = "UPDATE taikhoan set hoTen = '$name', email='$email', sdt='$sdt',diachi ='$diachi' where userName = '$username'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: ./index.php?action=quanlytaikhoan&&query=no');
    }
}
?>

<form class="form" action="./index.php?action=quanlytaikhoan&&query=sua&&this_id=<?php echo $username ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Thông tin tài khoản</h1>
        </div>
        <div class="form-content">
            <?php
            if (isset($_GET['this_id'])) {
                // $username = $_GET['this_id'];
                $sql = "SELECT hoTen,email,sdt,diachi from taikhoan where userName='$username'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) { ?>
                    <label class="label">Họ tên</label>
                    <input class="text" type="text" name="name" value="<?php $us = isset($name) ? $name : $row['hoTen'];
                                                                        echo $us ?>">
                    <?php echo (!empty($errors['name']['required'])) ? "<span
                            class='message-error'>" . $errors['name']['required'] . "</span>" : false ?>
                    <?php echo (!empty($errors['name']['min'])) ? "<span
                            class='message-error'>" . $errors['name']['min'] . "</span>" : false ?>
                    <label class="label">Email</label>
                    <input class="text" type="text" name="email" value="<?php $em = isset($email) ? $email : $row['email'];
                                                                        echo $em ?>">
                    <?php echo (!empty($errors['email']['required'])) ? "<span
                            class='message-error'>" . $errors['email']['required'] . "</span>" : false ?>
                    <?php echo (!empty($errors['email']['invalid'])) ? "<span
                            class='message-error'>" . $errors['email']['invalid'] . "</span>" : false ?>
                    <label class="label">Số điện thoại</label>
                    <input class="text" type="text" name="sdt" value="<?php $dt = isset($sdt) ? $sdt : $row['sdt'];
                                                                        echo $dt ?>">
                    <?php echo (!empty($errors['sdt']['required'])) ? "<span
                            class='message-error'>" . $errors['sdt']['required'] . "</span>" : false ?>
                    <?php echo (!empty($errors['sdt']['invalid'])) ? "<span
                            class='message-error'>" . $errors['sdt']['invalid'] . "</span>" : false ?>
                    <?php echo (!empty($errors['sdt']['min'])) ? "<span
                            class='message-error'>" . $errors['sdt']['min'] . "</span>" : false ?>
                    <label class="label">Địa chỉ</label>
                    <input class="text" type="text" name="diachi" value="<?php $dc = isset($diachi) ? $diachi : $row['diachi'];
                                                                            echo $dc ?>">
                    <?php echo (!empty($errors['diachi']['required'])) ? "<span
                            class='message-error'>" . $errors['diachi']['required'] . "</span>" : false ?>
                    <input class="submit--update" type="submit" name="sua" value="Cập nhật">
            <?php }
            }
            ?>

        </div>
    </div>
</form>