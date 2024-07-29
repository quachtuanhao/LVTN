<?php
include '../././db/connect.php';

if (isset($_POST['capnhat'])) {
    $id = $_GET['id'];
    $tt = $_POST['tinhtrang'];
    $sql2 = "UPDATE dondathang SET maTT='$tt' WHERE maDonDatHang='$id'";
    mysqli_query($conn, $sql2);
}
?>
<div class="content-header">
    <h3 class="content-title">Danh Sách Đơn Hàng</h3>
</div>
<table class="content-wrapper" style="min-height:395px">
    <tr class="content-list head">
        <td class="content-item width100 head"> <b>Mã đơn hàng</b></td>
        <td class="content-item width100 head"> <b>Username</b></td>
        <td class="content-item width150 head"> <b>Tên khách hàng</b></td>
        <td class="content-item width100 head"> <b>Số điện thoại</b></td>
        <td class="content-item width150 head"> <b>Địa chỉ</b></td>
        <td class="content-item width100 head"> <b>Ngày đặt</b></td>
        <td class="content-item width200 head"> <b>Tình trạng</b></td>
        <td class="content-item width50 head"> <b>Chi tiết</b></td>
    </tr>
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $n = ($page - 1) * 5;
        $sql = $page == 1 ? "SELECT * FROM dondathang ORDER BY ngayDat DESC LIMIT 0,5" : "SELECT * FROM dondathang ORDER BY ngayDat DESC LIMIT $n,5";
    } else {
        $sql = "SELECT * FROM dondathang ORDER BY ngayDat DESC LIMIT 0,5";
    }
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $tt = $row['maTT'];
        $maDDH = $row['maDonDatHang'];
    ?>
        <tr class="content-list" style="height: 70px;">
            <td class="content-item width100"><?php echo $row['maDonDatHang'] ?></td>
            <td class="content-item width100"><?php echo $row['maKH'] ?></td>
            <td class="content-item width150"><?php echo $row['tenKhach'] ?></td>
            <td class="content-item width100"><?php echo $row['sdtKhach'] ?></td>
            <td class="content-item width150"><?php echo $row['diaChiKhach'] ?></td>
            <td class="content-item width100"><?php echo date("d/m/Y", strtotime($row['ngayDat'])) ?></td>
            <td class="content-item width200">
                <form class="form-row" action="index.php?action=quanlydonhang&&query=capnhat&&id=<?php echo $maDDH ?>" method="POST">
                    <select name="tinhtrang">
                        <?php
                        $sql1 = "SELECT * FROM trangthai";
                        $result1 = mysqli_query($conn, $sql1);
                        while ($row1 = mysqli_fetch_array($result1)) {
                        ?>
                            <option value="<?php echo $row1['maTrangThai'] ?>" <?php if ($tt == $row1['maTrangThai']) echo 'selected'; ?>>
                                <?php echo $row1['tenTrangThai'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="submit" name="capnhat" value="Cập nhật" style="margin-top: 10px; margin-left: 92px; cursor: pointer">
                </form>
            </td>
            <td class="content-item width50">
                <a href="index.php?action=quanlydonhang&&query=chitiet&&id=<?php echo $maDDH ?>"><i class="fa-solid fa-circle-info"></i></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<?php
include 'pagination.php';
?>
