<div class="content">
    <?php
    if (isset($_GET['action']) && isset($_GET['query'])) {
        $tam = $_GET['action'];
        $query = $_GET['query'];
    } else {
        $tam = '';
        $query = '';
    }

    if ($tam == 'quanlynhasanxuat' && $query == 'no') {
        include './modules/quanlynhasanxuat/hienthi.php';
    } else if ($tam == 'quanlynhasanxuat' && $query == 'them') {
        include './modules/quanlynhasanxuat/them.php';
    } else if ($tam == 'quanlynhasanxuat' && $query == 'sua') {
        include './modules/quanlynhasanxuat/sua.php';
    } else if ($tam == 'quanlynhasanxuat' && $query == 'xoa') {
        include './modules/quanlynhasanxuat/xoa.php';
    } else if ($tam == 'quanlyloaisanpham' && $query == 'no') {
        include './modules/quanlyloaisanpham/hienthi.php';
    } else if ($tam == 'quanlyloaisanpham' && $query == 'them') {
        include './modules/quanlyloaisanpham/them.php';
    } else if ($tam == 'quanlyloaisanpham' && $query == 'sua') {
        include './modules/quanlyloaisanpham/sua.php';
    } else if ($tam == 'quanlyloaisanpham' && $query == 'xoa') {
        include './modules/quanlyloaisanpham/xoa.php';
    } else if ($tam == 'quanlysanpham' && $query == 'no') {
        include './modules/quanlysanpham/hienthi.php';
    } else if ($tam == 'quanlysanpham' && $query == 'them') {
        include './modules/quanlysanpham/them.php';
    } else if ($tam == 'quanlysanpham' && $query == 'xoa') {
        include './modules/quanlysanpham/xoa.php';
    } else if ($tam == 'quanlysanpham' && $query == 'sua') {
        include './modules/quanlysanpham/sua.php';
    } else if ($tam == 'quanlytaikhoan' && $query == 'no') {
        include './modules/quanlytaikhoan/hienthi.php';
    } else if ($tam == 'quanlytaikhoan' && $query == 'sua') {
        include './modules/quanlytaikhoan/thongtin.php';
    } else if ($tam == 'quanlytaikhoan' && $query == 'xoa') {
        include './modules/quanlytaikhoan/xoa.php';
    } else if ($tam == 'quanlydonhang' && $query == 'no') {
        include './modules/quanlydonhang/hienthi.php';
    } else if ($tam == 'quanlydonhang' && $query == 'chitiet') {
        include './modules/quanlydonhang/chitiet.php';
    } else if ($tam == 'quanlydonhang' && $query == 'capnhat') {
        include './modules/quanlydonhang/hienthi.php';
    } else if ($tam == 'quanlykhuyenmai' && $query == 'no') {
        include './modules/quanlykhuyenmai/hienthi.php';
    } else if ($tam == 'quanlykhuyenmai' && $query == 'them') {
        include './modules/quanlykhuyenmai/them.php';
    } else if ($tam == 'quanlykhuyenmai' && $query == 'xoa') {
        include './modules/quanlykhuyenmai/xoa.php';
    } else if ($tam == 'quanlykhuyenmai' && $query == 'sua') {
        include './modules/quanlykhuyenmai/sua.php';
    } else {
        include './modules/dashboard.php';
    }

    ?>
</div>