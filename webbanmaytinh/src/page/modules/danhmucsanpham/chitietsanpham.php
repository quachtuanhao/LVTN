<?php
include './../db/connect.php';

// Khởi tạo session nếu chưa được khởi tạo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Lấy giá trị mã sản phẩm từ tham số GET
$tam = isset($_GET['value']) ? $_GET['value'] : null;

// Kiểm tra xem người dùng đã đăng nhập chưa
$userName = isset($_SESSION['dangnhap']) ? $_SESSION['dangnhap'] : null;

// Xử lý việc gửi bình luận và đánh giá
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_comment'])) {
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
    $comment = $_POST['comment'];
    $productId = $tam;

    if (!$rating) {
        echo "Vui lòng chọn đánh giá sao.";
    } else {
        // Kiểm tra xem người dùng đã mua sản phẩm này và đơn hàng đã hoàn tất không
        $hasPurchasedAndCompleted = false;
        if ($userName) {
            $sql_get_maKH = "SELECT maKH FROM dondathang 
                             WHERE maKH IN (SELECT userName FROM taikhoan WHERE userName = '$userName') 
                             AND maDonDatHang IN (SELECT maDDH FROM chitietdathang WHERE maSP = '$tam') 
                             AND maTT = 'HT'";
            $result_check_purchase = mysqli_query($conn, $sql_get_maKH);
            if (mysqli_num_rows($result_check_purchase) > 0) {
                $hasPurchasedAndCompleted = true;
            }
        }

        if ($hasPurchasedAndCompleted) {
            // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
            $sql_check_comment = "SELECT * FROM comments WHERE maSP = '$productId' AND maKH = (SELECT maKH FROM taikhoan WHERE userName = '$userName')";
            $result_check_comment = mysqli_query($conn, $sql_check_comment);

            if (mysqli_num_rows($result_check_comment) > 0) {
                echo "Bạn đã đánh giá sản phẩm này trước đó.";
            } else {
                // Thực hiện chèn bình luận và đánh giá vào cơ sở dữ liệu
                $insertComment = "INSERT INTO comments (maSP, rating, comment, maKH) VALUES ('$productId', '$rating', '$comment', (SELECT maKH FROM taikhoan WHERE userName = '$userName'))";
                if (mysqli_query($conn, $insertComment)) {
                    echo "Bình luận và đánh giá thành công!";
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Bạn cần mua sản phẩm và đơn hàng phải hoàn tất để đánh giá.";
        }
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
                        <form class="form" id="addToCartForm" action="./modules/quanlygiohang/them.php?action=themgiohang&&idsanpham=<?php echo $tam; ?>" method="POST" onsubmit="return handleAddToCart();">
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

                        <script>
                        function handleAddToCart() {
                            var isLoggedIn = "<?php echo $userName; ?>";

                            if (!isLoggedIn) {
                                alert("Bạn hãy đăng ký và đăng nhập tài khoản để có thể mua hàng nhé !!!");
                                window.location.href = './index.php?action=register';
                                return false;
                            }

                            // Nếu đã đăng nhập, cho phép gửi form
                            return true;
                        }
                        </script>

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
        <?php if ($userName): ?>
            <form action="" method="POST">
                <label for="rating">Đánh giá:</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 sao">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 sao">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 sao">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 sao">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 sao">&#9733;</label>
                </div><br>
                <label for="comment">Bình luận:</label><br>
                <textarea name="comment" id="comment" rows="4" cols="50"></textarea><br>
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
            $fetchComments = "SELECT c.rating, c.comment, tk.hoTen, c.created_at 
                              FROM comments c 
                              JOIN taikhoan tk ON c.maKH = tk.userName 
                              WHERE c.maSP = '$tam'";
            $commentsResult = mysqli_query($conn, $fetchComments);

            if ($commentsResult) {
                while ($commentRow = mysqli_fetch_array($commentsResult)) {
                    echo "<p>Đánh giá: " . str_repeat('&#9733;', $commentRow['rating']) . "</p>";
                    if (!empty($commentRow['comment'])) {
                        echo "<p>Bình luận: " . htmlspecialchars($commentRow['comment']) . "</p>";
                    }
                    echo "<p>Người dùng: " . htmlspecialchars($commentRow['hoTen']) . "</p>";
                    echo "<p>Thời gian: " . htmlspecialchars($commentRow['created_at']) . "</p><hr>";
                }
            } else {
                echo "Lỗi khi lấy bình luận: " . mysqli_error($conn);
            }
        }
        ?>
    </div>
</div>

<style>
.rating {
    direction: rtl;
    display: inline-block;
}
.rating input[type="radio"] {
    display: none;
}
.rating label {
    color: #d3d3d3;
    font-size: 2em;
    cursor: pointer;
}
.rating input[type="radio"]:checked ~ label {
    color: #ffcc00;
}
.rating input[type="radio"]:checked ~ label ~ label {
    color: #d3d3d3;
}
.rating input[type="radio"]:hover ~ label,
.rating input[type="radio"]:checked ~ label,
.rating input[type="radio"]:checked ~ label ~ label {
    color: #ffcc00;
}
</style>
