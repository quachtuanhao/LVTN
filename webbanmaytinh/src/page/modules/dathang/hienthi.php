<?php
include '../db/connect.php';


$today = date('Y-m-d');
$gtKM = 0;

if (isset($_SESSION['dangnhap'])) {
    $id_user = $_SESSION['dangnhap'];

    // Truy vấn thông tin khuyến mãi của người dùng
    $sql3 = "SELECT maKM FROM taikhoan WHERE userName = '$id_user'";
    $result3 = mysqli_query($conn, $sql3);

    if (!$result3) {
        die('Lỗi truy vấn: ' . mysqli_error($conn));
    }

    $row3 = mysqli_fetch_array($result3);
    if (!empty($row3)) {
        $maKM = $row3['maKM'];

        // Truy vấn thông tin khuyến mãi từ bảng khuyến mãi
        $sql4 = "SELECT giaTriKhuyenMai FROM khuyenmai WHERE maKhuyenMai = '$maKM'";
        $result4 = mysqli_query($conn, $sql4);

        if (!$result4) {
            die('Lỗi truy vấn: ' . mysqli_error($conn));
        }

        $row4 = mysqli_fetch_array($result4);
        if (!empty($row4)) {
            $gtKM = $row4['giaTriKhuyenMai'];
        }
    }
}

$_SESSION['giam'] = 0;
$_SESSION['makm'] = '';
$_SESSION['tenKhuyenMai'] = '';
$_SESSION['gtKM'] = '';
$_SESSION['mLKM'] = '';

if (isset($_POST['submit'])) {
    $_SESSION['makm'] = $_POST['km'];
    $action = $_POST['km'];

    if ($action == "0") {
        $_SESSION['giam'] = 0;
    } else {
        // Truy vấn thông tin khuyến mãi từ bảng khuyến mãi
        $sql2 = "SELECT maLKM, giaTriKhuyenMai, ngayKetThuc, tenKhuyenMai FROM khuyenmai WHERE maKhuyenMai='$action'";
        $result2 = mysqli_query($conn, $sql2);

        if (!$result2) {
            die('Lỗi truy vấn: ' . mysqli_error($conn));
        }

        $row2 = mysqli_fetch_array($result2);
        if (empty($row2)) {
            echo "<script language='javascript'>
                    alert('Mã khuyến mãi không tồn tại!');
                    window.location = 'index.php?action=thongtindonhang';
                  </script>";
            exit;
        }

        if (strtotime($row2['ngayKetThuc']) < strtotime($today)) {
            $_SESSION['giam'] = 0;
            ?>
            <script language="javascript">
                alert("Mã Khuyến mãi đã hết hạn! Không thể áp dụng");
                window.location = "index.php?action=thongtindonhang";
            </script>;
            <?php
        } else {
            if ($row2['maLKM'] == 'KM1' && $row2['giaTriKhuyenMai'] > $_SESSION['tong']) { ?>
                <script language="javascript">
                    alert("Giá trị Khuyến mãi lớn hơn giá trị đơn hàng! Không thể áp dụng");
                    window.location = "index.php?action=thongtindonhang";
                </script>;
            <?php
            } else {
                $maLKM = $row2['maLKM'];
                $_SESSION['tenKhuyenMai'] = $row2['tenKhuyenMai'];
                $_SESSION['gtKM'] = $row2['giaTriKhuyenMai'];
                $_SESSION['mLKM'] = $row2['maLKM'];
                $value = $row2['giaTriKhuyenMai'];
                if ($maLKM == 'KM1') {
                    $_SESSION['giam'] = $value;
                } else if ($maLKM == 'KM2') {
                    $_SESSION['giam'] = $value;
                }
            }
        }
    }
}
?>
<div class="tiltle">
    <p class="content-title">Đặt hàng</p>
</div>
<table class="cart">
    <?php
    // Truy vấn thông tin của người dùng
    $sql = "SELECT hoTen, sdt, diaChi FROM taikhoan WHERE userName='$id_user'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Lỗi truy vấn: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr class="cart-list">
            <td class="cart-item"> <?php echo 'Tên khách hàng: ' . $row['hoTen'] . ' - Số điện thoại: ' . $row['sdt'] . ' - Địa chỉ: ' . $row['diaChi'] ?></td>
        </tr>
    <?php
    }
    ?>
    <tr class="cart-list head">
        <td class="cart-item width100">Sản phẩm</td>
        <td class="cart-item width100">Tên sản phẩm</td>
        <td class="cart-item width100">Đơn giá</td>
        <td class="cart-item width100">Số Lượng</td>
        <td class="cart-item width100">Số tiền</td>
    </tr>
    <?php
    foreach ($_SESSION["cart$id_user"] as $k => $v) {
    ?>
        <tr class="cart-list">
            <td class="cart-item width100"> <img src="../../assets/img/<?php echo $v['img'] ?>" alt=""> </td>
            <td class="cart-item width100"><?php echo $v['name'] ?></td>
            <td class="cart-item width100"><?php echo number_format($v['price'], 0, ',', '.') . 'đ' ?></td>
            <td class="cart-item width100">
                <div class="handle_quantity">
                    <p><?php echo $v['quantity'] ?></p>
                </div>
            </td>
            <td class="cart-item width100"><?php echo number_format($v['total'], 0, ',', '.') . 'đ' ?></td>
        </tr>
    <?php
    }
    ?>
    <tr class="cart-list voucher">
        <td class="cart-item width400"><?php echo $_SESSION['tenKhuyenMai'] != '' ? ($_SESSION['tenKhuyenMai'] . ' Giảm ' . ($_SESSION['mLKM'] == 'KM1' ? number_format($_SESSION['gtKM'], 0, ',', '.') . 'đ' : $_SESSION['gtKM'] . '%')) : 'Mã khuyến mãi' ?></td>
        <td class="cart-item width200">
            <form class="form" action="index.php?action=thongtindonhang" method="POST">
                <input class="text" type="text" name="km">
                <input class="submit--update" type="submit" name="submit" value="Áp dụng">
            </form>
        </td>
    </tr>
</table>
<p><b>Tổng tiền: <?php
                    $_SESSION['tong'] = 0;
                    foreach ($_SESSION["cart$id_user"] as $k => $v) {
                        $_SESSION['tong'] = $_SESSION['tong'] + $v['total'];
                    }
                    if (strlen($_SESSION['giam']) == 1) {
                        if ($gtKM > 0) {
                            $_SESSION['tong'] -= $_SESSION['tong'] * $gtKM / 100;
                        } else {
                            $_SESSION['tong'] = $_SESSION['tong'];
                        }
                    } else if (strlen($_SESSION['giam']) == 2) {
                        $_SESSION['tong'] -= $_SESSION['tong'] * ($_SESSION['giam'] + $gtKM) / 100;
                    } else {
                        $_SESSION['tong'] -= $_SESSION['tong'] * $gtKM / 100 + $_SESSION['giam'];
                    }
                    echo number_format($_SESSION['tong'], 0, ',', '.') . 'đ' ?></b></p>
<div class="submit">
    <button class="submit--shopping">
        <a class="title" href="modules/dathang/dathang.php?maKM=<?php echo $_SESSION['makm'] ?>">Đặt hàng</a>
    </button>
</div>
