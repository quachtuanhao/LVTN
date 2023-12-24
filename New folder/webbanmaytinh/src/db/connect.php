<?php 
    $server="localhost";
    $username="root";
    $password="";
    $database="dbbanmaytinh";
    $conn = mysqli_connect($server,$username,$password,$database);
    header("Content-type: text/html; charset=utf-8");
    mysqli_set_charset($conn, 'UTF8');
?>