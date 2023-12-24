
<?php 
    include'./../db/connect.php';
?>
<div class="sidebar">
    <ul class="sidebar-list">
       
    </ul>
    <ul class="sidebar-list">
        <!-- <li><div class="sidebar-list-title">Hãng sản xuất</div></li> -->
    <?php 
        $sql = "SELECT maNhaSanXuat,tenNhaSanXuat from nhasanxuat";
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){?>
            <li class="sidebar-list-item"> <a class="sidebar-list-item-link" href="./index.php?action=nsx&&value=<?php echo $row['maNhaSanXuat'] ?>"><?php echo $row['tenNhaSanXuat'] ?></a> </li>
    <?php
        }
    ?>
        <!-- <li> <a href="./index.php?action=apple">Apple</a> </li>
        <li> <a href="./index.php?action=oppo">Oppo</a></li> -->
    </ul>
</div>