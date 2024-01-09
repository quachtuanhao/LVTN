<?php
include '../././db/connect.php';
if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
}
if (isset($_POST['submit'])) {
    if (isset($_GET['this_id'])) {
        $id = $_GET['this_id'];
    }
    $ten = $_POST['ten'];
    $ngayBatDau = $_POST['ngayBatDau'];
    $ngayKetThuc = $_POST['ngayKetThuc'];
    $maLKM = $_POST['maLKM'];
    $giaTriKhuyenMai = $_POST['giaTriKhuyenMai'];
    $errors = [];
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên khuyến mãi không được bỏ trống';
    }
    if (count($errors) == 0) {
        $sql = "UPDATE khuyenmai set tenKhuyenMai='$ten',ngayBatDau='$ngayBatDau',ngayKetThuc='$ngayKetThuc',maLKM='$maLKM',giaTriKhuyenMai='$giaTriKhuyenMai'
            where maKhuyenMai='$id'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: ./index.php?action=quanlykhuyenmai&&query=no');
    }
}
?>

<form class="form" action="./index.php?action=quanlykhuyenmai&&query=sua&&this_id=<?php echo $this_id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin khuyến mãi</h1>
        </div>
        <div class="form-content">
            <?php
            $sql = "SELECT maKhuyenMai as ma,tenKhuyenMai as ten,ngayBatDau,ngayKetThuc,maLKM,giaTriKhuyenMai 
                    from khuyenmai where maKhuyenMai='$this_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <label class="label">Mã khuyến mãi</label>
                <input class="text" type="text" name="ma" value="<?php echo $row['ma'] ?>" disabled>
                <label class="label">Tên khuyến mãi</label>
                <input class="text" type="text" name="ten" value="<?php echo (!empty($ten) ? $ten : $row['ten']) ?>">
                <?php echo (!empty($errors['ten']['required'])) ? "<span
                        class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
                <label class="label">Ngày bắt đầu</label>
                <input class="text" type="text" name="ngayBatDau" value="<?php echo (!empty($ngayBatDau) ? $ngayBatDau : $row['ngayBatDau']) ?>">
                <?php echo (!empty($errors['ngayBatDau']['required'])) ? "<span
                        class='message-error'>" . $errors['ngayBatDau']['required'] . "</span>" : false ?>
                <label class="label">Ngày kết thúc</label>
                <input class="text" type="text" name="ngayKetThuc" value="<?php echo (!empty($ngayKetThuc) ? $ngayKetThuc : $row['ngayKetThuc']) ?>">
                <?php echo (!empty($errors['ngayKetThuc']['required'])) ? "<span
                        class='message-error'>" . $errors['ngayKetThuc']['required'] . "</span>" : false ?>
                <label class="label">Loại khuyến mãi</label>
                <input class="text" type="text" name="maLKM" value="<?php echo (!empty($maLKM) ? $maLKM : $row['maLKM']) ?>">
                <?php echo (!empty($errors['maLKM']['required'])) ? "<span
                        class='message-error'>" . $errors['maLKM']['required'] . "</span>" : false ?>
                <label class="label">Giá trị khuyến mãi</label>
                <input class="text" type="text" name="giaTriKhuyenMai" value="<?php echo (!empty($giaTriKhuyenMai) ? $giaTriKhuyenMai : $row['giaTriKhuyenMai']) ?>">
                <?php echo (!empty($errors['giaTriKhuyenMai']['required'])) ? "<span
                        class='message-error'>" . $errors['giaTriKhuyenMai']['required'] . "</span>" : false ?>
            <?php

            }
            ?>
            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>
    </div>


</form>