<?php
    if(isset($_GET['action'])){
        $tmp = $_GET['action'];
    }
    else{
        $tmp='';
    }
    if($tmp == 'dangxuat'){
        session_start();
        unset($_SESSION['dangnhap']);
        // session_destroy();
        header('location:../../index.php');
    }
    else{
        
    }
?>