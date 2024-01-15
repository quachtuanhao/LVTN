<?php
include './../db/connect.php';
if (isset($_GET['value'])) {
    $tam = $_GET['value'];
}
include './modules/filter.php';

?>
<div class="content-product">
    <table>
        <tr class="content-product-list">
            <?php
            $sql = "SELECT maSanPham,tenSanPham,gia,hinhAnh from sanpham where maNSX = '$tam'";
            $result = mysqli_query($conn, $sql);
            if (isset($_GET['loaiSP']) && isset($_GET['hang']) && $_GET['loaiSP'] != 'no'  && $_GET['hang'] != 'no') {
                $loai = $_GET['loaiSP'];
                $hang = $_GET['hang'];
                $sql = "SELECT maSanPham,tenSanPham,gia,hinhAnh from sanpham where maLSP = '$loai' and maNSX like '$hang' ";
                $result = mysqli_query($conn, $sql);
            } else if (isset($_GET['loaiSP']) && $_GET['loaiSP'] != 'no') {
                $loai = $_GET['loaiSP'];
                $sql = "SELECT maSanPham,tenSanPham,gia,hinhAnh from sanpham where  maLSP like '$loai' ";
                $result = mysqli_query($conn, $sql);
            } else if (isset($_GET['hang']) && $_GET['hang'] != 'no') {
                $hang = $_GET['hang'];
                $sql = "SELECT maSanPham,tenSanPham,gia,hinhAnh from sanpham where maNSX like '$hang' ";
                $result = mysqli_query($conn, $sql);
            }
            while ($row = mysqli_fetch_array($result)) { ?>
                <td class="content-product-items">
                    <a class="content-product-item-wrapper" href="./index.php?action=chitietsanpham&&value=<?php echo $row['maSanPham'] ?>">
                        <img class="content-product-item img" src="./../../assets/img/<?php echo $row['hinhAnh'] ?>" alt="no">
                        <b class="content-product-item title" style=" height: 40px"><?php echo $row['tenSanPham'] ?></b>
                        <p class="content-product-item price"><?php echo number_format($row['gia'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></p>
                    </a>
                </td>
            <?php
            }
            ?>
        </tr>
    </table>
</div>