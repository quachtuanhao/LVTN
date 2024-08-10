<?php
include '../../../db/connect.php';
session_start();
if (isset($_SESSION['dangnhap'])) {
    $id_user = $_SESSION['dangnhap'];
}
if (isset($_GET['action'])) {
    $value = $_GET['action'];
    if ($value == 'vanglai') {
        header('location:../../index.php?action=register');
    } else if ($value == $id_user) {
        header('location:../../index.php?action=thongtindonhang');
    }
}
