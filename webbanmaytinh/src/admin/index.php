<?php
    session_start();
    if(isset($_SESSION['dangnhapadmin'])){ ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="Content-Type" content="text/html">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../../assets/css/styleAdmin.css">
            <link rel="stylesheet" href="../../assets/fonts/fontawesome-free-6.0.0-web/css/all.min.css">

            <title>Trang Admin</title>
        </head>
        <body>
            <div class="wrapper">
            <?php 
                include'./modules/header.php';
                ?>
                <div class="main">
                <?php
                include'./modules/menu.php';
                include'./modules/content.php';
                ?>
                </div>
                
                <?php
                include'./modules/footer.php';
            ?>
            </div>
        </body>
        </html>
    <?php } 
    else{
        header('location: ../page/index.php?action=login');
    }
    if(isset($_GET['action'])){
        $tmp=$_GET['action'];
        if($tmp == 'dangxuat'){
            unset($_POST['dangnhapadmin']);
            header('location: ../page/login.php');
            session_destroy();
        }
    }

 ?>
