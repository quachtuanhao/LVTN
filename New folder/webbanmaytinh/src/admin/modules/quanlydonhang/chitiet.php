<?php 
    include'../././db/connect.php';
    $total=0;
    if(isset($_GET["id"])){
        $id=$_GET["id"];
    }
?>
      <div class="content-header">
      <h3 class="content-title">Chi Tiết Đơn Hàng</h3>
  </div>
  <table class="content-wrapper">
      <tr class="content-list head">
          <td class="content-item width200 head"> <b>Tên sản phẩm</b></td>
          <td class="content-item width100 head"> <b>Giá</b></td>
          <td class="content-item width100 head"> <b>Số lượng</b></td>
          <td class="content-item width200 head"> <b>Tổng tiền</b></td>
          
      </tr>
      <?php 
          $sql = "SELECT * from chitietdathang where maDDH = $id";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_array($result)){
            $total=$total+$row["tongTien"];
          ?>
              <tr class="content-list">
                  <td class="content-item width200"><?php echo $row['tenSP'] ?></td>
                  <td class="content-item width100"><?php echo number_format($row['giaSP'],$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></td>
                  <td class="content-item width100"><?php echo $row['soLuong']?></td>
                  <td class="content-item width200"><?php echo number_format($row['tongTien'],$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></td>
              </tr>
      <?php
           }
           mysqli_close($conn);
      ?>
  </table>
  <b>Tổng cộng : <?php echo number_format($total,$decimals=0,$dec_point=',',$thousand_sep='.').'đ' ?></b>
