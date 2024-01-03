<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../assets/css/style.css">
</head>

<body>
    <form class="form" action="dathang.php" method="POST" enctype="multipart/form-data">
        <div class="form-main">
            <div class="form-title">
                <h1>Thông tin</h1>
            </div>
            <div class="form-content">
                <label class="label">Họ tên</label>
                <input class="text" type="text" name="name">
                <label class="label">Email</label>
                <input class="text" type="text" name="email">
                <label class="label">Số điện thoại</label>
                <input class="text" type="text" name="sdt">
                <label class="label">Địa chỉ</label>
                <input class="text" type="text" name="diachi">
                <input class="submit--shopping" type="submit" name="dathang" value="Đặt hàng">
            </div>
        </div>
    </form>
</body>

</html>