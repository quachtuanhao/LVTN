<?php
include '../../../db/connect.php';
session_start(); // Gọi session_start() một lần ở đầu file

if (isset($_SESSION['dangnhap'])) {
    $maKM = isset($_GET['maKM']) ? $_GET['maKM'] : 'NULL'; // Đảm bảo $maKM có giá trị mặc định

    $id_user = $_SESSION['dangnhap'];

    // Sử dụng prepared statements
    $stmt = $conn->prepare("SELECT hoTen, email, sdt, diachi FROM taikhoan WHERE userName = ?");
    $stmt->bind_param("s", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) { // Kiểm tra xem có dòng dữ liệu nào được trả về không
        $name = $row['hoTen'];
        $email = $row['email'];
        $sdt = $row['sdt'];
        $diachi = $row['diachi'];
        $maTT = "DXL";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s'); // Sử dụng định dạng giờ 24h

        // Thực hiện chèn đơn hàng
        $stmt = $conn->prepare("INSERT INTO dondathang (maKH, tenKhach, emailKhach, sdtKhach, diaChiKhach, ngayDat, maTT, maKM) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $id_user, $name, $email, $sdt, $diachi, $date, $maTT, $maKM);
        $stmt->execute();
        $id = $conn->insert_id;

        // Thực hiện chèn chi tiết đơn hàng
        foreach ($_SESSION["cart$id_user"] as $k => $v) {
            $maSP = $v['id'];
            $tenSP = $v['name'];
            $giaSP = $v['price'];
            $soLuongSP = $v['quantity'];
            $totalSP = $v['total'];

            $stmt = $conn->prepare("INSERT INTO chitietdathang (maDDH, maSP, tenSP, giaSP, soLuong, tongTien) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issdii", $id, $maSP, $tenSP, $giaSP, $soLuongSP, $totalSP);
            $stmt->execute();

            // Cập nhật số lượng sản phẩm
            $stmt = $conn->prepare("SELECT soLuong FROM sanpham WHERE maSanPham = ?");
            $stmt->bind_param("s", $maSP);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $soluong = $row['soLuong'] - $soLuongSP;

            if ($soluong < 0) {
                $soluong = 0; // Đảm bảo số lượng không âm
            }

            $stmt = $conn->prepare("UPDATE sanpham SET soLuong = ? WHERE maSanPham = ?");
            $stmt->bind_param("is", $soluong, $maSP);
            $stmt->execute();
        }

        unset($_SESSION["cart$id_user"]);
        unset($_SESSION["maKM"]);
        unset($_SESSION["tong"]);
?>
        <script language="javascript">
            alert("Đặt hàng thành công!");
            window.location = "../../index.php?action=xemdonhang";
        </script>
<?php
    } else {
        echo "Không tìm thấy thông tin người dùng.";
    }
} else {
    if (isset($_SESSION['cart'])) {
        $_SESSION['pending_cart'] = $_SESSION['cart']; // Lưu giỏ hàng vào session tạm thời
        header('Location: register.php');
        exit();
    }    
}
?>
