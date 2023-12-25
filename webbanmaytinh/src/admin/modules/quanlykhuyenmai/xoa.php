<?php
    include'../././db/connect.php';
    if(isset($_GET['this_id'])){
        $id = $_GET['this_id'];
        $sql = "SELECT * FROM khuyenmai WHERE maKhuyenMai='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        $today = date('Y-m-d');
        // echo $row['ngayKetThuc'];
        // echo $today;
        if(strtotime($row['ngayKetThuc'])<strtotime($today)){
            $sql1 = "DELETE FROM khuyenmai WHERE maKhuyenMai='$id'";
            mysqli_query($conn,$sql1);
            header('location:index.php?action=quanlykhuyenmai&&query=no');
        }
        else{
            ?>
            <script language="javascript">
            alert("Khuyến mãi còn hạn! Không thể xóa");
            window.location = "index.php?action=quanlykhuyenmai&&query=no";
            </script>;
            <?php
        }
    }
    else 
        echo 'Xoa khong thanh cong';
?>