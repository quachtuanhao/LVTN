<?php
include '../../../db/connect.php';
session_start(); // Gọi session_start() một lần ở đầu file

if (isset($_SESSION['dangnhap'])) {
    if (isset($_GET['maKM'])) {
        $maKM = $_GET['maKM'];
    } else {
        $maKM = 'NULL'; // Đảm bảo $maKM có giá trị mặc định
    }

    $id_user = $_SESSION['dangnhap'];
    $sql = "SELECT hoTen, email, sdt, diachi FROM taikhoan WHERE username='$id_user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if ($row) { // Kiểm tra xem có dòng dữ liệu nào được trả về không
        $name = $row['hoTen'];
        $email = $row['email'];
        $sdt = $row['sdt'];
        $diachi = $row['diachi'];
        $maTT = "DXL";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d h:i:s');
        $sql = "INSERT INTO dondathang(maKH, tenKhach, emailKhach, sdtKhach, diaChiKhach, ngayDat, maTT, maKM) 
                VALUES ('$id_user', '$name', '$email', '$sdt', '$diachi', '$date', '$maTT', '$maKM')";
        mysqli_query($conn, $sql);
        $id = $conn->insert_id;
        foreach ($_SESSION["cart$id_user"] as $k => $v) {
            $maSP = $v['id'];
            $tenSP = $v['name'];
            $giaSP = $v['price'];
            $soLuongSP = $v['quantity'];
            $totalSP = $v['total'];
            $sql1 = "INSERT INTO chitietdathang(maDDH, maSP, tenSP, giaSP, soLuong, tongTien) 
                     VALUES ('$id', '$maSP', '$tenSP', '$giaSP', '$soLuongSP', '$totalSP')";
            mysqli_query($conn, $sql1);
            $sql2 = "SELECT soLuong FROM sanpham WHERE maSanPham='$maSP'";
            $result = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_array($result);
            $soluong = $row['soLuong'] - $soLuongSP;
            $sql3 = "UPDATE sanpham SET soLuong=$soluong WHERE maSanPham='$maSP'";
            mysqli_query($conn, $sql3);
        }
        unset($_SESSION["cart$id_user"]);
        unset($_SESSION["maKM"]);
        unset($_SESSION["tong"]);
?>
        <script language="javascript">
            alert("Đặt hàng thành công!");
            window.location = "../../index.php?action=xemdonhang";
        </script>;
<?php
    }
} else {
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
            $sql = "INSERT INTO dondathang(maKH, tenKhach, emailKhach, sdtKhach, diaChiKhach, ngayDat, maTT, maKM) 
                    VALUES ('$sdt', '$name', '$email', '$sdt', '$diachi', '$date', '$tinhtrang', 'NULL')";
            mysqli_query($conn, $sql);
            $id = $conn->insert_id;
            foreach ($_SESSION['cart'] as $k => $v) {
                $maSP = $v['id'];
                $tenSP = $v['name'];
                $giaSP = $v['price'];
                $soLuongSP = $v['quantity'];
                $totalSP = $v['total'];
                $sql1 = "INSERT INTO chitietdathang(maDDH, maSP, tenSP, giaSP, soLuong, tongTien) 
                         VALUES ('$id', '$maSP', '$tenSP', '$giaSP', '$soLuongSP', '$totalSP')";
                mysqli_query($conn, $sql1);
            }
            unset($_SESSION["cart"]);
            unset($_SESSION["maKM"]);
            unset($_SESSION["tong"]);
?>
            <script language="javascript">
            alert("Đặt hàng thành công!");
            window.location = "../../index.php?action=xemdonhang";
        </script>;
<?php
        } else {
            echo 'khong co gio hang';
        }
    } else {
        echo 'khong co gio hang';
    }
}
?>
