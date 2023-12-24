<?php
    include'../././db/connect.php';
    if(isset($_GET['this_id'])){
        $this_id = $_GET['this_id'];
    }
    if(isset($_POST['submit'])){
        if(isset($_GET['this_id'])){
            $id = $_GET['this_id'];
        }
        $ten = $_POST['ten'];
        $gia = $_POST['gia'];
        $errors=[];
        if(isset($_FILES['anh'])){
            $anh=$_FILES['anh']['name'];
        }
        $moTa = $_POST['mota'];
        $nsx = $_POST['hang'];
        if(empty($ten)){
            $errors['ten']['required']='Tên sản phẩm không được bỏ trống';
        }
        if(empty($gia)){
            $errors['gia']['required']='Giá không được bỏ trống';
        }
        else if(!is_numeric($gia)){
            $errors['gia']['invalid']='Giá phải là số';
        }
        if(empty($anh)){
            $errors['anh']['required']='Chưa chọn ảnh';
        }
        if(count($errors)==0){  
            $sql = "UPDATE sanpham set tenSanPham='$ten', gia=$gia ,hinhAnh='$anh' ,moTa='$moTa' ,maNSX='$nsx'
            where maSanPham='$id'";
            mysqli_query($conn,$sql);
            mysqli_close($conn);
            header('location: ./index.php?action=quanlysanpham&&query=no');
        }
    }
?>

    <form class="form" action="./index.php?action=quanlysanpham&&query=sua&&this_id=<?php echo $this_id?>" method="POST" enctype="multipart/form-data">
        <div class="form-main">
            <div class="form-title">
                <h1>Sửa thông tin sản phẩm</h1>
            </div>
            <div class="form-content">
                <?php 
                    $sql = "SELECT maSanPham as ma,tenSanPham as ten,gia,hinhAnh,moTa,maNSX 
                    from sanpham where maSanPham='$this_id'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_array($result)){
                    ?>
                        
                        <label class="label">Mã sản phẩm</label>
                        <input class="text" type="text" name="ma" value="<?php echo $row['ma'] ?>" disabled>
                        <label class="label" >Tên sản phẩm</label>
                        <input class="text" type="text" name="ten" value="<?php echo (!empty($ten)?$ten:$row['ten'])?>">
                        <?php echo (!empty($errors['ten']['required']))?"<span
                        class='message-error'>".$errors['ten']['required']."</span>":false?>
                        <label class="label">Giá</label>
                        <input class="text" type="text" name="gia" value="<?php echo (!empty($gia)?$gia:$row['gia']) ?>">
                        <?php echo (!empty($errors['gia']['required']))?"<span
                        class='message-error'>".$errors['gia']['required']."</span>":false?>
                        <?php echo (!empty($errors['gia']['invalid']))?"<span
                        class='message-error'>".$errors['gia']['invalid']."</span>":false ?>
                        <label class="label">Ảnh</label>
                        <input type="file" name="anh" >
                        <?php echo (!empty($errors['anh']['required']))?"<span
                        class='message-error'>".$errors['anh']['required']."</span>":false?>
                        <label class="label">Mô tả</label>
                        <input class="text" type="text" name="mota" value="<?php echo (!empty($moTa)?$gia:$row['moTa'])?>">
                        <?php $ma = $row['maNSX'] ?>
                        <label class="label">Nhà sản xuất</label>
                    <?php
                    
                    }
                ?>
                
                <select name="hang" id="Hang">
                <?php
                    $sql = "SELECT maNhaSanXuat as id,tenNhaSanXuat as ten from nhasanxuat";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row['id'] ?>" <?php 
                            if($ma==$row['id']){
                                echo 'selected';
                            }
                     ?>>
                    <?php echo $row['ten']?></option>
                    
                    <?php
                    }
                    ?>
                </select>
                <input class="submit" type="submit" name="submit" value="Lưu">
            </div>
            
        </div>
        
    </form>

