<?php
    $password="";
    $newPassword="";
    $confirmPassword="";

    if(isset($_POST['doi'])){
        $username = $_SESSION['dangnhap'];
        $password = $_POST['password'];
        $newPassword= $_POST['newPassword'];
        $confirmPassword=$_POST['confirmPassword'];
        $errors=[];
        $pass="";
        $newPass="";
        if(empty($password)){
            $errors['password']['required']='Password không được bỏ trống';
        }
        else {
            $pass=md5($password);
            $sql2="SELECT password from taikhoan where userName='$username'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_array($result2);
            if(!empty($row2)){
                if($row2['password']!==$pass)
                $errors['password']['trung']='Password không đúng';
            }
        }
        if(empty($newPassword)){
            $errors['newPassword']['required']='Mật khẩu mới không được bỏ trống';
        }
        if(empty($confirmPassword)){
            $errors['confirmPassword']['required']='Không được bỏ trống';
        }
        if($newPassword!==$confirmPassword)
        {
            $errors['confirmPassword']['trung']='Không giống nhau';
        }
        if(count($errors)==0){
            $newPass=md5($newPassword);
            $sql = "UPDATE taikhoan set password='$newPass' where userName = '$username'";
            mysqli_query($conn,$sql);
            mysqli_close($conn);
            header('location: ./index.php');
        }
    }
?>

    <form class="form" action="./index.php?action=doimatkhau" method="POST" enctype="multipart/form-data">
        <div class="form-main">
            <div class="form-title">
                <h1>Đổi mật khẩu</h1>
            </div>
            <div class="form-content">
                <label class="label" >Mật khẩu hiện tại</label>
                <input class="text" type="password" name="password" value="<?php echo $password?>">
                <?php echo (!empty($errors['password']['required']))?"<span
                class='message-error'>".$errors['password']['required']."</span>":false?>
                <?php echo (!empty($errors['password']['trung']))?"<span
                class='message-error'>".$errors['password']['trung']."</span>":false?>
                <label class="label" >Mật khẩu mới</label>
                <input class="text" type="password" name="newPassword" value="<?php echo $newPassword?>">
                <?php echo (!empty($errors['newPassword']['required']))?"<span
                class='message-error'>".$errors['newPassword']['required']."</span>":false?>
                <label class="label" >Xác nhận mật khẩu</label>
                <input class="text" type="password" name="confirmPassword" value="<?php echo $confirmPassword?>">
                <?php echo (!empty($errors['confirmPassword']['required']))?"<span
                class='message-error'>".$errors['confirmPassword']['required']."</span>":false?>
                <?php if(empty($errors['confirmPassword']['required'])) echo (!empty($errors['confirmPassword']['trung']))?"<span
                class='message-error'>".$errors['confirmPassword']['trung']."</span>":false?>
                <input class="submit--update" type="submit" name="doi" value="Lưu thay đổi">
            </div>
        </div>
    </form>
