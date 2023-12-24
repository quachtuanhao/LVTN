<?php 
    include'../db/connect.php';
?>
    <div class="tiltle"><p class="content-title">Khuyến mãi</p></div>
    <table class="cart" >
    <tr class="cart-list">
        <td class="cart-item width150"><b>Mã khuyến mãi</b> </td>
        <td class="cart-item width150"><b>Tên khuyến mãi</b></td>
        <td class="cart-item width100"><b>Ngày bắt đầu</b></td>
        <td class="cart-item width100"><b>Ngày kết thúc</b></td>
        <td class="cart-item width150"><b>Giá trị khuyến mãi</b></td>
    </tr>
    <?php 
        $sql = "SELECT maKhuyenMai,tenKhuyenMai,ngayBatDau,ngayKetThuc,giaTriKhuyenMai
        from khuyenmai";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
        ?>
            <tr class="cart-list">
                <td class="cart-item width150"><?php echo $row['maKhuyenMai'] ?></td>
                <td class="cart-item width150"><?php echo $row['tenKhuyenMai'] ?></td>
                <td class="cart-item width100"><?php echo $row['ngayBatDau'] ?></td>
                <td class="cart-item width100"><?php echo $row['ngayKetThuc'] ?></td>
                <td class="cart-item width150"><?php echo $row['giaTriKhuyenMai'] ?></td>
            </tr>
            
    <?php
         }
         mysqli_close($conn);
    ?>
</table>

