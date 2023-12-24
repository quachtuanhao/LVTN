<?php 
    include'../././db/connect.php';
?>
<div class="content-header">
    <h3 class="content-title">Danh Sách Tài Khoản</h3>
</div>
<table class="content-wrapper">
    <tr class="content-list head">
        <td class="content-item width100 head"><b>User Name</b></td>
        <td class="content-item width100 head"><b>Password</b></td>
        <td class="content-item width100 head"><b>Họ tên</b></td>
        <td class="content-item width150 head"><b>Email</b></td>
        <td class="content-item width100 head"><b>SĐT</b></td>
        <td class="content-item width100 head"><b>Địa chỉ</b></td>
        <td class="content-item width100 head"><b>Chức vụ</b></td>
        <td class="content-item width100 head"><b>Thao tác</b></td>

    </tr>
    <?php 
        $sql = "SELECT userName as user,password as pass,hoTen as ten,email,sdt,diachi,chucvu.tenChucVu as chucvu 
        FROM taikhoan JOIN chucvu
        on taikhoan.maCV=chucvu.maChucVu";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
        ?>
            <tr class="content-list">
                <td class="content-item width100"><?php echo $row['user'] ?></td>
                <td class="content-item width100"><?php echo $row['pass'] ?></td>
                <td class="content-item width100"><?php echo $row['ten'] ?></td>
                <td class="content-item width150"><?php echo $row['email'] ?></td>
                <td class="content-item width100"><?php echo $row['sdt'] ?></td>
                <td class="content-item width100"><?php echo $row['diachi'] ?></td>
                <td class="content-item width100"><?php echo $row['chucvu'] ?></td>
                <td class="content-item width100"> 
                    <a class="content-item width50" href="?action=quanlytaikhoan&query=sua&this_id=<?php echo $row['user']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="content-item width50" href="?action=quanlytaikhoan&query=xoa&&this_id=<?php echo $row['user']?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            </tr>
            
    <?php
         }
         mysqli_close($conn);
    ?>
</table>
<!-- <button><a href="?action=quanlysanpham&&query=them">Thêm</a></button> -->
