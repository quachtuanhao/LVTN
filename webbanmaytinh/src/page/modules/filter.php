<?php
include '../db/connect.php';
?>
<div class="filter">
    <form class="form-5" action="./index.php?action=nsx" >
    <input type="hidden" name="action" value="nsx"></input>
        <select class="text" name="loaiSP">
            <option value="0" >Tìm kiếm sản phẩm theo phân loại </option>
            <?php
            $sql = "SELECT maLoaiSanPham as id, tenLoaiSanPham as ten from loaisanpham";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['ten'] ?></option>
            <?php
            }
            ?>
        </select>

        <input type="submit" name="submit" value="Tìm">

    </form>
</div>