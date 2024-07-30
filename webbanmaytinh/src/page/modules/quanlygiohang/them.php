<?php
include '../../../db/connect.php';
session_start();

if (isset($_POST['submit'])) {
    if (isset($_GET['idsanpham'])) {
        $masp = $_GET['idsanpham'];
        $soluong = 1;

        // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT * FROM sanpham WHERE maSanPham = '$masp'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        if ($row) {
            // Kiểm tra số lượng sản phẩm
            if ($row['soLuong'] <= 0) {
                // Hiển thị thông báo lỗi và không chuyển hướng
                echo "<script>
                    alert('Sản phẩm đã hết. Vui lòng chọn sản phẩm khác.');
                    window.location.href = document.referrer; // Trở về trang trước đó
                </script>";
                exit(); // Dừng thực hiện tiếp tục để tránh thêm sản phẩm vào giỏ hàng
            }

            // Nếu sản phẩm còn hàng, tiếp tục xử lý thêm vào giỏ hàng
            $new_product = array(
                'id' => $row['maSanPham'],
                'img' => $row['hinhAnh'],
                'name' => $row['tenSanPham'],
                'price' => $row['gia'],
                'quantity' => $soluong,
                'total' => $row['gia'] * $soluong
            );

            if (isset($_SESSION['dangnhap'])) {
                $id_user = $_SESSION['dangnhap'];
                if (!isset($_SESSION["cart$id_user"])) {
                    $_SESSION["cart$id_user"] = [];
                }
                $id = $new_product['id'];
                if (key_exists($id, $_SESSION["cart$id_user"])) {
                    $_SESSION["cart$id_user"][$id]['quantity']++;
                    $_SESSION["cart$id_user"][$id]['total'] = $_SESSION["cart$id_user"][$id]['quantity'] * $_SESSION["cart$id_user"][$id]['price'];
                } else {
                    $_SESSION["cart$id_user"][$id] = $new_product;
                }
            } else {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                $id = $new_product['id'];
                if (key_exists($id, $_SESSION['cart'])) {
                    $_SESSION['cart'][$id]['quantity']++;
                    $_SESSION['cart'][$id]['total'] = $_SESSION['cart'][$id]['quantity'] * $_SESSION['cart'][$id]['price'];
                } else {
                    $_SESSION['cart'][$id] = $new_product;
                }
            }
        } else {
            echo "<script>
                alert('Sản phẩm không tồn tại.');
                window.location.href = document.referrer; // Trở về trang trước đó
            </script>";
        }
        exit(); // Dừng thực hiện tiếp tục để tránh thêm sản phẩm vào giỏ hàng
    } else {
        echo "<script>
            alert('Không có mã sản phẩm.');
            window.location.href = document.referrer; // Trở về trang trước đó
        </script>";
    }
}
?>
