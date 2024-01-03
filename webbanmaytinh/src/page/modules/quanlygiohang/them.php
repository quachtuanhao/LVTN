<?php
include '../../../db/connect.php';
if (isset($_POST['submit'])) {
    if (isset($_GET['idsanpham'])) {
        $masp = $_GET['idsanpham'];
        $soluong = 1;
        $sql = "SELECT * from sanpham where maSanPham = '$masp'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row) {
            $new_product = array('id' => $row['maSanPham'], 'img' => $row['hinhAnh'], 'name' => $row['tenSanPham'], 'price' => $row['gia'], 'quantity' => $soluong, 'total' => $row['gia'] * $soluong);
        }
        session_start();
        if (isset($_SESSION['dangnhap'])) {
            $id_user = $_SESSION['dangnhap'];
            if (!isset($_SESSION["cart$id_user"])) {
                $_SESSION["cart$id_user"] = [];
                $_SESSION["cart$id_user"][$row['maSanPham']] = $new_product;
            } else {
                $id = $new_product['id'];
                if (key_exists($id, $_SESSION["cart$id_user"])) {
                    $_SESSION["cart$id_user"][$id]['quantity']++;
                    $_SESSION["cart$id_user"][$id]['total'] = $_SESSION["cart$id_user"][$id]['quantity'] * $_SESSION["cart$id_user"][$id]['price'];
                } else {
                    $_SESSION["cart$id_user"][$id] = $new_product;
                }
            }
        } else {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
                $_SESSION['cart'][$row['maSanPham']] = $new_product;
            } else {
                $id = $new_product['id'];
                echo $id;
                if (key_exists($id, $_SESSION['cart'])) {
                    $_SESSION['cart'][$id]['quantity']++;
                    $_SESSION['cart'][$id]['total'] = $_SESSION['cart'][$id]['quantity'] * $_SESSION['cart'][$id]['price'];
                } else {
                    $_SESSION['cart'][$id] = $new_product;
                }
            }
        }
    }
    header('location:../../index.php?action=xemgiohang');
    // var_dump($_SESSION['cart']);
} else {
    echo "không có sản phẩm nào";
}
