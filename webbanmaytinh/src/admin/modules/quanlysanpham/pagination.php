<div style="width: 100%; display: flex; justify-content: center;">
    <div class="pagination" style="width: 600px; height: 30px; margin: 20px 0; display: flex;">
        <div class="prev" style="flex-grow: 1;">
            <?php if ($page > 1) { ?>
                <a href="?action=quanlysanpham&query=search&page=<?php echo $page - 1; ?>&text=<?php echo urlencode($searchText); ?>" style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer; border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">&laquo; Prev</a>
            <?php } ?>
        </div>
        <div class="" style="flex-grow: 8;">
            <div style="display: flex; flex-direction: row;">
                <?php
                $sql = "SELECT COUNT(maSanPham) FROM sanpham 
                        JOIN nhasanxuat ON sanpham.maNSX=nhaSanXuat.maNhaSanXuat 
                        JOIN loaisanpham ON sanpham.maLSP=loaisanpham.maLoaiSanPham 
                        $searchCondition";
                $result = mysqli_query($conn, $sql);
                $sl = mysqli_fetch_row($result);
                $totalItems = (int)$sl[0];
                $max = ceil($totalItems / $limit);

                for ($i = 1; $i <= $max; $i++) {
                ?>
                    <a href="?action=quanlysanpham&query=search&page=<?php echo $i; ?>&text=<?php echo urlencode($searchText); ?>" style="margin: 0 5px; height: 30px; width: 30px; display: flex; justify-content: center; align-items: center; cursor: pointer; border: 1px solid #ccc; border-radius: 4px;
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
                <a href="?action=quanlysanpham&query=search&page=<?php echo $page + 1; ?>&text=<?php echo urlencode($searchText); ?>" style="display: block; height: 30px; line-height: 30px; text-align: center; cursor: pointer; border: 1px solid #ccc; border-radius: 4px; margin: 0 5px;">Next &raquo;</a>
            <?php } ?>
        </div>
    </div>
</div>
