<?php
include './../db/connect.php';
if (isset($_GET['value'])) {
    $tam = $_GET['value'];
}
?>
<div class="content-product">
    <div class="tiltle">
        <p class="content-title">Chi Tiết Sản Phẩm</p>
    </div>
    <table>
        <tr class="content-product-list">
            <?php
            $sql = "SELECT tenSanPham,gia,hinhAnh,ram,dungLuong,pin,moTa,maNSX,maLSP from sanpham where maSanPham = '$tam'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result) ?>
            <form class="form" action="./modules/quanlygiohang/them.php?action=themgiohang&&idsanpham=<?php echo $tam ?>" method="POST">
                <?php if ($row['maLSP'] == 'LSP01') {
                ?>
                    <td class="content-product-items detail">
                        <img class="content-product-item img-detail" style="margin-left: 60px;" src="./../../assets/img/<?php echo $row['hinhAnh'] ?>" alt="no">
                    </td>
                    <td class="content-product-items detail">
                        <p class="content-product-item-detail title"><?php echo 'Tên sản phẩm : ' . $row['tenSanPham'] ?></p>
                        <p class="content-product-item-detail price"><?php echo 'Giá :' . number_format($row['gia'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></p>
                        <p class="content-product-item-detail title"><?php echo 'RAM : ' . $row['ram'] ?></p>
                        <p class="content-product-item-detail title"><?php echo 'Dung lượng : ' . $row['dungLuong'] ?></p>
                        <p class="content-product-item-detail title"><?php echo 'PIN : ' . $row['pin'] ?></p>
                        <p class="content-product-item-detail description"><?php echo 'Mô tả :' . $row['moTa'] ?></p>
                        <input class="content-product-item submit" style="margin-left: 150px;" type="submit" name="submit" value="Thêm vào giỏ hàng">
                    </td>
                <?php
                } else { ?>
                    <td class="content-product-items detail">
                        <img class="content-product-item img-detail" style="margin-left: 60px;" src="./../../assets/img/<?php echo $row['hinhAnh'] ?>" alt="no">
                    </td>
                    <td class="content-product-items detail">
                        <p class="content-product-item-detail title"><?php echo 'Tên sản phẩm : ' . $row['tenSanPham'] ?></p>
                        <p class="content-product-item-detail price"><?php echo 'Giá :' . number_format($row['gia'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></p>
                        <p class="content-product-item-detail description"><?php echo 'Mô tả :' . $row['moTa'] ?></p>
                        <input class="content-product-item submit" style="margin-left: 150px;" type="submit" name="submit" value="Thêm vào giỏ hàng">
                    </td>
                <?php
                }  ?>

            </form>
            <?php

            ?>
        </tr>
    </table>
</div>