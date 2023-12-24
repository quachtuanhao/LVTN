<?php
    session_start();
    if(isset($_SESSION['dangnhap'])){
        $id_user=$_SESSION['dangnhap'];
        if(isset($_SESSION["cart$id_user"])){
            if(isset($_GET['value'])){
                $id = $_GET['value'];
                unset($_SESSION["cart$id_user"][$id]);
                header('location:../../index.php?action=xemgiohang');
            }
        }
    }
    else if(isset($_SESSION['cart'])){
        if(isset($_GET['value'])){
            $id = $_GET['value'];
            unset($_SESSION['cart'][$id]);
            header('location:../../index.php?action=xemgiohang');
        }
    }
?>