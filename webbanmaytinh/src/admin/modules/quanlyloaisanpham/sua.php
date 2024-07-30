<?php
include '../././db/connect.php';

$message = '';

if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];
}

if (isset($_POST['submit'])) {
    if (isset($_GET['this_id'])) {
        $id = $_GET['this_id'];
    }
    $ten = $_POST['ten'];
    $errors = [];

    // Kiểm tra tên loại sản phẩm
    if (empty($ten)) {
        $errors['ten']['required'] = 'Tên loại sản phẩm không được bỏ trống';
    } else {
        $sql_check = "SELECT tenLoaiSanPham FROM loaisanpham WHERE tenLoaiSanPham='$ten' AND maLoaiSanPham != '$id'";
        $result_check = mysqli_query($conn, $sql_check);
        $row_check = mysqli_fetch_array($result_check);
        if (!empty($row_check)) {
            $errors['ten']['trung'] = 'Tên loại sản phẩm đã tồn tại';
        }
    }

    if (count($errors) == 0) {
        $sql = "UPDATE loaisanpham SET tenLoaiSanPham='$ten' WHERE maLoaiSanPham='$id'";
        if (mysqli_query($conn, $sql)) {
            $message = 'Sửa thông tin loại sản phẩm thành công';
        } else {
            $message = 'Sửa thông tin loại sản phẩm thất bại';
        }
        mysqli_close($conn);
        header('location: ./index.php?action=quanlyloaisanpham&&query=no&message=' . urlencode($message));
        exit();
    }
}
?>

<form class="form" action="./index.php?action=quanlyloaisanpham&&query=sua&&this_id=<?php echo $this_id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-main">
        <div class="form-title">
            <h1>Sửa thông tin loại sản phẩm</h1>
        </div>
        <div class="form-content">
            <?php
            $sql = "SELECT maLoaiSanPham as ma, tenLoaiSanPham as ten
                    FROM loaisanpham WHERE maLoaiSanPham='$this_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <label class="label">Mã loại sản phẩm</label>
                <input class="text" type="text" name="ma" value="<?php echo $row['ma'] ?>" disabled>
                
                <label class="label">Tên loại sản phẩm</label>
                <input class="text" type="text" name="ten" value="<?php echo (!empty($ten) ? $ten : $row['ten']) ?>">
                <?php echo (!empty($errors['ten']['required'])) ? "<span class='message-error'>" . $errors['ten']['required'] . "</span>" : false ?>
                <?php echo (!empty($errors['ten']['trung'])) ? "<span class='message-error'>" . $errors['ten']['trung'] . "</span>" : false ?>

            <?php
            }
            ?>
            <input class="submit" type="submit" name="submit" value="Lưu">
        </div>
    </div>
</form>

<?php
if (isset($_GET['message'])) {
    echo "<div class='message'>" . $_GET['message'] . "</div>";
}
?>
