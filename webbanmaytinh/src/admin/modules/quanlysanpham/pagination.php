<div style="width: 100%; display: flex; justify-content: center;">
    <div class="pagination" style="width: 600px; height: 30px; margin: 20px 0; display: flex;">
        <div class="prev" style="flex-grow: 1;">
            <?php if ($page > 1) { ?>
                <a href="?action=quanlysanpham&query=search&page=<?php echo $page - 1; ?>&text=<?php echo urlencode($searchText); ?>" 
                   style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer; 
                          border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">&laquo; Prev</a>
            <?php } ?>
        </div>
        <div class="" style="flex-grow: 8;">
            <div style="display: flex; flex-direction: row;">
                <?php
                $sql = "SELECT COUNT(maSanPham) FROM sanpham 
                        JOIN nhasanxuat ON sanpham.maNSX = nhasanxuat.maNhaSanXuat 
                        JOIN loaisanpham ON sanpham.maLSP = loaisanpham.maLoaiSanPham 
                        $searchCondition";
                $result = mysqli_query($conn, $sql);
                $sl = mysqli_fetch_row($result);
                $totalItems = (int)$sl[0];
                $limit = 5; // Số lượng sản phẩm hiển thị trên mỗi trang
                $max = ceil($totalItems / $limit);

                // Xác định phạm vi của trang hiển thị
                $start = max(1, $page - 5);
                $end = min($max, $start + 9);

                // Điều chỉnh lại $start nếu $end gần với cuối
                if ($end - $start < 9) {
                    $start = max(1, $end - 9);
                }

                for ($i = $start; $i <= $end; $i++) {
                ?>
                    <a href="?action=quanlysanpham&query=search&page=<?php echo $i; ?>&text=<?php echo urlencode($searchText); ?>" 
                       style="margin: 0 5px; height: 30px; width: 30px; display: flex; justify-content: center; align-items: center; cursor: pointer; 
                              border: 1px solid #ccc; border-radius: 4px;
                       <?php if ($page == $i) {
                           echo 'background-color: #ddd';
                       } ?>"><?php echo $i; ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="next" style="flex-grow: 1;">
            <?php if ($page < $max) { ?>
                <a href="?action=quanlysanpham&query=search&page=<?php echo $page + 1; ?>&text=<?php echo urlencode($searchText); ?>" 
                   style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer; 
                          border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">Next &raquo;</a>
            <?php } ?>
        </div>
    </div>
</div>
