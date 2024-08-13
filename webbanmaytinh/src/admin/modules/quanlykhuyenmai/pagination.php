<div style="width: 100%;display:flex;justify-content:center">
    <div class="pagination" style="width:600px;height:30px;margin:20px 0;display:flex;">
        <div class="prev" style="flex-grow: 1;">
            <?php if (isset($_GET['page']) && $_GET['page'] > 1) { ?>
                <a href="./index.php?action=quanlykhuyenmai&query=no&page=<?php echo $_GET['page'] - 1; ?>"
                   style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer;
                          border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">&laquo; Prev</a>
            <?php } ?>
        </div>
        <div class="" style="flex-grow: 8;">
            <div style="display: flex;flex-direction:row">
                <?php
                // Câu truy vấn để đếm tổng số khuyến mãi
                $sql = "SELECT count(maKhuyenMai) FROM khuyenmai";
                $result = mysqli_query($conn, $sql);
                
                // Kiểm tra xem câu truy vấn có thành công không
                if (!$result) {
                    echo "Query failed: " . mysqli_error($conn);
                    exit;
                }

                $sl = mysqli_fetch_row($result);
                $totalPromotions = (int)$sl[0];
                $limit = 5; // Số lượng khuyến mãi hiển thị trên mỗi trang
                $max = ceil($totalPromotions / $limit);

                // Xác định phạm vi của trang hiển thị
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = max(1, $page - 5);  // Giảm xuống còn 5 trang phía trước
                $end = min($max, $start + 9); // 9 thay vì 19 để tổng số trang hiển thị là 10

                // Điều chỉnh lại $start nếu $end gần với cuối
                if ($end - $start < 9) {  // Giảm khoảng cách để phù hợp với 10 trang
                    $start = max(1, $end - 9);
                }

                for ($i = $start; $i <= $end; $i++) {
                ?>
                    <a href="./index.php?action=quanlykhuyenmai&query=no&page=<?php echo $i ?>"
                       style="margin: 0 5px;height:30px;width:30px;display:flex;justify-content:center;align-items:center;cursor:pointer;
                              border:1px solid #ccc;border-radius:4px;
                    <?php if (isset($_GET['page']) && $_GET['page'] == $i) {
                        echo 'background-color: #ddd';
                    } ?>"><?php echo $i ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="next" style="flex-grow: 1;">
            <?php if (isset($_GET['page']) && $_GET['page'] < $max) { ?>
                <a href="./index.php?action=quanlykhuyenmai&query=no&page=<?php echo $_GET['page'] + 1; ?>"
                   style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer;
                          border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">Next &raquo;</a>
            <?php } ?>
        </div>
    </div>
</div>
