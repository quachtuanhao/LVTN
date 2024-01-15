<div class="filter">
    <form class="form-5" action="./index.php?action=nsx">
        <input type="hidden" name="action" value="nsx"></input>
        <select class="text" name="loaiSP" style="height: 30px;padding:5px;margin:0 0 20px 20px;cursor: pointer;border:1px solid #ccc;border-radius:4px">
            <option value="no">Loại sản phẩm</option>
            <?php
            $sql = "SELECT maLoaiSanPham as id,tenLoaiSanPham as ten from loaiSanPham";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?php echo $row['id'] ?>" <?php if (isset($_GET['loaiSP']) && $_GET['loaiSP'] == $row['id']) {
                                                                echo 'selected';
                                                            } ?>><?php echo $row['ten'] ?></option>
            <?php
            }
            ?>
        </select>
        <select class="text" name="hang" style="height: 30px;padding:5px;margin:0 0 20px 10px;cursor: pointer;border:1px solid #ccc;border-radius:4px">
            <option value="no">Hãng</option>
            <?php
            $sql = "SELECT maNhaSanXuat as id,tenNhaSanXuat as ten from nhasanxuat";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?php echo $row['id'] ?>" <?php if (isset($_GET['hang']) && $_GET['hang'] == $row['id']) {
                                                                echo 'selected';
                                                            } ?>><?php echo $row['ten'] ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="Lọc" style="cursor: pointer;height: 30px;padding:5px;margin-left:10px">
    </form>
</div>