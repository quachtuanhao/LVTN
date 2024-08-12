<?php
include '../../../db/connect.php';
session_start(); // Gọi session_start() một lần ở đầu file

if (isset($_SESSION['dangnhap'])) {
    $maKM = isset($_GET['maKM']) && $_GET['maKM'] !== '' ? $_GET['maKM'] : null;

    if ($maKM === null) {
        // Nếu không có mã khuyến mãi, hiển thị thông báo xác nhận
        echo '<script type="text/javascript">
                if (confirm("Hiện tại đơn hàng của bạn chưa dùng mã khuyến mãi. Bạn có chắc muốn đặt hàng không?")) {
                    window.location.href = "dathang.php?maKM=null";
                } else {
                    window.history.back();
                }
              </script>';
    } else {
        // Nếu có mã khuyến mãi, tiếp tục xử lý đơn hàng bình thường
        handleOrder($maKM);
    }
} else {
    if (isset($_SESSION['cart'])) {
        $_SESSION['pending_cart'] = $_SESSION['cart']; // Lưu giỏ hàng vào session tạm thời
        header('Location: register.php');
        exit();
    }    
}

function handleOrder($maKM) {
    global $conn; // Đảm bảo kết nối cơ sở dữ liệu toàn cục
    $id_user = $_SESSION['dangnhap'];

    // Sử dụng prepared statements để lấy thông tin người dùng
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

        // Xử lý đơn hàng với hoặc không có mã khuyến mãi
        if ($maKM === 'null') {
            $stmt = $conn->prepare("INSERT INTO dondathang (maKH, tenKhach, emailKhach, sdtKhach, diaChiKhach, ngayDat, maTT) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $id_user, $name, $email, $sdt, $diachi, $date, $maTT);
        } else {
            $stmt = $conn->prepare("INSERT INTO dondathang (maKH, tenKhach, emailKhach, sdtKhach, diaChiKhach, ngayDat, maTT, maKM) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $id_user, $name, $email, $sdt, $diachi, $date, $maTT, $maKM);
        }

        if (!$stmt->execute()) {
            die("Lỗi khi chèn đơn hàng: " . $stmt->error);
        }

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
            
            if (!$stmt->execute()) {
                die("Lỗi khi chèn chi tiết đơn hàng: " . $stmt->error);
            }

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
            
            if (!$stmt->execute()) {
                die("Lỗi khi cập nhật số lượng sản phẩm: " . $stmt->error);
            }
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
}
?>
