<?php
    include'./../db/connect.php';
    if(isset($_GET['value']))
    {
        $tam = $_GET['value'];
    }
?>
<div class="content-product">
            <table >
                <tr class="content-product-list">
                    <?php
                        $sql = "SELECT maSanPham,tenSanPham,gia,hinhAnh from sanpham where maNSX = '$tam'";
                        $result = mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($result)){ ?>
                            <td class="content-product-items" >
                                <a class="content-product-item-wrapper" href="./index.php?action=chitietsanpham&&value=<?php echo $row['maSanPham'] ?>">
                                    <img class="content-product-item img"  src="./../../assets/img/<?php echo $row['hinhAnh'] ?>" alt="no">
                                    <b class="content-product-item title"><?php echo $row['tenSanPham'] ?></b>
                                    <p class="content-product-item price"><?php echo number_format($row['gia'],$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></p>
                                </a>
                            </td>
                    <?php
                        }
                    ?>
                </tr> 
            </table>
</div>