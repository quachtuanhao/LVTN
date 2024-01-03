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
    $moTa = $_POST['mota'];
    $errors = [];
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên sản phẩm không được bỏ trống';
    }
    if (count($errors) == 0) {
        $sql = "UPDATE nhasanxuat set tenNhaSanXuat='$ten',truSoChinh='$moTa'
            where maNhaSanXuat='$id'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: ./index.php?action=quanlynhasanxuat&&query=no');
    }
}
?>

<form class="form" action="./index.php?action=quanlynhasanxuat&&query=sua&&this_id=<?php echo $this_id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin sản phẩm</h1>
        </div>
        <div class="form-content">
            <?php
            $sql = "SELECT maNhaSanXuat as ma,tenNhaSanXuat as ten,truSoChinh
                    from nhasanxuat where maNhaSanXuat='$this_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <label class="label">Mã nhà sản xuất</label>
                <input class="text" type="text" name="ma" value="<?php echo $row['ma'] ?>" disabled>
                <label class="label">Tên nhà sản xuất</label>
                <input class="text" type="text" name="ten" value="<?php echo $row['ten'] ?>">
                <?php echo (!empty($errors['ten']['required'])) ? "<span
                        class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
                <label class="label">Địa chỉ</label>
                <input class="text" type="text" name="mota" value="<?php echo $row['truSoChinh'] ?>">
            <?php

            }
            ?>
            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>

    </div>

</form>