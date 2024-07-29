<?php
include '../../../db/connect.php';

session_start();
if (isset($_SESSION['dangnhap'])) {
    $id_user = $_SESSION['dangnhap'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $value = $_GET['value'];
        
        // Lấy số lượng hiện có của sản phẩm
        $sql = "SELECT soLuong FROM sanpham WHERE maSanPham='$value'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $soluong = $row['soLuong'];
        
        if ($action == 'tang') {
            if ($_SESSION["cart$id_user"][$value]['quantity'] < $soluong) {
                $_SESSION["cart$id_user"][$value]['quantity']++;
                $_SESSION["cart$id_user"][$value]['total'] = $_SESSION["cart$id_user"][$value]['price'] * $_SESSION["cart$id_user"][$value]['quantity'];
                header('location:../../index.php?action=xemgiohang');
            } else {
                echo "<script language='javascript'>
                        alert('Số lượng giới hạn là $soluong !!!');
                        window.location = '../../index.php?action=xemgiohang';
                      </script>";
            }
        } else if ($action == 'giam') {
            if ($_SESSION["cart$id_user"][$value]['quantity'] > 1) {
                $_SESSION["cart$id_user"][$value]['quantity']--;
                $_SESSION["cart$id_user"][$value]['total'] = $_SESSION["cart$id_user"][$value]['price'] * $_SESSION["cart$id_user"][$value]['quantity'];
                header('location:../../index.php?action=xemgiohang');
            } else {
                echo "<script language='javascript'>
                        alert('Số lượng tối thiểu phải là 1 !!!');
                        window.location = '../../index.php?action=xemgiohang';
                      </script>";
            }
        }
    } else if (isset($_GET['quantity'])) {
        $sl = $_GET['quantity'];
        $id = $_GET['value'];
        
        $sql = "SELECT soLuong FROM sanpham WHERE maSanPham='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $soluong = $row['soLuong'];
        
        if (is_numeric($sl) && $sl > 0 && $sl <= $soluong) {
            $value = $_GET['value'];
            $_SESSION["cart$id_user"][$value]['quantity'] = $sl;
            $_SESSION["cart$id_user"][$value]['total'] = $_SESSION["cart$id_user"][$value]['price'] * $sl;
            header('location:../../index.php?action=xemgiohang');
        } else if ($sl <= 0) {
            echo "<script language='javascript'>
                    alert('Phải nhập số và phải lớn hơn 0 !!!');
                    window.location = '../../index.php?action=xemgiohang';
                  </script>";
        } else if ($sl > $soluong) {
            echo "<script language='javascript'>
                    alert('Số lượng giới hạn là $soluong !!!');
                    window.location = '../../index.php?action=xemgiohang';
                  </script>";
        }
    } else {
        echo "Không có hành động nào!";
    }
} else {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $value = $_GET['value'];
        
        // Lấy số lượng hiện có của sản phẩm
        $sql = "SELECT soLuong FROM sanpham WHERE maSanPham='$value'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $soluong = $row['soLuong'];
        
        if ($action == 'tang') {
            if ($_SESSION["cart"][$value]['quantity'] < $soluong) {
                $_SESSION["cart"][$value]['quantity']++;
                $_SESSION["cart"][$value]['total'] = $_SESSION["cart"][$value]['price'] * $_SESSION["cart"][$value]['quantity'];
                header('location:../../index.php?action=xemgiohang');
            } else {
                echo "<script language='javascript'>
                        alert('Số lượng giới hạn là $soluong !!!');
                        window.location = '../../index.php?action=xemgiohang';
                      </script>";
            }
        } else if ($action == 'giam') {
            if ($_SESSION["cart"][$value]['quantity'] > 1) {
                $_SESSION["cart"][$value]['quantity']--;
                $_SESSION["cart"][$value]['total'] = $_SESSION["cart"][$value]['price'] * $_SESSION["cart"][$value]['quantity'];
                header('location:../../index.php?action=xemgiohang');
            } else {
                echo "<script language='javascript'>
                        alert('Số lượng tối thiểu phải là 1 !!!');
                        window.location = '../../index.php?action=xemgiohang';
                      </script>";
            }
        }
    } else if (isset($_GET['quantity'])) {
        $sl = $_GET['quantity'];
        $id = $_GET['value'];
        
        $sql = "SELECT soLuong FROM sanpham WHERE maSanPham='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $soluong = $row['soLuong'];
        
        if (is_numeric($sl) && $sl > 0 && $sl <= $soluong) {
            $value = $_GET['value'];
            $_SESSION["cart"][$value]['quantity'] = $sl;
            $_SESSION["cart"][$value]['total'] = $_SESSION["cart"][$value]['price'] * $sl;
            header('location:../../index.php?action=xemgiohang');
        } else if ($sl <= 0) {
            echo "<script language='javascript'>
                    alert('Phải nhập số và phải lớn hơn 0 !!!');
                    window.location = '../../index.php?action=xemgiohang';
                  </script>";
        } else if ($sl > $soluong) {
            echo "<script language='javascript'>
                    alert('Số lượng giới hạn là $soluong !!!');
                    window.location = '../../index.php?action=xemgiohang';
                  </script>";
        }
    } else {
        echo "Không có hành động nào!";
    }
}
?>
