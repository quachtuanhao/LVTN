<?php
include '../././db/connect.php';
?>
<div class="content-header">
    <h3 class="content-title">Danh Sách Sản Phẩm</h3>
    <button class="btn-add"><a class="title" href="?action=quanlysanpham&&query=them"><i class="icon fa-solid fa-plus"></i>Thêm</a></button>
</div>
<table class="content-wrapper" style="min-height: 395px;">
    <tr class="content-list head">
        <td class="content-item width100 head"> <b>Mã sản phẩm</b> </td>
        <td class="content-item width200 head"><b>Tên sản phẩm</b></td>
        <td class="content-item width100 head"><b>Giá</b></td>
        <td class="content-item width100 head"><b>Số lượng</b></td>
        <td class="content-item width100 head"><b>Hình ảnh</b></td>
        <td class="content-item width150 head"><b>Mô tả</b></td>
        <td class="content-item width100 head"><b>Nhà sản xuất</b></td>
        <td class="content-item width100 head"><b>Thao tác</b></td>

    </tr>
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $n = ($page - 1) * 5;
        if ($page == 1) {
            $sql = "SELECT maSanPham as id,tenSanPham as ten,gia,soLuong,hinhAnh as img,moTa,
            tenNhaSanXuat as tenNSX from sanpham join nhasanxuat
            on sanpham.maNSX=nhaSanXuat.maNhaSanXuat order by id ASC limit 0,5 ";
        } else {
            $sql = "SELECT maSanPham as id,tenSanPham as ten,gia,soLuong,hinhAnh as img,moTa,
        tenNhaSanXuat as tenNSX from sanpham join nhasanxuat
        on sanpham.maNSX=nhaSanXuat.maNhaSanXuat order by id ASC limit $n,5 ";
        }
    } else {
        $sql = "SELECT maSanPham as id,tenSanPham as ten,gia,soLuong,hinhAnh as img,moTa,
        tenNhaSanXuat as tenNSX from sanpham join nhasanxuat
        on sanpham.maNSX=nhaSanXuat.maNhaSanXuat order by id ASC limit 0,5 ";
    }
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr class="content-list" style="height: 70px;">
            <td class="content-item width100"><?php echo $row['id'] ?></td>
            <td class="content-item width200"><?php echo $row['ten'] ?></td>
            <td class="content-item width100"><?php echo number_format($row['gia'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
            <td class="content-item width100"><?php echo $row['soLuong'] ?></td>
            <td class="content-item width100"><img src="../../././assets/img/<?php echo $row['img'] ?> " alt="img"></td>
            <td class="content-item width150" style="height: 100%;overflow-y: hidden; max-height: 3em;
            overflow: hidden;text-overflow: ellipsis;"><?php echo $row['moTa'] ?></td>
            <td class="content-item width100"><?php echo $row['tenNSX'] ?></td>
            <td class="content-item width100">
                <a class="content-item width50" href="?action=quanlysanpham&query=sua&this_id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="content-item width50" href="?action=quanlysanpham&&query=xoa&&this_id=<?php echo $row['id'] ?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
            </td>
        </tr>

    <?php
    }
    ?>
</table>
<?php
include 'pagination.php';
?>