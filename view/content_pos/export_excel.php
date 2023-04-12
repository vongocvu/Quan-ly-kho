<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="./public/css/excel.css">
</head>

<body>
      <div id="store_export_excel" class="<?php if (!isset($cancel_export)) { echo "hidden";}?> content-pos-view">
            <div class="content-excel" style="display: flex; flex-direction: column;">
                  <?php 
                  if (!function_exists('currency_format')) {
                        function currency_format($number, $suffix = ' vnđ')
                        {
                          if (!empty($number)) {
                            return number_format($number, 0, ',', '.') . "{$suffix}";
                          }
                        }
                      }
                     if (!empty($_SESSION['products_export_excel'])) {
                        ?>
                          <div class="box_table_export">
                              <div class="title_table">
                                    <h1><?=$_SESSION['store']?></h1>
                              </div>
                          <table border="1" class="table_export">
                                 <thead>
                                       <tr>
                                             <th>STT</th>
                                             <th>Tên hàng hóa</th>
                                             <th>Đơn vị tính</th>
                                             <th>Số lượng</th>
                                             <th>Giá nhập</th>
                                             <th>Giá bán lẻ</th>
                                             <th>Giá bán sỉ</th>
                                             <th>Xuất xứ</th>
                                             <th>Nhóm hhàng</th>
                                             <th>Ghi chú</th>
                                       </tr>
                                 </thead>
         
                                 <tbody>
                              <?php
                             foreach ($_SESSION['products_export_excel'] as $key => $product) {
                                          ?> 
                                                <tr style="text-align: center;">
                                                      <td><?=$key + 1?></td>
                                                      <td><?=$product['name']?></td>
                                                      <td><?=$product['unit']?></td>
                                                      <td><?=$product['quantity']?></td>
                                                      <td style="text-align: right"><?=currency_format($product['price'])?></td>
                                                      <td style="text-align: right"><?=currency_format($product['price_sell'])?></td>
                                                      <td style="text-align: right"><?=currency_format($product['price_export'])?></td>
                                                      <td style="text-align: left"><?=$product['address']?></td>
                                                      <td><?=$product['cate']?></td>
                                                      <td><?=$product['note']?></td>
                                                </tr>
                                          <?php
                                    }
                               ?> 
                           
                        </tbody>
                        </table>
                          </div>
                        <div class="box_btn_export">
                              <a href="?c=excel&a=cancel_export">Quay lại</a>
                              <a href="?c=excel&a=save_export_excel">Xuất File Excel</a>
                        </div>
                           <?php
                     } else {
                        ?> 
                          <div class="table">
                              <div class="table-cell">
                                    <form action="?c=excel&a=import" method="POST" enctype="multipart/form-data" class="modal">
                                          <div id="profile">
                                                <div class="dashes">
                                                      </div>
                                                      <h1 class="title_export">Chọn kho</h1>
                                                
                                          </div>
                                          <div class="editable">
                                                <div class="box-link-store">
                                                      <?php 
                                                      require_once PATH_APPLICATION . '/core/Base_Model.php';
                                                      $db = new Base_Model();
                                                      $Stores = $db->conn->query("SELECT * FROM kho");

                                                      foreach ($Stores as $store) {
                                                            ?> 
                                                                  <a href="?c=excel&a=export&id=<?=$store['id_kho']?>" class="btn-2"><?=$store['tenkho']?></a>  
                                                            <?php
                                                      }
                                                      ?>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                       </div>
                        <?php
                     }
                  ?>
            </div>
      </div>
</body>

</html>