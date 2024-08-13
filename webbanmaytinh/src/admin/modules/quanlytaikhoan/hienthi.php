<?php
include '../././db/connect.php';

// Xử lý tìm kiếm
$searchText = isset($_POST['text']) ? $_POST['text'] : '';
$searchCondition = '';

if ($searchText) {
    $searchText = mysqli_real_escape_string($conn, $searchText);
    $searchCondition = "WHERE userName LIKE '%$searchText%' 
                        OR hoTen LIKE '%$searchText%' 
                        OR email LIKE '%$searchText%' 
                        OR sdt LIKE '%$searchText%' 
                        OR diachi LIKE '%$searchText%' 
                        OR chucvu.tenChucVu LIKE '%$searchText%'";
}

// Phân trang
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn tài khoản
$sql = "SELECT userName as user, password as pass, hoTen as ten, email, sdt, diachi, chucvu.tenChucVu as chucvu 
        FROM taikhoan 
        JOIN chucvu ON taikhoan.maCV = chucvu.maChucVu 
        $searchCondition
        ORDER BY userName ASC LIMIT $offset, $limit";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
} else {
    ?>
    <div class="content-header">
        <h3 class="content-title">Danh Sách Tài Khoản</h3>
        <div class="search-container">
            <form class="search-form" action="?action=quanlytaikhoan&query=search" method="POST">
                <input class="search-input" type="text" name="text" value="<?php echo htmlspecialchars($searchText); ?>" placeholder="Tìm kiếm...">
                <button class="search-button" type="submit" name="search">Tìm kiếm</button>
            </form>
        </div>
        <button class="btn-add"><a class="title" href="?action=quanlytaikhoan&query=them"><i class="icon fa-solid fa-plus"></i>Thêm</a></button>
    </div>
    <table class="content-wrapper" style="min-height: 395px;">
        <tr class="content-list head">
            <td class="content-item width100 head"><b>User Name</b></td>
            <td class="content-item width100 head"><b>Password</b></td>
            <td class="content-item width100 head"><b>Họ tên</b></td>
            <td class="content-item width150 head"><b>Email</b></td>
            <td class="content-item width100 head"><b>SĐT</b></td>
            <td class="content-item width100 head"><b>Địa chỉ</b></td>
            <td class="content-item width100 head"><b>Chức vụ</b></td>
            <td class="content-item width100 head"><b>Thao tác</b></td>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr class="content-list" style="height: 70px;">
            <td class="content-item width100"><?php echo htmlspecialchars($row['user']); ?></td>
            <td class="content-item width100"><?php echo htmlspecialchars($row['pass']); ?></td>
            <td class="content-item width100"><?php echo htmlspecialchars($row['ten']); ?></td>
            <td class="content-item width150"><?php echo htmlspecialchars($row['email']); ?></td>
            <td class="content-item width100"><?php echo htmlspecialchars($row['sdt']); ?></td>
            <td class="content-item width100"><?php echo htmlspecialchars($row['diachi']); ?></td>
            <td class="content-item width100"><?php echo htmlspecialchars($row['chucvu']); ?></td>
            <td class="content-item width100">
                <a class="content-item width50" href="?action=quanlytaikhoan&query=sua&&this_id=<?php echo $row['user']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="content-item width50" href="?action=quanlytaikhoan&query=xoa&&this_id=<?php echo $row['user']; ?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
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
