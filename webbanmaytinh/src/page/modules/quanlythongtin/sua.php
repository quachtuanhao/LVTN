<?php
if (isset($_POST['sua'])) {
    session_start();
    include '../../../db/connect.php';
    $username = $_SESSION['dangnhap'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $sql = "UPDATE taikhoan set hoTen = '$name', email='$email', sdt='$sdt',diachi ='$diachi' where userName = '$username'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
    <script>
        alert("Thay đổi thông tin thành công!");
        window.location.replace("index.php");
    </script>
<?php
}
?>