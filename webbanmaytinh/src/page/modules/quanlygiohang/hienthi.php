<?php
    // session_start();
    if(isset($_SESSION['dangnhap'])){
        $id_user=$_SESSION['dangnhap'];
        $_SESSION["km1$id_user"]=0;
        $_SESSION["km2$id_user"]=0;
        if(isset($_POST['submit'])){
            $id_sp=$_GET['id'];
            $maKM=$_POST['text'];
            $sql="SELECT * from khuyenmai join loaikhuyenmai on maLKM=maLoai where maKhuyenMai = '$maKM'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result);
            if(count($row)>0){
                if($row['maLoai']=='KM1'&&$_SESSION["km1$id_user"]==0){
                    $_SESSION["cart$id_user"][$id_sp]['total']-=$row['giaTriKhuyenMai'] ;
                    $_SESSION["km1$id_user"]++;
                }
                else if($row['maLoai']=='KM2'&&$_SESSION["km2$id_user"]==0){
                    $_SESSION["cart$id_user"][$id_sp]['total']-=$_SESSION["cart$id_user"][$id_sp]['total']*$row['giaTriKhuyenMai']/100;
                    $_SESSION["km2$id_user"]++;
                }
            }
            else
            echo 'no';
        }
        if(isset($_SESSION["cart$id_user"])&&count($_SESSION["cart$id_user"])>0){
            ?>
        <div class="tiltle"><p class="content-title">Giỏ Hàng</p></div>
        <table class="cart">
            <tr class="cart-list head">
                <td class="cart-item width100">Sản phẩm</td>
                <td class="cart-item width100">Tên sản phẩm</td>
                <td class="cart-item width100">Đơn giá</td>
                <td class="cart-item width100">Số Lượng</td>
                <td class="cart-item width100">Số tiền</td>
                <td class="cart-item width100">Thao tác</td>
                
            </tr>
        <?php
        foreach($_SESSION["cart$id_user"] as $k => $v){
            ?>
            <tr class="cart-list">
                <td class="cart-item width100"> <img src="../../assets/img/<?php echo $v['img'] ?>" alt=""> </td>
                <td class="cart-item width100"><?php echo $v['name'] ?></td>
                <td class="cart-item width100"><?php echo number_format($v['price'],$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></td>
                <td class="cart-item width100">
                    <div class="handle_quantity">
                    <a class="quantity" href="./modules/quanlygiohang/chinhsuasoluong.php?action=giam&&value=<?php echo $k ?>"><i class="fa-solid fa-minus"></i></a>
                        <p class="quantity"><?php echo $v['quantity'] ?></p>
                        <a class="quantity" href="./modules/quanlygiohang/chinhsuasoluong.php?action=tang&&value=<?php echo $k ?>"><i class="fa-solid fa-plus"></i></a>
                    </div> 
                </td>
                <td class="cart-item width100"><?php echo number_format($v['total'],$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></td>
                <td class="cart-item width100">
                    <a href="./modules/quanlygiohang/xoa.php?value=<?php echo $v['id'] ?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
        </table>
        <div class="submit">
            <button class="submit--shopping"><a class="title" href="modules/dathang/themdonhang.php?action=<?php echo $id_user ?>">Mua hàng</a></button>
        </div>
        <?php
        }
        else{
            ?>
            <div class="form-empty">
                <img class="form-empty-img" src="../../assets/img/cart-empty.png" alt="">
                <p>Không có sản phẩm nào</p>
            </div>
            <?php
        }  
    }
    else if(isset($_SESSION['cart'])&&count($_SESSION['cart'])>0){?>
        <table class="cart">
            <tr class="cart-list head">
                <td class="cart-item head width100">Sản phẩm</td>
                <td class="cart-item head width100">Tên sản phẩm</td>
                <td class="cart-item head width100">Đơn giá</td>
                <td class="cart-item head width100">Số Lượng</td>
                <td class="cart-item head width100">Số tiền</td>
                <td class="cart-item head width100">Thao tác</td>
            </tr>
        <?php
        foreach($_SESSION['cart'] as $k => $v){
            ?>
            <tr class="cart-list">
                <td class="cart-item width100"> <img src="../../assets/img/<?php echo $v['img'] ?>" alt=""> </td>
                <td class="cart-item width100"><?php echo $v['name'] ?></td>
                <td class="cart-item width100"><?php echo number_format($v['price'],$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></td>
                <td class="cart-item width100">
                    <div class="handle_quantity">
                        <a class="quantity" href="./modules/quanlygiohang/chinhsuasoluong.php?action=giam&&value=<?php echo $k ?>"><i class="fa-solid fa-minus"></i></a>
                        <p class="quantity"><?php echo $v['quantity'] ?></p>
                        <a class="quantity" href="./modules/quanlygiohang/chinhsuasoluong.php?action=tang&&value=<?php echo $k ?>"><i class="fa-solid fa-plus"></i></a>
                    </div> </td>
                <td class="cart-item width100"><?php echo number_format($v['total'],$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></td>
                <td class="cart-item width100">
                <a href="./modules/quanlygiohang/xoa.php?value=<?php echo $v['id'] ?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
        </table>
        <p><b>Tổng tiền: <?php 
        $tong=0;
        foreach($_SESSION['cart'] as $k => $v){
            $tong=$tong+$v['price']*$v['quantity'];
        }echo number_format($tong,$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></b></p>
        <div class="submit">
            <button class="submit--shopping"><a class="title" href="modules/dathang/themdonhang.php?action=vanglai">Mua hàng</a></button>
        </div>
        <?php
    }
    else{
        ?>
        <div class="form-empty">
            <img class="form-empty-img" src="../../assets/img/cart-empty.png" alt="">
            <p>Không có sản phẩm nào</p>
        </div>
        <?php
    }
?>
