<?php
include '../././db/connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Nha san xuat</title>
</head>

<body>
    <div class="content-header">
        <h3 class="content-title">Danh Sách Loại Sản Phẩm</h3>
        <button class="btn-add"><a class="title" href="?action=quanlyloaisanpham&&query=them"><i class="icon fa-solid fa-plus"></i>Thêm</a></button>
    </div>
    <table class="content-wrapper" style="min-height: 395px;">
        <tr class="content-list head">
            <td class="content-item width100 head"> <b class="title">Mã loại</b></td>
            <td class="content-item width200 head"> <b class="title">Tên loại sản phẩm</b></td>
            <td class="content-item width100 head"> <b class="title">Thao tác</b></td>
        </tr>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $n = ($page - 1) * 5;
            if ($page == 1) {
                $sql = "SELECT maLoaiSanPham as id,tenLoaiSanPham as ten from loaisanpham order by id ASC limit 0,5 ";
            } else {
                $sql = "SELECT maLoaiSanPham as id,tenLoaiSanPham as ten from loaisanpham order by id ASC limit $n,5 ";
            }
        } else {
            $sql = "SELECT maLoaiSanPham as id,tenLoaiSanPham as ten from loaisanpham order by id ASC limit 0,5 ";
        }
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr class="content-list" style="height:70px">
                <td class="content-item width100"><?php echo $row['id'] ?></td>
                <td class="content-item width200"><?php echo $row['ten'] ?></td>
                <td class="content-item width100 handle">
                    <a class="content-item width50" href="./index.php?action=quanlyloaisanpham&query=sua&this_id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="content-item width50" href="./index.php?action=quanlyloaisanpham&query=xoa&this_id=<?php echo $row['id'] ?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            </tr>


        <?php
        }
        ?>
    </table>
    <?php
    include 'pagination.php';

    ?>
</body>

</html>