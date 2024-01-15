<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-free-6.0.0-web/css/all.min.css">
    <title>Trang Chủ</title>
</head>

<body>
    <div class="wrapper">
        <?php
        include './modules/header.php';
        ?>
        <div class="menu">
            <?php
            include './modules/menu.php';
            ?>
        </div>
        <div class="main">
            <?php
            include './modules/sidebar.php';
            include './modules/content.php';
            ?>
        </div>

        <?php
        include './modules/footer.php';
        ?>
    </div>
</body>

</html>