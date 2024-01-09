<div class="content">
    <?php
    if (isset($_GET['action'])) {
        $tam = $_GET['action'];
    } else {
        $tam = '';
    }

    if ($tam == 'nsx') {
        include 'danhmucsanpham/nsx.php';
    } else if ($tam == 'chitietsanpham') {
        include 'danhmucsanpham/chitietsanpham.php';
    } else if ($tam == 'xemgiohang') {
        include 'quanlygiohang/hienthi.php';
    } else if ($tam == 'xemdonhang') {
        include 'donhang/hienthi.php';
    } else if ($tam == 'xemchitietdonhang') {
        include 'donhang/chitiet.php';
    } else if ($tam == 'xemkhuyenmai') {
        include 'khuyenmai/hienthi.php';
    } else if ($tam == 'login') {
        include './login.php';
    } else if ($tam == 'register') {
        include './register.php';
    } else if ($tam == 'thongtindonhang') {
        include 'dathang/hienthi.php';
    } else if ($tam == 'chinhsuathongtin') {
        include 'quanlythongtin/hienthi.php';
    } else if ($tam == 'doimatkhau') {
        include 'quanlythongtin/doi.php';
    } else if ($tam == 'search') {
        include 'danhmucsanpham/hienthi.php';
    }
    else {
        include 'danhmucsanpham/hienthi.php';
    }

    ?>
</div>