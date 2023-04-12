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
     <td><span class="title_desc">Kho nhập hàng: </span> - <?=$_SESSION['import_store']['kho']['name']?></td>
     <td style="text-align: right"><span class="title_desc">Nhà phân phối: </span> - <?=$_SESSION['import_store']['nhaphanphoi']['name']?></td>
    </tr>
    <tr>
     <td><span class="title_desc">Quản lý kho: </span> - <?=$_SESSION['import_store']['kho']['admin']?></td>
     <td style="text-align: right"><span class="title_desc">Mã số thuế: </span> - <?=$_SESSION['import_store']['nhaphanphoi']['paxcode']?></td>
    </tr>
    <td><span class="title_desc">Mã hóa đơn: </span> - HD001</td>
    <td style="text-align: right"><span class="title_desc">Địa chỉ: </span> - <?=$_SESSION['import_store']['nhaphanphoi']['address']?></td>
    <tr>
  </table>
  
  <div class="name_invoice">
    <h1>HÓA ĐƠN NHẬP KHO</h1>
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
        <th>Số lượng</th>
        <th>Đơn vị tính</th>
        <th>Đơn giá</th>
        <th>Xuất xứ</th>
        <th>ngày hết hạn</th>
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
           if (!empty($_SESSION['products'])) {
               foreach ($_SESSION['products'] as $product) {
                    $total_price += $product['price'] * $product['quantity'];
                  ?> 
                     <tr style="text-align: center;">
                      <td><?=$i?></td>
                      <td><?=$product['name']?></td>
                      <td><?=$product['quantity']?></td>
                      <td><?=$product['unit']?></td>
                      <td><?=currency_format($product['price'])?></td>
                      <td><?=$product['address']?></td>
                      <td><?=$product['expiry']?> ngày</td>
                      <td><?=currency_format($product['price'] * $product['quantity'])?></td>
                      <td><?=$product['note']?></td>
                     </tr>
                  <?php
               }
           }
           ?> 
             <tr class="complete_invoice">
              <td colspan="7" style="color: red">Tổng cộng:</td>
              <td style="color: red"><?=currency_format($total_price)?></td>
              <td></td>
             </tr>
           <?php
         ?>   

    </tbody>
  </table>

  <div class="box-end d-flex" style="justify-content: space-between; margin: 10px 120px; text-align: center;">
    <div class="name" >
      <h4 style="font-weight: bold;">Nhân viên nhập kho</h4>
      <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
    </div>
    <div class="name" >
      <h4 style="font-weight: bold;">Nhà phân phối</h4>
      <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
    </div>
  </div>


  <div class="footer">
  <form action="?c=import&a=comback" method="POST" class="footer-info">
      <span><button type="submit" class="btn save-btn">Quay lại</button></span> |
    </form>
    <form action="?c=import&a=complete_import" method="POST" class="footer-info">
      <span><button type="submit" class="btn save-btn">Nhập và in hóa đơn</button></span> |
    </form>
  </div>

</body>

</html>