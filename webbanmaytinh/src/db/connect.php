<?php 
    $server="localhost";
    $username="root";
    $password="";
    $database="dbbanmaytinh";
    $conn = mysqli_connect($server,$username,$password,$database);
    mysqli_set_charset($conn, 'UTF8');
?>