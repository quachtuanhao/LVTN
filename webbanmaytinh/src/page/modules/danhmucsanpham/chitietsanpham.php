<?php
include './../db/connect.php';

// Khởi tạo session nếu chưa được khởi tạo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Lấy giá trị mã sản phẩm từ tham số GET
$tam = isset($_GET['value']) ? $_GET['value'] : null;

// Kiểm tra xem người dùng đã đăng nhập chưa
$user_id = isset($_SESSION['dangnhap']) ? $_SESSION['dangnhap'] : null;

// Xử lý việc gửi bình luận và đánh giá
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_comment']) && $user_id) {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $productId = $tam;

    // Kiểm tra xem người dùng đã mua sản phẩm này và đơn hàng đã hoàn tất không
    $hasPurchasedAndCompleted = false;
    if ($user_id) {
        $sql_check_purchase = "SELECT * FROM dondathang 
                               WHERE maKH = '$user_id' 
                               AND maDonDatHang IN (SELECT maDDH FROM chitietdathang WHERE maSP = '$tam') 
                               AND maTT = 'HT'";
        $result_check_purchase = mysqli_query($conn, $sql_check_purchase);
        if (mysqli_num_rows($result_check_purchase) > 0) {
            $hasPurchasedAndCompleted = true;
        }
    }

    if ($hasPurchasedAndCompleted) {
        // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
        $sql_check_comment = "SELECT * FROM comments WHERE product_id = '$productId' AND user_name = '$user_id'";
        $result_check_comment = mysqli_query($conn, $sql_check_comment);

        if (mysqli_num_rows($result_check_comment) > 0) {
            echo "Bạn đã đánh giá sản phẩm này trước đó.";
        } else {
            // Thực hiện chèn bình luận và đánh giá vào cơ sở dữ liệu
            $insertComment = "INSERT INTO comments (product_id, rating, comment, user_name) VALUES ('$productId', '$rating', '$comment', '$user_id')";
            if (mysqli_query($conn, $insertComment)) {
                echo "Bình luận và đánh giá thành công!";
            } else {
                echo "Lỗi: " . $insertComment . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "Bạn cần mua sản phẩm và đơn hàng phải hoàn tất để đánh giá.";
    }
}
?>

<div class="content-product">
    <div class="title">
        <p class="content-title">Chi Tiết Sản Phẩm</p>
    </div>
    <table>
        <tr class="content-product-list">
            <?php
            if ($tam) {
                // Truy vấn lấy thông tin sản phẩm, nhà sản xuất và loại sản phẩm
                $sql = "SELECT sp.tenSanPham, sp.gia, sp.soLuong, sp.hinhAnh, sp.moTa, lsp.tenLoaiSanPham, nsx.tenNhaSanXuat 
                        FROM sanpham sp 
                        JOIN loaisanpham lsp ON sp.maLSP = lsp.maLoaiSanPham 
                        JOIN nhasanxuat nsx ON sp.maNSX = nsx.maNhaSanXuat 
                        WHERE sp.maSanPham = '$tam'";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $row = mysqli_fetch_array($result);
                    if ($row) {
                        ?>
                        <form class="form" action="./modules/quanlygiohang/them.php?action=themgiohang&&idsanpham=<?php echo $tam; ?>" method="POST">
                            <td class="content-product-items detail">
                                <img class="content-product-item img-detail" style="margin-left: 60px;" src="./../../assets/img/<?php echo $row['hinhAnh']; ?>" alt="no">
                            </td>
                            <td class="content-product-items detail">
                                <p class="content-product-item-detail title"><?php echo 'Tên sản phẩm: ' . $row['tenSanPham']; ?></p>
                                <p class="content-product-item-detail price"><?php echo 'Giá: ' . number_format($row['gia'], 0, ',', '.') . 'đ'; ?></p>
                                <p class="content-product-item-detail title"><?php echo 'Số Lượng: ' . $row['soLuong']; ?></p>
                                <p class="content-product-item-detail description"><?php echo 'Mô tả: ' . $row['moTa']; ?></p>
                                <p class="content-product-item-detail title"><?php echo 'Loại sản phẩm: ' . $row['tenLoaiSanPham']; ?></p>
                                <p class="content-product-item-detail title"><?php echo 'Nhà sản xuất: ' . $row['tenNhaSanXuat']; ?></p>
                                <input class="content-product-item submit" style="margin-left: 150px;" type="submit" name="submit" value="Thêm vào giỏ hàng">
                            </td>
                        </form>
                        <?php
                    } else {
                        echo "Sản phẩm không tồn tại.";
                    }
                } else {
                    echo "Lỗi khi lấy chi tiết sản phẩm: " . mysqli_error($conn);
                }
            } else {
                echo "Không có mã sản phẩm.";
            }
            ?>
        </tr>
    </table>

    <!-- Bình luận và đánh giá sản phẩm -->
    <div class="comments-section">
        <h2>Bình luận và đánh giá sản phẩm</h2>
        <?php if ($user_id): ?>
            <form action="" method="POST">
                <label for="rating">Đánh giá:</label>
                <select name="rating" id="rating" required>
                    <option value="1">1 sao</option>
                    <option value="2">2 sao</option>
                    <option value="3">3 sao</option>
                    <option value="4">4 sao</option>
                    <option value="5">5 sao</option>
                </select><br>
                <label for="comment">Bình luận:</label><br>
                <textarea name="comment" id="comment" rows="4" cols="50" required></textarea><br>
                <input type="submit" name="submit_comment" value="Gửi đánh giá">
            </form>
        <?php else: ?>
            <p>Bạn cần đăng nhập để đánh giá sản phẩm.</p>
        <?php endif; ?>
    </div>

    <!-- Hiển thị bình luận và đánh giá -->
    <div class="display-comments">
        <h3>Các bình luận:</h3>
        <?php
        if ($tam) {
            $fetchComments = "SELECT c.rating, c.comment, t.hoTen FROM comments c JOIN taikhoan t ON c.user_name = t.userName WHERE c.product_id = '$tam'";
            $commentsResult = mysqli_query($conn, $fetchComments);

            if ($commentsResult) {
                while ($commentRow = mysqli_fetch_array($commentsResult)) {
                    echo "<p>Đánh giá: " . $commentRow['rating'] . " sao</p>";
                    echo "<p>Bình luận: " . $commentRow['comment'] . "</p>";
                    echo "<p>Người dùng: " . $commentRow['hoTen'] . "</p><hr>";
                }
            } else {
                echo "Lỗi khi lấy bình luận: " . mysqli_error($conn);
            }
        } else {
            echo "Không có mã sản phẩm.";
        }
        ?>
    </div>
</div>
