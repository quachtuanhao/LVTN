<?php
include './../db/connect.php';
if (isset($_POST['search'])) {
    $search = $_POST['text'];
?>
    <table>
        <tr class="content-product-list">
            <?php
            $sql = "SELECT maSanPham,tenSanPham,gia,hinhAnh from sanpham where tenSanPham like '%$search%'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) { ?>
                <td class="content-product-items">
                    <a class="content-product-item-wrapper" href="./index.php?action=chitietsanpham&&value=<?php echo $row['maSanPham'] ?>">
                        <img class="content-product-item img" src="./../../assets/img/<?php echo $row['hinhAnh'] ?>" alt="no" style="height: 250px; width: 250px">
                        <p class="content-product-item title" style=" height: 40px"><?php echo $row['tenSanPham'] ?></p>
                        <p class="content-product-item price"><?php echo number_format($row['gia'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></p>
                    </a>
                </td>
            <?php
            }
            ?>
        </tr>
    </table>
<?php
} else {
?>
    <div class="content-product">
        <table>
            <tr class="content-product-list">
                <?php
                $sql = "SELECT maSanPham,tenSanPham,gia,hinhAnh from sanpham limit 0,10";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) { ?>
                    <td class="content-product-items">
                        <a class="content-product-item-wrapper" href="./index.php?action=chitietsanpham&&value=<?php echo $row['maSanPham'] ?>">
                            <img class="content-product-item img" src="./../../assets/img/<?php echo $row['hinhAnh'] ?>" alt="no" style="height: 250px; width: 250px">
                            <p class="content-product-item title" style=" height: 40px"><?php echo $row['tenSanPham'] ?></p>
                            <p class="content-product-item price"><?php echo number_format($row['gia'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></p>
                        </a>
                    </td>
                <?php
                }
                ?>
            </tr>
        </table>
    </div>
<?php
} 
?>