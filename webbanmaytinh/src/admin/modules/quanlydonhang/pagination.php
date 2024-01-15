<div style="width: 100%;display:flex;justify-content:center">
    <div class="pagination" style="width:600px;height:30px;margin:20px 0;display:flex;">
        <div class="prev" style="flex-grow: 1;"></div>
        <div class="" style="flex-grow: 8;">
            <div style="display: flex;flex-direction:row">
                <?php
                $sql = "SELECT count(maDonDatHang) from dondathang";
                $result = mysqli_query($conn, $sql);
                $sl = mysqli_fetch_row($result);
                $max = ceil((int)$sl[0] / 5);
                for ($i = 1; $i <= $max; $i++) {
                ?>
                    <a href="./index.php?action=quanlydonhang&query=no&page=<?php echo $i ?>" style="margin: 0 5px;height:30px;width:30px;display:flex;justify-content:center;align-items:center;cursor:pointer;border:1px solid #ccc;border-radius:4px;
                    <?php if (isset($_GET['page']) && $_GET['page'] == $i) {
                        echo 'background-color: #ddd';
                    } ?>"><?php echo $i ?></a>
                <?php
                } ?>
            </div>
        </div>
        <div class="next" style="flex-grow: 1;"></div>
    </div>
</div>