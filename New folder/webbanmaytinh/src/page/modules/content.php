<div class="content">
    <?php
        if(isset($_GET['action'])){
            $tam = $_GET['action'];
        }
        else{
            $tam = '';
        }
        
        if($tam=='nsx'){
            include'danhmucsanpham/nsx.php';
        }
        
        else if($tam=='chitietsanpham'){
            include'danhmucsanpham/chitietsanpham.php';
        }
        else if($tam=='xemgiohang'){
            include'quanlygiohang/hienthi.php';
        }
        else if($tam=='xemdonhang'){
            include'donhang/hienthi.php';
        }
        else if($tam=='xemchitietdonhang'){
            include'donhang/chitiet.php';
        }
        else if($tam=='xemkhuyenmai'){
            include'khuyenmai/hienthi.php';
        }
        else if($tam=='login'){
            include'./login.php';
        }
        else if($tam=='register'){
            include'./register.php';
        }
        else if($tam=='thongtindonhang'){
            include'dathang/hienthi.php';
        }
        else if($tam=='chinhsuathongtin'){
            include'quanlythongtin/hienthi.php';
        }
        else if($tam=='doimatkhau'){
            include'quanlythongtin/doi.php';
        }
        else if($tam=='search'){
            include'danhmucsanpham/hienthi.php';
        }
        
        // else if($tam=='themgiohang'){
        //     include'./giohang.php';
        // }
        // else if($tam=='quanlysanpham' && $query=='them'){
        //     include'./modules/quanlysanpham/them.php';
        // }
        // else if($tam=='quanlysanpham' && $query=='xoa'){
        //     include'./modules/quanlysanpham/xoa.php';
        // }
        // else if($tam=='quanlysanpham' && $query=='sua'){
        //     include'./modules/quanlysanpham/sua.php';
        // }
        // else if($tam=='quanlytaikhoan' && $query=='no'){
        //     include'./modules/quanlytaikhoan/hienthi.php';
        // }
        else{
            // include'./modules/dashboard.php';
            include'danhmucsanpham/hienthi.php';
        }
        
    ?>
</div>