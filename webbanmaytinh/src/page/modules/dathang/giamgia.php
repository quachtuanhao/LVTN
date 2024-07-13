<?php
include '../../../db/connect.php';
if (isset($_SESSION['dangnhap'])) {
    if (isset($_GET['maKM'])) {
        $maKM = $_GET['maKM'];
    }

    if ($maKM == "0") {
        $maKM = "";
    }

    $id_user = $_SESSION['dangnhap'];
    $sql = "SELECT hoTen,email,sdt,diachi from taikhoan where username='$id_user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (count($row) > 0) {
        $name = $row['hoTen'];
        $email = $row['email'];
        $sdt = $row['sdt'];
        $diachi = $row['diachi'];
        $maTT = "DXL";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d h:i:s');
        $sql = "INSERT into dondathang(maKH,tenKhach,emailKhach,sdtKhach,diaChiKhach,ngayDat,maTT,maKM) 
            values('$id_user','$name','$email','$sdt','$diachi','$date','$maTT','$maKM')";
        mysqli_query($conn, $sql);
        $id = $conn->insert_id;
        foreach ($_SESSION["cart$id_user"] as $k => $v) {
            $maSP = $v['id'];
            $tenSP = $v['name'];
            $giaSP = $v['price'];
            $soLuongSP = $v['quantity'];
            $totalSP = $v['total'];
            $sql1 = "INSERT into chitietdathang(maDDH,maSP,tenSP,giaSP,soLuong,tongTien) 
                values('$id','$maSP','$tenSP','$giaSP','$soLuongSP','$totalSP')";
            mysqli_query($conn, $sql1);
        }
        echo "Đặt thành công";
        unset($_SESSION["cart$id_user"]);
        unset($_SESSION["maKM"]);
        unset($_SESSION["tong"]);
    } else {
        echo 'khong ';
    }
} else {
    session_start();
    if (isset($_SESSION['cart'])) {
        if (isset($_POST['dathang'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $sdt = $_POST['sdt'];
            $diachi = $_POST['diachi'];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('Y-m-d h:i:s');
            $tinhtrang = 'DXL';
            $_SESSION['thongtin'] = array($name, $email, $sdt, $diachi, $date, $tinhtrang);
            $sql = "INSERT into dondathang(tenKhach,emailKhach,sdtKhach,diaChiKhach,ngayDat,maTT) 
                values('$name','$email','$sdt','$diachi','$date','$tinhtrang')";
            mysqli_query($conn, $sql);
            $id = $conn->insert_id;
            foreach ($_SESSION['cart'] as $k => $v) {
                $maSP = $v['id'];
                $tenSP = $v['name'];
                $giaSP = $v['price'];
                $soLuongSP = $v['quantity'];
                $totalSP = $v['total'];
                $sql1 = "INSERT into chitietdathang(maDDH,maSP,tenSP,giaSP,soLuong,tongTien) 
                    values('$id','$maSP','$tenSP','$giaSP','$soLuongSP','$totalSP')";
                mysqli_query($conn, $sql1);
            }
            echo 'Đặt thành công';
            $_SESSION['donhang'] = $_SESSION["cart"];
            unset($_SESSION["cart"]);
        } else {
            echo 'khong co gio hang';
        }
    }
}
