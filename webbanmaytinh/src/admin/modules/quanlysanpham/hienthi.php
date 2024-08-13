<?php
include '../././db/connect.php';

// Xử lý tìm kiếm
$searchText = isset($_POST['text']) ? $_POST['text'] : '';
$searchCondition = '';

if ($searchText) {
    $searchText = mysqli_real_escape_string($conn, $searchText);
    $searchCondition = "WHERE maSanPham LIKE '%$searchText%' 
                        OR tenSanPham LIKE '%$searchText%' 
                        OR gia LIKE '%$searchText%' 
                        OR soLuong LIKE '%$searchText%' 
                        OR tenLoaiSanPham LIKE '%$searchText%' 
                        OR tenNhaSanXuat LIKE '%$searchText%'";
}

// Phân trang
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn sản phẩm
$sql = "SELECT maSanPham as id, tenSanPham as ten, gia, soLuong, hinhAnh as img, tenLoaiSanPham as loaiSP, tenNhaSanXuat as tenNSX 
        FROM sanpham 
        JOIN nhasanxuat ON sanpham.maNSX=nhaSanXuat.maNhaSanXuat 
        JOIN loaisanpham ON sanpham.maLSP=loaisanpham.maLoaiSanPham 
        $searchCondition
        ORDER BY id ASC LIMIT $offset, $limit";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
} else {
    ?>
    <div class="content-header">
        <h3 class="content-title">Danh Sách Sản Phẩm</h3>
        <div class="search-container">
            <form class="search-form" action="?action=quanlysanpham&query=search" method="POST">
                <input class="search-input" type="text" name="text" value="<?php echo htmlspecialchars($searchText); ?>" placeholder="Tìm kiếm...">
                <button class="search-button" type="submit" name="search">Tìm kiếm</button>
            </form>
        </div>
        <button class="btn-add"><a class="title" href="?action=quanlysanpham&&query=them"><i class="icon fa-solid fa-plus"></i>Thêm</a></button>
    </div>
    <table class="content-wrapper" style="min-height: 395px;">
        <tr class="content-list head">
            <td class="content-item width100 head"><b>Mã sản phẩm</b></td>
            <td class="content-item width200 head"><b>Tên sản phẩm</b></td>
            <td class="content-item width100 head"><b>Giá</b></td>
            <td class="content-item width100 head"><b>Số lượng</b></td>
            <td class="content-item width100 head"><b>Hình ảnh</b></td>
            <td class="content-item width150 head"><b>Loại sản phẩm</b></td>
            <td class="content-item width100 head"><b>Nhà sản xuất</b></td>
            <td class="content-item width100 head"><b>Thao tác</b></td>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr class="content-list" style="height: 70px;">
            <td class="content-item width100"><?php echo $row['id']; ?></td>
            <td class="content-item width200"><?php echo htmlspecialchars($row['ten']); ?></td>
            <td class="content-item width100"><?php echo number_format($row['gia'], 0, ',', '.') . 'đ'; ?></td>
            <td class="content-item width100"><?php echo $row['soLuong']; ?></td>
            <td class="content-item width100"><img src="../../././assets/img/<?php echo htmlspecialchars($row['img']); ?>" alt="img"></td>
            <td class="content-item width150"><?php echo htmlspecialchars($row['loaiSP']); ?></td>
            <td class="content-item width100"><?php echo htmlspecialchars($row['tenNSX']); ?></td>
            <td class="content-item width100">
                <a class="content-item width50" href="?action=quanlysanpham&query=sua&this_id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="content-item width50" href="?action=quanlysanpham&&query=xoa&&this_id=<?php echo $row['id']; ?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                <a class="content-item width50" href="?action=quanlysanpham&query=chitiet&this_id=<?php echo $row['id']; ?>"><i class="fa-solid fa-exclamation-circle"></i></a> 
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    include 'pagination.php'; 
}
?>
