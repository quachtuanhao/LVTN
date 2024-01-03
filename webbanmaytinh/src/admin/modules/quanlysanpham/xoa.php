<?php
include '../././db/connect.php';
if (isset($_GET['this_id'])) {
    $id = $_GET['this_id'];
    $sql = "DELETE FROM sanpham WHERE maSanPham='$id'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php?action=quanlysanpham&&query=no');
} else
    echo 'Xoa khong thanh cong';
