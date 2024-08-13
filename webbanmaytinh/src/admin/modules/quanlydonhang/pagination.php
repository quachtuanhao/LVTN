<div style="width: 100%; display: flex; justify-content: center;">
    <div class="pagination" style="width: 600px; height: 30px; margin: 20px 0; display: flex;">
        <div class="prev" style="flex-grow: 1;">
            <?php if (isset($_GET['page']) && $_GET['page'] > 1) { ?>
                <a href="./index.php?action=quanlydonhang&query=no&page=<?php echo $_GET['page'] - 1; ?>" 
                   style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer; 
                          border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">&laquo; Prev</a>
            <?php } ?>
        </div>
        <div class="" style="flex-grow: 8;">
            <div style="display: flex; flex-direction: row;">
                <?php
                $sql = "SELECT COUNT(maDonDatHang) FROM dondathang";
                $result = mysqli_query($conn, $sql);
                $sl = mysqli_fetch_row($result);
                $totalOrders = (int)$sl[0];
                $limit = 5; // Số lượng đơn hàng hiển thị trên mỗi trang
                $max = ceil($totalOrders / $limit);
                
                // Xác định phạm vi của trang hiển thị
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = max(1, $page - 5);
                $end = min($max, $start + 9);

                // Điều chỉnh lại $start nếu $end gần với cuối
                if ($end - $start < 9) {
                    $start = max(1, $end - 9);
                }

                for ($i = $start; $i <= $end; $i++) {
                ?>
                    <a href="./index.php?action=quanlydonhang&query=no&page=<?php echo $i; ?>" 
                       style="margin: 0 5px; height: 30px; width: 30px; display: flex; justify-content: center; align-items: center; cursor: pointer; 
                              border: 1px solid #ccc; border-radius: 4px;
                       <?php if (isset($_GET['page']) && $_GET['page'] == $i) {
                           echo 'background-color: #ddd';
                       } ?>"><?php echo $i; ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="next" style="flex-grow: 1;">
            <?php if (isset($_GET['page']) && $_GET['page'] < $max) { ?>
                <a href="./index.php?action=quanlydonhang&query=no&page=<?php echo $_GET['page'] + 1; ?>" 
                   style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer; 
                          border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">Next &raquo;</a>
            <?php } ?>
        </div>
    </div>
</div>
