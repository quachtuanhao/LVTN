<?php
    include'../././db/connect.php';
    if(isset($_GET['this_id'])){
        $id = $_GET['this_id'];
        $sql1 = "SELECT maKH FROM dondathang WHERE maKH='$id'";
        $result = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_array($result);
        if(empty($row)){
            $sql = "DELETE FROM taikhoan WHERE userName='$id'";
            mysqli_query($conn,$sql);
            mysqli_close($conn);
            header('location:index.php?action=quanlytaikhoan&&query=no');
        }
        else{
            ?>
            <script language="javascript">
            alert("Tài khoản có đơn hàng! Không thể xóa");
            window.location = "index.php?action=quanlytaikhoan&&query=no";
            </script>;
            <?php
        }
    }
    else 
        echo 'Xoa khong thanh cong';
?>