<?php 
    include'../././db/connect.php';
?>
<div class="content-header">
    <h3 class="content-title">Danh Sách Khuyến Mãi</h3>
    <button class="btn-add"><a class="title" href="?action=quanlykhuyenmai&&query=them"><i class="icon fa-solid fa-plus"></i>Thêm</a></button>

</div>
<table class="content-wrapper">
    <tr class="content-list head">
        <td class="content-item width150 head"><b>Mã khuyến mãi</b> </td>
        <td class="content-item width150 head"><b>Tên khuyến mãi</b></td>
        <td class="content-item width100 head"><b>Ngày bắt đầu</b></td>
        <td class="content-item width100 head"><b>Ngày kết thúc</b></td>
        <td class="content-item width150 head"><b>Loại khuyến mãi </b></td>
        <td class="content-item width150 head"><b>Giá trị khuyến mãi</b></td>
        <td class="content-item width100 head"><b>Thao tác</b></td>
    </tr>
    <?php 
        $sql = "SELECT maKhuyenMai,tenKhuyenMai,ngayBatDau,ngayKetThuc,giaTriKhuyenMai,tenLoai 
        from khuyenmai join loaikhuyenmai
        on khuyenmai.maLKM=loaikhuyenmai.maLoai";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
        ?>
            <tr class="content-list">
                <td class="content-item width150"><?php echo $row['maKhuyenMai'] ?></td>
                <td class="content-item width150"><?php echo $row['tenKhuyenMai'] ?></td>
                <td class="content-item width100"><?php echo $row['ngayBatDau'] ?></td>
                <td class="content-item width100"><?php echo $row['ngayKetThuc'] ?></td>
                <td class="content-item width150"><?php echo $row['tenLoai'] ?></td>
                <td class="content-item width150"><?php 
                                                         echo $row['giaTriKhuyenMai'] ;
                                                ?>
                </td>
                <td class="content-item width100"> 
                    <a class="content-item width50" href="?action=quanlysanpham&query=sua&this_id=<?php echo $row['maKhuyenMai']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="content-item width50" href="?action=quanlysanpham&&query=xoa&&this_id=<?php echo $row['maKhuyenMai']?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            </tr>
            
    <?php
         }
         mysqli_close($conn);
    ?>
</table>
