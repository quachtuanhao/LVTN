<?php
include '../db/connect.php';
$today = date('Y-m-d');
if (isset($_SESSION['dangnhap'])) {
    $id_user = $_SESSION['dangnhap'];
    $gtKM = 0;
    $sql3 = "SELECT maKM from taikhoan where userName = '$id_user'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    if (!empty($row3)) {
        $maKM = $row3['maKM'];

        $sql4 = "SELECT giaTriKhuyenMai from khuyenmai where maKhuyenMai = '$maKM'";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_array($result4);
        if (!empty($row4))
            $gtKM = $row4['giaTriKhuyenMai'];
    }
}
$_SESSION['giam'] = 0;
$_SESSION['makm'] = '';
$_SESSION['tenKhuyenMai'] = '';

if (isset($_POST['submit'])) {
    $_SESSION['makm'] = $_POST['km'];
    $action = $_POST['km'];
    if ($action == "0") {
        $_SESSION['giam'] = 0;
    } else {
        $sql2 = "SELECT maLKM,giaTriKhuyenMai,ngayKetThuc,tenKhuyenMai from khuyenmai where maKhuyenMai='$action'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
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
                $value = $row2['giaTriKhuyenMai'];
                if ($maLKM == 'KM1') {
                    $_SESSION['giam'] = $value;
                } else if ($maLKM == 'KM2') {
                    $_SESSION['giam'] = $value;
                }
            }
        }

        // header('location: ../../../page/index.php?action=thongtindonhang');
    }
}
?>
<div class="tiltle">
    <p class="content-title">Đặt hàng</p>
</div>
<table class="cart">
    <?php
    $sql = "SELECT hoTen,sdt,diaChi from taikhoan where userName='$id_user'";
    $result = mysqli_query($conn, $sql);
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
            <td class="cart-item width100"><?php echo number_format($v['price'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
            <td class="cart-item width100">
                <div class="handle_quantity">
                    <p><?php echo $v['quantity'] ?></p>
                </div>
            </td>
            <td class="cart-item width100"><?php echo number_format($v['total'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></td>
        </tr>
    <?php
    }
    ?>
    <tr class="cart-list voucher">
        <td class="cart-item width200"><?php echo $_SESSION['tenKhuyenMai'] != '' ? $_SESSION['tenKhuyenMai'] : 'Mã khuyến mãi' ?></td>
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
                    echo number_format($_SESSION['tong'], $decimals = 0, $dec_point = ',', $thousand_sep = '.') . 'đ' ?></b></p>
<div class="submit">
    <button class="submit--shopping">
        <a class="title" href="modules/dathang/dathang.php?maKM=<?php echo $_SESSION['makm'] ?>">Đặt hàng</a>
    </button>
</div>