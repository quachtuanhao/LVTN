<?php
    include '../../../db/connect.php';
    session_start();  // Đặt session_start() lên đầu để đảm bảo nó được gọi trước bất kỳ mã nào khác.

    if (isset($_POST['submit'])) {
        if (isset($_GET['idsanpham'])) {
            $masp = $_GET['idsanpham'];
            $soluong = 1;
            $sql = "SELECT * FROM sanpham WHERE maSanPham = '$masp'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            if ($row) {
                // Kiểm tra số lượng sản phẩm
                if ($row['soLuong'] <= 0) {
                    // Hiển thị thông báo nếu số lượng sản phẩm bằng 0
                    echo "<script>alert('Sản phẩm này đã hết. Vui lòng chọn sản phẩm khác nhé !!'); window.location.href='../../index.php';</script>";
                    exit();  // Dừng thực thi mã sau khi hiển thị thông báo
                }

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
                    if (key_exists($row['maSanPham'], $_SESSION["cart$id_user"])) {
                        $_SESSION["cart$id_user"][$row['maSanPham']]['quantity']++;
                        $_SESSION["cart$id_user"][$row['maSanPham']]['total'] = $_SESSION["cart$id_user"][$row['maSanPham']]['quantity'] * $_SESSION["cart$id_user"][$row['maSanPham']]['price'];
                    } else {
                        $_SESSION["cart$id_user"][$row['maSanPham']] = $new_product;
                    }
                } else {
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }
                    if (key_exists($row['maSanPham'], $_SESSION['cart'])) {
                        $_SESSION['cart'][$row['maSanPham']]['quantity']++;
                        $_SESSION['cart'][$row['maSanPham']]['total'] = $_SESSION['cart'][$row['maSanPham']]['quantity'] * $_SESSION['cart'][$row['maSanPham']]['price'];
                    } else {
                        $_SESSION['cart'][$row['maSanPham']] = $new_product;
                    }
                }
            }
        }
        header('location:../../index.php?action=xemgiohang');
    } else {
        echo "Không có sản phẩm nào";
    }
?>
