<?php
session_start(); {
    if (isset($_SESSION['dangnhap'])) {
        $id_user = $_SESSION['dangnhap'];
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $value = $_GET['value'];
            if ($action == 'tang') {
                $_SESSION["cart$id_user"][$value]['quantity']++;
                $_SESSION["cart$id_user"][$value]['total'] = $_SESSION["cart$id_user"][$value]['price'] * $_SESSION["cart$id_user"][$value]['quantity'];
            } else if ($action == 'giam') {
                if ($_SESSION["cart$id_user"][$value]['quantity'] > 1) {
                    $_SESSION["cart$id_user"][$value]['quantity']--;
                    $_SESSION["cart$id_user"][$value]['total'] = $_SESSION["cart$id_user"][$value]['price'] * $_SESSION["cart$id_user"][$value]['quantity'];
                }
            }
            header('location:../../index.php?action=xemgiohang');
        } else if (isset($_GET['quantity'])) {
            $sl = $_GET['quantity'];
            if (is_numeric($sl) && $sl > 0) {
                $value = $_GET['value'];
                $_SESSION["cart$id_user"][$value]['quantity'] = $sl;
                $_SESSION["cart$id_user"][$value]['total'] = $_SESSION["cart$id_user"][$value]['price'] * $sl;
                header('location:../../index.php?action=xemgiohang');
            } else {
?>
                <script language="javascript">
                    alert("Phải nhập số và phải lớn hơn 0!");
                    window.location = "../../index.php?action=xemgiohang";
                </script>;
            <?php
            }
        } else {
            echo "Không có !";
        }
    } else {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $value = $_GET['value'];
            if ($action == 'tang') {
                $_SESSION["cart"][$value]['quantity']++;
                $_SESSION["cart"][$value]['total'] = $_SESSION["cart"][$value]['price'] * $_SESSION["cart"][$value]['quantity'];
            } else if ($action == 'giam') {
                if ($_SESSION["cart"][$value]['quantity'] > 1) {
                    $_SESSION["cart"][$value]['quantity']--;
                    $_SESSION["cart"][$value]['total'] = $_SESSION["cart"][$value]['price'] * $_SESSION["cart"][$value]['quantity'];
                }
            }
            header('location:../../index.php?action=xemgiohang');
        } else if (isset($_GET['quantity'])) {
            $sl = $_GET['quantity'];
            if (is_numeric($sl) && $sl > 0) {
                $value = $_GET['value'];
                $_SESSION["cart$id_user"][$value]['quantity'] = $sl;
                $_SESSION["cart$id_user"][$value]['total'] = $_SESSION["cart$id_user"][$value]['price'] * $sl;
                header('location:../../index.php?action=xemgiohang');
            } else {
            ?>
                <script language="javascript">
                    alert("Phải nhập số và phải lớn hơn 0!");
                    window.location = "../../index.php?action=xemgiohang";
                </script>;
<?php
            }
        } else {
            echo "Không có !";
        }
    }
}
