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
      <div id="store_import_excel" class="<?php if (!isset($cancel_import)) { echo "hidden";}?> content-pos-view">
            <div class="content-excel">
                  <?php 
                  if (!function_exists('currency_format')) {
                        function currency_format($number, $suffix = ' VNĐ')
                        {
                          if (!empty($number)) {
                            return number_format($number, 0, ',', '.') . "{$suffix}";
                          }
                        }
                      }
                     if (isset($preview_excel)) {
                        ?> 
                           <div class="table_preview_excel">
                               <div class="title_excel">
                                    <h1>
                                          CHI TIẾT FILE NHẬP
                                    </h1>
                               </div>
                                <table border="1" style="width:100%">
                                    <thead>
                                          <tr>
                                               
                                                         <th>STT</th>
                                                         <th>Tên hàng hóa</th>
                                                         <th>Hình ảnh</th>
                                                         <th>Đơn vị tính</th>
                                                         <th>Số lượng</th>
                                                         <th>Giá nhập</th>
                                                         <th>Giá bán sỉ</th>
                                                         <th>Giá bán lẻ</th>
                                                         <th>Xuất xứ</th>
                                                         <th>Hạn sử dụng</th>
                                                         <th>Nhóm hàng</th>
                                                         <th>Kho</th>
                                                         <th>Ghi chú</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                          require_once PATH_APPLICATION . '/core/Base_Model.php';
                                          $db = new Base_Model();
                                          if (isset($_SESSION['content_excel'])) {
                                                foreach ($_SESSION['content_excel'] as $key => $content) {
                                                      $id_unit = $content['2'];
                                                      $id_cate = $content['9'];
                                                      $id_store = $content['10'];
                                                      $unit = $db->conn->query("SELECT * FROM donvitinh WHERE id_donvitinh = '$id_unit'");
                                                      $cate = $db->conn->query("SELECT * FROM nhomhang WHERE id_nhomhang = '$id_cate'");
                                                      $store = $db->conn->query("SELECT * FROM kho WHERE id_kho = '$id_store'");
                                                      $row_unit = $unit->fetch_assoc();
                                                      $row_cate = $cate->fetch_assoc();
                                                      $row_store = $store->fetch_assoc();
                                                      ?>
                                                        <tr style="text-align: center;">
                                                             <td><?=$key?></td>
                                                             <td><?=$content['0']?></td>
                                                             <td><?=$content['1']?></td>
                                                             <td><?=$row_unit['tendonvitinh']?></td>
                                                             <td><?=$content['3']?></td>
                                                             <td><?=currency_format($content['4'])?></td>
                                                             <td><?=currency_format($content['5'])?></td>
                                                             <td><?=currency_format($content['6'])?></td>
                                                             <td><?=$content['7']?></td>
                                                             <td><?=$content['8']?> ngày</td>
                                                             <td><?=$row_cate['tennhomhang']?></td>
                                                             <td><?=$row_store['tenkho']?></td>
                                                             <td><?=$content['11']?></td>
                                                       </tr>
                                                      <?php
                                                }
                                             }
                                          ?>
                                    </tbody>
                                </table>
                                <div class="box-btn-excel">
                                    <div class="box-warning">
                                          <ul>
                                                Lưu ý:
                                                <li> Những sản phẩm đã tồn tại trong kho thì sẽ cộng dồn số lượng lên.</li>
                                                <li> Sản phẩm mới sẽ được thêm mới vào kho.</li>
                                                <li> Kiểm tra kĩ kiểu dữ liệu trước khi nhập để tránh lỗi.</li>
                                          </ul>
                                    </div>
                                    <div class="btn-submit">
                                          <a href="?c=excel&a=cancel_excel" class="btn-cancel-excel">Nhập file khác</a>
                                          <a href="?c=excel&a=save_import_excel" class="btn-cancel-excel">Xác nhận</a>
                                    </div>
                                </div>
                           </div>
                        <?php
                     }  else {
                        ?>
                         <div class="table">
                              <div class="table-cell">
                                    <form action="?c=excel&a=import" method="POST" enctype="multipart/form-data" class="modal">
                                          <div id="profile">
                                                <div class="dashes"></div>
                                                <button type="submit" class="btn-excel hidden" name="submit_import">Nhập</button>
                                          </div>
                                          <div class="editable">
                                                <h1 class="title-excel">Nhập file Excel</h1>
                                                <input type="file" id="file" name="file_excel" required value=""/>
                                                <label for="file" class="btn-2">Upload</label>  
                                                <script>
                                                      var file = document.querySelector('#file')
                                                      var title_excel = document.querySelector('.title-excel');
                                                      var  btn_excel = document.querySelector('.btn-excel')
                                                      file.addEventListener('change', function (e) {
                                                            if (e.target.value !== "") {
                                                                  title_excel.innerText = e.target.value
                                                                  btn_excel.classList.remove("hidden")
                                                            }
                                                      })
                                                </script>          
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