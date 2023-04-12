<div id="store_import_view" class="aside-item hidden roles-content">
<div class="content-add-roles pos-relative">
           <div class="content-title">
                  <h4>Nhập kho :</h4>
            </div>


            <?php 
                if (isset($_SESSION['import_store'])) {
                        ?>
                        <div class="form-add-container">
                              <div class="form-item w-40">
                                    <label class="title_import">Kho nhập hàng: <span class="input_obligatory"> * </span>
                                          <h2><?=$_SESSION['import_store']['kho']['name']?></h2>
                                    </label>
                              </div>

                              <div class="form-item w-40">
                                    <label class="title_import">Nhà phân phối: <span class="input_obligatory"> * </span>
                                          <h2><?=$_SESSION['import_store']['nhaphanphoi']['name']?></h2>
                                    </label>
                              </div>


                              <div class="form-item w-20">
                                    <form action="?c=import&a=cancel_import" method="POST" style="margin-right: 20px">
                                          <button type="submit" name="cancel_import" class="btn save-btn">Hủy đơn</button>
                                    </form>

                                    <form action="?c=import&a=go_invoice" method="POST">
                                          <button type="submit" name="complete" class="btn save-btn">Hoàn tất</button>
                                    </form>
                              </div>

                              <form action="?c=import&a=import" method="POST" class="form-add-container" enctype="multipart/form-data">

                                    <div class="form-item w-30 container_offer">
                                          <label class="form-item-name">Tên sản phẩm : <span class="input_obligatory"> * </span></label>
                                          <input class="form-item-input input_offer input_import input_import_offer" name="name_products" type="text" placeholder="Nhập tên sản phẩm">
                                          <div class="offer_products">
                                          </div> 
                                    </div>
                                    
                                    <div class="box-list-products" style="display: none">
                                          <?php 
                                                require_once PATH_APPLICATION . '/core/Base_Model.php';
                                                $db= new Base_Model();
                                                $id_kho = $_SESSION['import_store']['kho']['id'];
                                                $Products_offer = $db->conn->query("SELECT *, a.hansudung as hansudungsanpham FROM hanghoa a, nhomhang b WHERE a.nhomhang = b.id_nhomhang AND kho = '$id_kho'");

                                                foreach ($Products_offer as $product) {
                                                      ?> 
                                                      <ul class="product_offer">
                                                            <li><?=$product['tenhanghoa']?></li>
                                                            <li><?=$product['gianhap']?></li>
                                                            <li><?=$product['giabanle']?></li>
                                                            <li><?=$product['giabansi']?></li>
                                                            <li><?=$product['donvitinh']?></li>
                                                            <li><?=$product['hinhanh']?></li>
                                                            <li><?=$product['xuatxu']?></li>
                                                            <li><?=$product['nhomhang']?></li>
                                                            <li><?=$product['hansudungsanpham']?></li>
                                                            <li><?=$product['ghichu']?></li>
                                                            <li><?=$product['hansudung']?></li>
                                                      </ul>
                                                      <?php
                                                }
                                          ?>
                                    </div> 
                                    <div class="form-item w-30">
                                          <label class="form-item-name">Giá nhập: <span class="input_obligatory"> * </span></label>  
                                          <input name="price" type="text" class="form-item-input input_import import_price" placeholder="Nhập giá"/>
                                    </div>

                                    <div class="form-item w-30">
                                          <label class="form-item-name">Giá bán lẻ: <span class="input_obligatory"> * </span></label>  
                                          <input name="price_sell" type="text" class="form-item-input input_import import_price_sell" placeholder="Nhập bán lẻ"/>
                                    </div>

                                    <div class="form-item w-30">
                                          <label class="form-item-name">Giá bán sĩ: <span class="input_obligatory"> * </span></label>  
                                          <input name="price_export" type="text" class="form-item-input input_import import_price_export" placeholder="Nhập bán sĩ"/>
                                    </div>

                                    <div class="form-item w-30">
                                          <label class="form-item-name">Đơn vị tính : <span class="input_obligatory"> * </span></label>  
                                          <select name="unit" class="form-item-input select_import import_unit">
                                                      <option value="">Chọn đơn vị tính</option>
                                                      <?php 
                                                      if (isset($units)) {
                                                            foreach ($units as $unit) {
                                                                  ?> 
                                                                  <option value="<?=$unit['id_donvitinh']?>"><?=$unit['tendonvitinh']?></option>
                                                                  <?php
                                                            }
                                                      }
                                                      ?>
                                          </select>
                                    </div>
      
                                    <div class="form-item w-30">
                                          <label class="form-item-name">Số lượng : <span class="input_obligatory"> * </span></label>  
                                          <input name="quantity" type="number" class="form-item-input input_quantity_import input_import import_quantity" placeholder="Nhập số lượng"/>
                                          <script type="text/javascript" >
                                                var input_quantity = document.querySelector('.input_quantity_import')
                                                input_quantity.addEventListener('change', function (e) {
                                                   if (e.target.value < 1) {
                                                      e.target.value = '';
                                                      e.target.placeholder = 'Vui lòng nhập số lượng ít nhất là 1 !'
                                                   }
                                                })
                                          </script>
                                    </div>
      
                                    <div class="form-item w-30">
                                          <label class="form-item-name">Hình ảnh : <span class="input_obligatory"> * </span></label>  
                                          <input id="sp_hinh" name="image_import" type="file" class="form-item-input image_import"/>
                                          <img id="sp_hinh-upload" width="40" height="40" alt="">
                                    </div>
                                    <script>
                                          var image_upload = document.getElementById("sp_hinh");
                                          var preview_image = document.getElementById("sp_hinh-upload");
                                          var src;
                                                image_upload.addEventListener("change", function (e) {
                                                if (e.target.files.length) {
                                                            src = URL.createObjectURL(e.target.files[0]);
                                                            preview_image.src = src;
                                                      }
                                                });
                                    </script>
      
                                    <div class="form-item w-30">
                                          <label class="form-item-name">Xuất xứ : <span class="input_obligatory"> * </span></label>  
                                          <input name="address" type="text" class="form-item-input input_import import_address" placeholder="Nhập xuất xứ"/>
                                    </div>

                                    <div class="form-item w-30">
                                          <label class="form-item-name">Nhóm hàng : <span class="input_obligatory"> * </span></label>  
                                          <select name="cate" type="text" class="form-item-input select_cate select_import import_cate">
                                                             <option class="cate_import" expiry="0" value="">Chọn nhóm hàng</option>
                                                <?php 
                                                      $Cates = $db->conn->query("SELECT * FROM nhomhang");
                                                      foreach ($Cates as $cate) {
                                                            ?> 
                                                               <option class="cate_import" expiry="<?=$cate['hansudung']?>" value="<?=$cate['id_nhomhang']?>"><?=$cate['tennhomhang']?></option>
                                                            <?php
                                                      }
                                                ?>
                                          </select>
                                    </div>

                                    
                                    <div class="form-item w-30">
                                          <label class="form-item-name">Ghi chú :</label>  
                                          <input name="note" type="text" class="form-item-input import_note" placeholder="Nhập ghi chú"/>
                                    </div>
                                    
                                    <div class="form-item w-30 form-expiry hidden">
                                          <label class="form-item-name">Hạn sử dụng : <span class="input_obligatory"> * </span></label>  
                                          <input style="text-align: center; padding: 0" name="expiry" type="text" class="form-item-input import_expiry" placeholder="Ví dụ: 30"/>
                                          <span style="padding: 0 30px; font-weight: bold">Ngày</span>
                                    </div>

                                    <div class="form-item" style="display: flex">
                                          <button type="button" name="add_product" class="btn save-btn submit_import">Thêm vào đơn</button>
                                    </div>


                              </form>

                              <div class="box_table_show" style="margin-top: 10px;">
                                    <table border="1" class="table_show_product">
                                         <thead>
                                             <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn vị</th>
                                                <th>Giá nhập</th>
                                                <th>Giá bán lẻ</th>
                                                <th>Giá bán sĩ</th>
                                                <th>Ngày hết hạn</th>
                                                <th>Nhóm hàng</th>
                                                <th>Xuất xứ</th>
                                                <th>Tổng tiền</th>
                                                <th>Ghi chú</th>
                                                <th>Xóa</th>
                                             </tr>
                                         </thead>
                                    <?php 
                                     if (!function_exists('currency_format')) {
                                       function currency_format($number, $suffix = ' vnđ')
                                       {
                                         if (!empty($number)) {
                                           return number_format($number, 0, ',', '.') . "{$suffix}";
                                         }
                                       }
                                     }
                                       if (isset($_SESSION['products'])) {

                                          foreach ($_SESSION['products'] as $key =>$product) {
                                               ?> 
                                                <tbody>
                                                      <tr style="text-align: center;">
                                                            <td><?=$product['name']?></td>
                                                            <td><?=$product['quantity']?></td>
                                                            <td><?=$product['name_unit']?></td>
                                                            <td><?=currency_format($product['price'])?></td>
                                                            <td><?=currency_format($product['price_sell'])?></td>
                                                            <td><?=currency_format($product['price_export'])?></td>
                                                            <td><?=$product['expiry']?></td>
                                                            <td><?=$product['name_cate']?></td>
                                                            <td><?=$product['address']?></td>
                                                            <td><?=currency_format($product['quantity'] * $product['price'])?></td>
                                                            <td><?=$product['note']?></td>
                                                            <td class="icon-table"><a href="?c=import&a=delete_import&id=<?= $key ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
                                                      </tr>
                                                </tbody>
                                               <?php
                                          }
                                       }
                                      
                                    ?>
                                    </table>
                              </div>

                        </div>
                        <?php
                } else {
                        ?> 
                              <form action="?c=import&a=import" method="POST" class="form-add-wrapper">
                                    <div class="content-title form-add-title">
                                          <h4><i class="fa-solid fa-plus"></i> Thông tin phiếu nhập:</h4>
                                    </div>
                                    <div class="form-add-container">

                                          <div class="form-item w-30">
                                                <label class="form-item-name">Kho nhập hàng: <span class="input_obligatory"> * </span></label>  
                                                <select name="store" class="form-item-input select_start_import">
                                                            <option value="">Chọn kho</option>
                                                            <?php 
                                                            if (isset($distributors)) {
                                                                  foreach ($stores as $store) {
                                                                        ?> 
                                                                        <option value="<?=$store['id_kho']?>"><?=$store['tenkho']?></option>
                                                                        <?php
                                                                  }
                                                            }
                                                            ?>
                                                </select>
                                          </div>

                                          <div class="form-item w-30">
                                                <label class="form-item-name">Nhà phân phối: <span class="input_obligatory"> * </span></label>
                                                <select name="distributor" class="form-item-input select_start_import">
                                                            <option value="">Chọn nhà phân phối</option>
                                                            <?php 
                                                            if (isset($distributors)) {
                                                                  foreach ($distributors as $distributor) {
                                                                        ?> 
                                                                        <option value="<?=$distributor['id_nhaphanphoi']?>"><?=$distributor['tennhaphanphoi']?></option>
                                                                        <?php
                                                                  }
                                                            }
                                                            ?>
                                                </select>
                                          </div>


                                          <div class="form-item w-30" style="display: flex">
                                                <button type="button" name="submit_import" class="btn save-btn submit_startt">Nhập</button>
                                           </div>
                                    </div>
                              </form>
                        <?php
                }
            ?>
       </div>

       <?php 
         if (isset($complete)) {
            ?> 
                  <div class="store-invoice-view">
                        <div class="content-invoice">
                              <?php require_once 'invoice_import.php'; ?>
                        </div>
                  </div>
            <?php
         }
       ?>
</div>