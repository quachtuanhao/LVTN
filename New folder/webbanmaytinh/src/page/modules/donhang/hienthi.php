<?php
    include'../db/connect.php';
    if(isset($_SESSION['dangnhap'])){
        $id=$_SESSION['dangnhap'];
        $sql="SELECT * from dondathang where maKH='$id'";
        $result=mysqli_query($conn,$sql);
        // if(count($kt=mysqli_fetch_row($result))>0){
        ?>
        <div class="tiltle"><p class="content-title">Đơn Hàng</p></div>
        <table class="cart">
            <tr class="cart-list head">
                <td class="cart-item width100"> <b>Mã đơn hàng</b></td>
                <td class="cart-item width150"> <b>Tên khách hàng</b></td>
                <td class="cart-item width100"> <b>Số điện thoại</b></td>
                <td class="cart-item width200"> <b>Địa chỉ</b></td>
                <td class="cart-item width100"> <b>Ngày đặt</b></td>
                <td class="cart-item width200"> <b>Tình trạng</b></td>
                <td class="cart-item width50"> <b>Chi tiết</b></td>
            </tr>
            <?php
            while($row=mysqli_fetch_array($result)){
                $tt=$row['maTT'];
                ?>
            <tr class="cart-list">
                        <td class="cart-item width100"><?php echo $row['maDonDatHang'] ?></td>
                        <td class="cart-item width150"><?php echo $row['tenKhach'] ?></td>
                        <td class="cart-item width100"><?php echo $row['sdtKhach'] ?></td>
                        <td class="cart-item width200"><?php echo $row['diaChiKhach'] ?></td>
                        <td class="cart-item width100"><?php echo $row['ngayDat'] ?></td>
                        <td class="cart-item width200"><?php  $sql1="SELECT * from trangthai where maTrangThai='$tt'";
                                                                 $result1=mysqli_query($conn,$sql1);
                                                                 $row1=mysqli_fetch_array($result1);
                                                                 echo $row1['tenTrangThai'] ?></td>
                        <td class="cart-item width50"><a href="index.php?action=xemchitietdonhang&&id=<?php echo $row['maDonDatHang'] ?>"><i class="fa-solid fa-circle-info"></i></a></td>
             </tr>
                <?php
            };
            ?>
  </table>
        <?php

    }
    else{
        ?>
        <div class="form-empty">
            <img class="form-empty-img" src="../../assets/img/list.jpg" alt="">
            <p>Không có đơn hàng nào</p>
        </div>
        <?php  
    }
?>
