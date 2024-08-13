<?php
include '../././db/connect.php';

// Xử lý tìm kiếm
$searchText = isset($_POST['text']) ? $_POST['text'] : (isset($_GET['text']) ? $_GET['text'] : '');
$searchCondition = '';

if ($searchText) {
    $searchText = mysqli_real_escape_string($conn, $searchText);
    $searchCondition = "WHERE dondathang.maDonDatHang LIKE '%$searchText%' 
                        OR dondathang.maKH LIKE '%$searchText%' 
                        OR dondathang.tenKhach LIKE '%$searchText%' 
                        OR dondathang.sdtKhach LIKE '%$searchText%' 
                        OR dondathang.diaChiKhach LIKE '%$searchText%'";
}

// Phân trang
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn đơn hàng
$sql = "SELECT * FROM dondathang 
        LEFT JOIN trangthai ON dondathang.maTT = trangthai.maTrangThai 
        $searchCondition
        ORDER BY dondathang.ngayDat DESC LIMIT $offset, $limit";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
} else {
    ?>
    <div class="content-header">
        <h3 class="content-title">Danh Sách Đơn Hàng</h3>
        <div class="search-container" style="text-align: center;">
            <form class="search-form" action="" method="POST" style="display: inline-block;">
                <input class="search-input" type="text" name="text" value="<?php echo htmlspecialchars($searchText); ?>" placeholder="Tìm kiếm...">
                <button class="search-button" type="submit" name="search">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <table class="content-wrapper" style="min-height:395px">
        <tr class="content-list head">
            <td class="content-item width100 head"><b>Mã đơn hàng</b></td>
            <td class="content-item width100 head"><b>Username</b></td>
            <td class="content-item width150 head"><b>Tên khách hàng</b></td>
            <td class="content-item width100 head"><b>Số điện thoại</b></td>
            <td class="content-item width150 head"><b>Địa chỉ</b></td>
            <td class="content-item width100 head"><b>Ngày đặt</b></td>
            <td class="content-item width200 head"><b>Tình trạng</b></td>
            <td class="content-item width50 head"><b>Chi tiết</b></td>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $tt = $row['maTT'];
            $maDDH = $row['maDonDatHang'];
        ?>
        <tr class="content-list" style="height: 70px;">
            <td class="content-item width100"><?php echo $row['maDonDatHang'] ?></td>
            <td class="content-item width100"><?php echo $row['maKH'] ?></td>
            <td class="content-item width150"><?php echo htmlspecialchars($row['tenKhach']) ?></td>
            <td class="content-item width100"><?php echo $row['sdtKhach'] ?></td>
            <td class="content-item width150"><?php echo htmlspecialchars($row['diaChiKhach']) ?></td>
            <td class="content-item width100"><?php echo date("d/m/Y", strtotime($row['ngayDat'])) ?></td>
            <td class="content-item width200">
                <form class="form-row" action="index.php?action=quanlydonhang&query=capnhat&id=<?php echo $maDDH ?>" method="POST">
                    <select name="tinhtrang">
                        <?php
                        $sql1 = "SELECT * FROM trangthai";
                        $result1 = mysqli_query($conn, $sql1);
                        while ($row1 = mysqli_fetch_array($result1)) {
                        ?>
                            <option value="<?php echo $row1['maTrangThai'] ?>" <?php if ($tt == $row1['maTrangThai']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($row1['tenTrangThai']) ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="submit" name="capnhat" value="Cập nhật" style="margin-top: 10px; margin-left: 92px; cursor: pointer">
                </form>
            </td>
            <td class="content-item width50">
                <a href="index.php?action=quanlydonhang&query=chitiet&id=<?php echo $maDDH ?>"><i class="fa-solid fa-circle-info"></i></a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    // Bao gồm tập tin phân trang
    include 'pagination.php';
}
?>

<!-- pagination.php -->
<?php
// pagination.php - Tập tin phân trang

// Lấy tổng số lượng đơn hàng để tính số trang
$countSql = "SELECT COUNT(*) as total FROM dondathang 
             LEFT JOIN trangthai ON dondathang.maTT = trangthai.maTrangThai 
             $searchCondition";
$countResult = mysqli_query($conn, $countSql);
$countRow = mysqli_fetch_assoc($countResult);
$totalRecords = $countRow['total'];
$totalPages = ceil($totalRecords / $limit);


