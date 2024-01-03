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
        <h3 class="content-title">Danh Sách Nhà Sản Xuất</h3>
        <button class="btn-add"><a class="title" href="?action=quanlynhasanxuat&&query=them"><i class="icon fa-solid fa-plus"></i>Thêm</a></button>
    </div>
    <table class="content-wrapper">
        <tr class="content-list head">
            <td class="content-item width100 head"> <b class="title">STT</b></td>
            <td class="content-item width200 head"> <b class="title">Tên nhà sản xuất</b></td>
            <td class="content-item width400 head"> <b class="title">Trụ sở chính</b></td>
            <td class="content-item width100 head"> <b class="title">Thao tác</b></td>
        </tr>
        <?php
        $sql = "SELECT maNhaSanXuat as id,tenNhaSanXuat as ten ,truSoChinh as truSo from nhasanxuat";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr class="content-list">
                <td class="content-item width100"><?php echo $row['id'] ?></td>
                <td class="content-item width200"><?php echo $row['ten'] ?></td>
                <td class="content-item width400"><?php echo (string)$row['truSo'] ?></td>
                <td class="content-item width100 handle">
                    <a class="content-item width50" href="./index.php?action=quanlynhasanxuat&query=sua&this_id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="content-item width50" href="./index.php?action=quanlynhasanxuat&query=xoa&this_id=<?php echo $row['id'] ?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            </tr>


        <?php
        }
        mysqli_close($conn);
        ?>
    </table>
</body>

</html>