<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="./public/css/invoice.css">
      <style>
            .select_input {
                  width: 100%;
                  border: none;
                  outline: none;
                  text-align: center;
                  cursor: pointer;
                  font-weight: bold;
            }

            .link_detail {
                  text-decoration: none;
                  font-size: 14px;
            }

            .link_detail:hover {
                  color: red;
                  text-decoration: underline;
            }
      </style>
</head>

<body>
      <?php require_once PATH_APPLICATION . '/core/Base_Model.php';
      $db = new Base_Model();

      $Stores = $db->conn->query("SELECT *, CONCAT(b.tenlot,' ',b.tennhanvien) as hovaten FROM kho a, nhanvien b WHERE a.quanlykho = b.id_nhanvien");
      
      foreach ($Stores as $store) {
            $id_kho = $store['id_kho'];
      ?>
            <div id="store_ship_detail<?= $store['id_kho'] ?>" class="box_inventory <?php if ($inventory !== $store['id_kho']){ echo 'hidden';}?> content-pos-view">
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

                    <?php 
                        if (isset($products_detail)) {
                              ?>
                                 <div class="name_invoice" style="margin-top: 0">
                                    <h1 style="text-transform: uppercase;">CHI TIẾT HÓA ĐƠN</h1>
                                </div>
                                <table border="1">
                                          <thead>
                                                <tr>
                                                      <th>STT</th>
                                                      <th>Tên hàng hóa</th>
                                                      <th>Số lượng</th>
                                                      <th>Đơn vị tính</th>
                                                      <th>Giá xuất</th>
                                                      <th>Thành tiền</th>
                                                      <th>Nhóm hàng</th>
                                                      <th>Ghi chú</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                    <?php 
                                        $i = 1;
                                        $total_detail = 0;
                                        foreach ($products_detail as $product) {

                                              $total_detail += $product['giabansi'] * $product['soluongxuat'];
                                              ?> 
                                            <tr>
                                                  <td><?=$i++?></td>
                                                  <td><?=$product['tenhanghoa']?></td>
                                                  <td><?=$product['soluongxuat']?></td>
                                                  <td><?=$product['tendonvitinh']?></td>
                                                  <td><?=currency_format($product['giabansi'])?></td>
                                                  <td><?=currency_format($product['giabansi'] * $product['soluongxuat'])?></td>
                                                  <td><?=$product['tennhomhang']?></td>
                                                  <td><?=$product['ghichuxuat']?></td>
                                                </tr>
                                                <?php
                                       }
                                       ?>
                                          <tr style="text-align: center;">
                                                <td colspan="5" style=" font-weight: bold; color: red">Tổng cộng:</td>
                                                <td colspan="1"  style=" font-weight: bold; color: red"><?=currency_format($total_detail)?></td>
                                                <td></td>
                                                <td></td>
                                         </tr>

                                          <tr style="border-color: transparent">
                                                      <td colspan="7"></td>
                                                      <td style="text-align: center; padding: 30px">
                                                            <a href="?c=inventory&a=go_inventory&id=<?=$id_kho?>" class="export-btn">
                                                            Quay lại
                                                            </a>
                                                            </td>
                                                </tr>
                                          </tbody>
                                   </table>
                              <?php

                        } else {
                              ?>
                                  <div class="name_invoice" style="margin-top: 0">
                                    <h1 style="text-transform: uppercase;">HÀNG ĐÃ XUẤT -  <?=$store['tenkho']?> - </h1>
                                    </div>

                                    <table border="1">
                                          <thead>
                                                <tr>
                                                      <th>STT</th>
                                                      <th>Nhân viên</th>
                                                      <th>Khách hàng</th>
                                                      <th>Hàng hóa</th>
                                                      <th>Tổng tiền</th>
                                                      <th>Ngày xuất kho</th>
                                                      <th>Thanh toán</th>
                                                      <th>Giao hàng</th>
                                                      <th>Ghi chú</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                      $Products = $db->conn->query("SELECT *, CONCAT(b.tenlot,' ',b.tennhanvien) as hotennhanvien, CONCAT(c.tenlot,' ',c.tenkhachhang) as hotenkhachhang
                                                                                    FROM hoadonxuatkho a, nhanvien b, khachhang c
                                                                                    WHERE  b.id_nhanvien = a.nhanvien AND c.id_khachhang = a.khachhang AND a.kho = '$id_kho'");
                                                      $i = 1;
                                                      $total = 0;
                                                      foreach ($Products as $product) {
                                                            $total += $product['tongtien'];
                                                            ?> 
                                                            <tr style="text-align: center;">
                                                                  <td><?=$i++?></td>
                                                                  <td><?=$product['hotennhanvien']?></td>
                                                                  <td><?=$product['hotenkhachhang']?></td>
                                                                  <td><a class="link_detail" href="?c=inventory&a=show_detail&id=<?=$product['id_hoadonxuatkho']?>&store=<?=$id_kho?>">Xem chi tiết</a></td>
                                                                  <td><?=currency_format($product['tongtien'])?></td>
                                                                  <td><?=$product['thoigianxuat']?></td>
                                                                  <td>
                                                                        <select class="select_input select_pay" name="" id="" store=<?=$id_kho?>  inventory=<?=$product['id_hoadonxuatkho']?>>
                                                                              <option value="0" <?php if ($product['thanhtoan'] == 0) { echo "selected";}?>>Chưa thanh toán</option>
                                                                              <option value="1" <?php if ($product['thanhtoan'] == 1) { echo "selected";}?>>Đã thanh toán</option>
                                                                        </select>
                                                                  </td>
                                                                  <td>
                                                                        <select class="select_input select_ship" name="" id="" store=<?=$id_kho?>  inventory=<?=$product['id_hoadonxuatkho']?>>
                                                                              <option value="0" <?php if ($product['giaohang'] == 0) { echo "selected";}?>>Chờ xác nhận...</option>
                                                                              <option value="1" <?php if ($product['giaohang'] == 1) { echo "selected";}?>>Đang giao ...</option>
                                                                              <option value="2" <?php if ($product['giaohang'] == 2) { echo "selected";}?>>Đã giao hàng</option>
                                                                        </select>
                                                                  </td>
                                                                  <td><?=$product['ghichu']?></td>
                                                            </tr>
                                                            <?php
                                                      }
                                                ?>
                                                            <tr style="text-align: center;">
                                                                  <td colspan="3" style=" font-weight: bold; color: red">Tổng cộng:</td>
                                                                  <td colspan="1"  style=" font-weight: bold; color: red"><?=currency_format($total)?></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                            </tr>

                                                            <tr style="border-color: transparent">
                                                                        <td colspan="7"></td>
                                                                        <td style="text-align: center; padding: 30px">
                                                                              <a href="?c=store&a=inventory_excel&id=<?=$id_kho?>" class="export-btn">
                                                                              Xuất File Excel
                                                                              </a>
                                                                              </td>
                                                                        </td><td>
                                                                  </tr>
                                                            </tbody>
                                    </table>
                              <?php
                        }
                    ?>
            </div>
            <?php
      }
      ?>
      

</body>

<script type="text/javascript">

      var select_input = document.querySelectorAll('.select_input')
            select_input.forEach(item => {
                  if (item.value == '0') {
                        item.style.color = 'red';
                  } else {
                        item.style.color = 'green';
                  }

                  item.addEventListener('change', function (e) {
                        if (e.target.value == '0') {
                              item.style.color = 'red';
                        } else {
                              item.style.color = 'green';
                        }
                  })

                  item.addEventListener('mousedown', function (e) {
                     item.style.color = 'black'
                  })
            })

      var select_pay = document.querySelectorAll('.select_pay')
      var select_ship = document.querySelectorAll('.select_ship')
      select_pay.forEach(pay => {
            pay.addEventListener('change', function (e) {
                  var id_kho = pay.getAttribute('store')
                  var id_inventory = pay.getAttribute('inventory')
                  var status_pay = pay.value
                  window.location.href = `http://localhost:3000/xampp/QLK-complete/index.php?c=inventory&a=inventory_export&id=${id_inventory}&status_pay=${status_pay}&store=${id_kho}`;
            })
      })

      select_ship.forEach(ship => {
            ship.addEventListener('change', function (e) {
                  var id_kho = ship.getAttribute('store')
                  var id_inventory = ship.getAttribute('inventory')
                  var status_ship = ship.value
                  window.location.href = `http://localhost:3000/xampp/QLK-complete/index.php?c=inventory&a=inventory_export&id=${id_inventory}&status_ship=${status_ship}&store=${id_kho}`;
            })
      })
</script>

</html>