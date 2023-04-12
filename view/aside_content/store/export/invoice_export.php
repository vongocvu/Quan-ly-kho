<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./public/css/invoice.css">
</head>

<body>
  <table class="invoice-info-container">
   <tr>
     <td><span class="title_desc">Kho xuất hàng: </span> - <?=$_SESSION['export_store']['kho']['name']?></td>
     <td style="text-align: right"><span class="title_desc">Khách hàng: </span> - <?=$_SESSION['export_store']['khachhang']['name']?></td>
    </tr>
    <td><span class="title_desc">Mã hóa đơn: </span> - HD001</td>
    <td style="text-align: right"><span class="title_desc">Địa chỉ: </span> - <?=$_SESSION['export_store']['khachhang']['address']?></td>
    <tr>
  </table>
  
  <div class="name_invoice">
    <h1>HÓA ĐƠN XUẤT KHO</h1>
    <?php 
        $date = getdate();
        ?><span class="curent_time">Ngày <?=$date['mday']?> Tháng <?=$date['mon']?> năm <?=$date['year']?></span> <?php
    ?>  
  </div>

  <table border="1">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Đơn vị tính</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        <th>Ghi chú</th>
      </tr>
    </thead>
    <tbody>
         <?php
         if (!function_exists('currency_format')) {
           function currency_format($number, $suffix = ' vnđ')
           {
             if (!empty($number)) {
               return number_format($number, 0, ',', '.') . "{$suffix}";
             }
           }
         }
         $i = 1;
         $total_price = 0;
           if (!empty($_SESSION['products_export'])) {
               foreach ($_SESSION['products_export'] as $product) {
                    $total_price += $product['price_export'] * $product['quantity'];
                  ?> 
                     <tr style="text-align: center;">
                      <td><?=$i?></td>
                      <td><?=$product['name']?></td>
                      <td><?=$product['unit']?></td>
                      <td><?=$product['quantity']?></td>
                      <td><?=currency_format($product['price_export'])?></td>
                      <td><?=currency_format($product['price_export'] * $product['quantity'])?></td>
                      <td><?=$product['note']?></td>
                     </tr>
                  <?php
               }
           }
           ?> 
             <tr class="complete_invoice">
              <td></td>
              <td>Tổng cộng:</td>
              <td></td>
              <td></td>
              <td></td>
              <td><?=currency_format($total_price)?></td>
              <td></td>
             </tr>
           <?php
         ?>   

    </tbody>
  </table>

  <div class="box-end d-flex" style="justify-content: space-between; margin: 10px 120px; text-align: center;">
    <div class="name" >
      <h4 style="font-weight: bold;">Nhân viên xuất kho</h4>
      <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
    </div>
    <div class="name" >
      <h4 style="font-weight: bold;">Khách hàng</h4>
      <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
    </div>
  </div>


  <div class="footer">
  <form action="?c=export&a=comback" method="POST" class="footer-info">
      <span><button type="submit" class="btn save-btn">Quay lại</button></span> |
    </form>
    <form action="?c=export&a=complete_export" method="POST" class="footer-info">
      <span><button type="submit" class="btn save-btn">Xuất và in hóa đơn</button></span> |
    </form>
  </div>

</body>

</html>