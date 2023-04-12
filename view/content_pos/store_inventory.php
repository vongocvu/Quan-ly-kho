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
      <?php require_once PATH_APPLICATION . '/core/Base_Model.php';
      $db = new Base_Model();

      $Stores = $db->conn->query("SELECT *, CONCAT(b.tenlot,' ',b.tennhanvien) as hovaten FROM kho a, nhanvien b WHERE a.quanlykho = b.id_nhanvien");
      
      foreach ($Stores as $store) {
      ?>
            <div id="store_inventory_detail<?= $store['id_kho'] ?>" class="box_inventory hidden content-pos-view">
                  <table class="invoice-info-container">
                        <tr>
                              <td style="text-align: left"><span class="title_desc">Quản lý kho: </span> - <?= $store['hovaten']?></td>
                              <td style="text-align: right"></td>
                        </tr>
                        <tr>
                              <td style="text-align: left"><span class="title_desc">Số điện thoại: </span> -  <?= $store['sodienthoai']?></td>
                              <td style="text-align: right"></td>
                        <tr>
                  </table>

                  <div class="name_invoice" style="margin-top: 0">
                  <h1 style="text-transform: uppercase;">HÀNG TỒN <?=$store['tenkho']?></h1>
                  </div>

                  <table border="1">
                        <thead>
                              <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn vị tính</th>
                                    <th>Giá xuất kho</th>
                                    <th>Ngày nhập kho</th>
                                    <th>Số ngày tồn</th>
                                    <th>Thành tiền</th>
                                    <th>Ghi chú</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php
                                    $id_kho = $store['id_kho'];
                                    $Products = $db->conn->query("SELECT *,  DATEDIFF(CURDATE(), ngaynhapkho) AS songaytonkho FROM hanghoa a, donvitinh b WHERE a.donvitinh = b.id_donvitinh AND DATEDIFF(CURDATE(), ngaynhapkho) > '30'");
                                     $i = 1;
                                     $total = 0;
                                    foreach ($Products as $product) {
                                              $total += $product['soluong'] * $product['gianhap'];
                                          ?> 
                                             <tr style="text-align: center;">
                                                <td><?=$i++?></td>
                                                <td><?=$product['tenhanghoa']?></td>
                                                <td><?=$product['soluong']?></td>
                                                <td><?=$product['tendonvitinh']?></td>
                                                <td><?=currency_format($product['giabansi'])?></td>
                                                <td><?=$product['ngaynhapkho']?></td>
                                                <td><?=$product['songaytonkho']?> ngày</td>
                                                <td><?=currency_format($product['soluong'] * $product['gianhap'])?></td>
                                                <td><?=$product['ghichu']?></td>
                                             </tr>
                                          <?php
                                    }
                              ?>
                                               <tr style="text-align: center;">
                                                    <td colspan="7" style=" font-weight: bold; color: red">Tổng cộng:</td>
                                                    <td colspan="1"  style=" font-weight: bold; color: red"><?=currency_format($total)?></td>
                                                    <td></td>
                                               </tr>

                                               <tr style="border-color: transparent">
                                                      <td colspan="7"></td>
                                                      <td style="text-align: center; padding: 30px">
                                                            <a href="?c=store&a=inventory_excel&id=<?=$id_kho?>" class="export-btn">
                                                                 Xuất File Excel
                                                             </a>
                                                            </td>
                                                      </td>
                                                      <td></tr>
                              </tbody>
                  </table>
            </div>
            <?php
      }
      ?>
      

</body>

</html>