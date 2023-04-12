<div id="store_export_view" class="aside-item hidden roles-content">
<div class="content-add-roles pos-relative">
           <div class="content-title">
                  <h4>Xuất kho :</h4>
            </div>


            <?php 
                if (isset($_SESSION['export_store'])) {
                        ?>
                        <div class="form-add-container">
                              <div class="form-item w-40">
                                    <label class="title_import">Kho nhập hàng: 
                                          <h2><?=$_SESSION['export_store']['kho']['name']?></h2>
                                    </label>
                              </div>

                              <div class="form-item w-40">
                                    <label class="title_import">Khách hàng: 
                                          <h2><?=$_SESSION['export_store']['khachhang']['name']?></h2>
                                    </label>
                              </div>


                              <div class="form-item w-20">
                                    <form action="?c=export&a=cancel_export" method="POST" style="margin-right: 20px">
                                          <button type="submit" name="cancel_export" class="btn save-btn">Hủy đơn</button>
                                    </form>

                                    <form action="?c=export&a=go_invoice" method="POST">
                                          <button type="submit" name="complete" class="btn save-btn">Hoàn tất</button>
                                    </form>
                              </div>

                              <form action="?c=export&a=export" method="POST" class="form-add-container" enctype="multipart/form-data">

                              <div class="form-item w-30 container_offer">
                                          <label class="form-item-name">Tên sản phẩm : <span class="input_obligatory"> * </span></label>
                                          <input class="form-item-input input_export input_export_validate" id="input_export" name="name_products" type="text" placeholder="Nhập để tìm kiếm sản phẩm">
                                          <div class="export_products">
                                          </div> 
                                    </div>
                                    
                                    <ul class="box-list-export" style="display: none">
                                          <?php 
                                                require_once PATH_APPLICATION . '/core/Base_Model.php';
                                                $db= new Base_Model();
                                                $id_kho = $_SESSION['export_store']['kho']['id'];
                                                $Products_export = $db->conn->query("SELECT * FROM hanghoa WHERE kho = '$id_kho'");

                                                foreach ($Products_export as $product) {
                                                      ?> 
                                                        <li class="product_export"><?=$product['tenhanghoa']?></li>
                                                      <?php
                                                }
                                          ?>
                                    </ul> 
      
                                    <div class="form-item w-30">
                                          <label class="form-item-name">Số lượng : <span class="input_obligatory"> * </span></label>  
                                          <input name="quantity" type="number" class="form-item-input input_quantity_export input_export_validate" placeholder="Chỉ được nhập số"/>
                                    </div>

                                    <div class="form-item w-30">
                                          <label class="form-item-name">Ghi chú :</label>  
                                          <input name="note" type="text" class="form-item-input" placeholder="Nhập ghi chú"/>
                                    </div>

      
                                    <div class="form-item" style="display: flex">
                                          <button type="button" name="add_product" class="btn save-btn submit_add_export">Thêm vào đơn</button>
                                    </div>


                              </form>

                              <div class="box_table_show" style="margin-top: 10px;">
                                    <table border="1" class="table_show_product">
                                         <thead>
                                             <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Nhóm hàng</th>
                                                <th>Xuất xứ</th>
                                                <th>Giá nhập</th>
                                                <th>Giá bán lẻ</th>
                                                <th>Giá bán sĩ</th>
                                                <th>Đơn vị</th>
                                                <th>Số lượng</th>
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
                                       if (isset($_SESSION['products_export'])) {

                                          foreach ($_SESSION['products_export'] as $key =>$product) {
                                               ?> 
                                                <tbody>
                                                      <tr style="text-align: center;">
                                                            <td><?=$product['name']?></td>
                                                            <td><?=$product['cateProduct']?></td>
                                                            <td><?=$product['address']?></td>
                                                            <td><?=currency_format($product['price'])?></td>
                                                            <td><?=currency_format($product['price_sell'])?></td>
                                                            <td><?=currency_format($product['price_export'])?></td>
                                                            <td><?=$product['unit']?></td>
                                                            <td><?=$product['quantity']?></td>
                                                            <td><?=currency_format($product['quantity'] * $product['price'])?></td>
                                                            <td><?=$product['note']?></td>
                                                            <td class="icon-table"><a href="?c=export&a=delete_export&id=<?= $key ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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
                              <form action="?c=export&a=export" method="POST" class="form-add-wrapper">
                                    <div class="content-title form-add-title">
                                          <h4><i class="fa-solid fa-plus"></i> Thông tin phiếu xuất:</h4>
                                    </div>
                                    <div class="form-add-container">

                                          <div class="form-item w-30">
                                                <label class="form-item-name">Kho nhập hàng: <span class="input_obligatory"> * </span></label>  
                                                <select name="store" class="form-item-input select_start_export">
                                                            <option value="">Chọn kho</option>
                                                            <?php 
                                                            if (isset($stores)) {
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
                                                <label class="form-item-name">Khách hàng: <span class="input_obligatory"> * </span></label>
                                                <select name="customer" class="form-item-input select_start_export">
                                                            <option value="">Chọn</option>
                                                            <?php 
                                                            if (isset($Customers)) {
                                                                  foreach ($Customers as $customer) {
                                                                        ?> 
                                                                        <option value="<?=$customer['id_khachhang']?>"><?=$customer['hovaten']?></option>
                                                                        <?php
                                                                  }
                                                            }
                                                            ?>
                                                </select>
                                          </div>


                                          <div class="form-item w-30" style="display: flex">
                                                <button type="button" name="submit_export" class="btn save-btn submit_export">Xuất</button>
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
                              <?php require_once 'invoice_export.php'; ?>
                        </div>
                  </div>
            <?php
         }
       ?>
</div>

<script type="text/javascript">
     var export_start = document.querySelectorAll('.select_start_export')
     var submit_start = document.querySelector('.submit_export')

     
     if (submit_start) {
            export_start.forEach(start => {
                 start.setAttribute('check', false);
            })

      submit_start.addEventListener('click', function () {
                        export_start.forEach(start => {
                        if (start.value == "") {
                              const option = document.createElement("option");
                              option.value = "0"
                              option.innerText = "Bạn chưa chọn trường này !";
                              start.appendChild(option)
                              start.value = "0"
                              start.style.color = "red";
                        }
                  })
            })

      export_start.forEach(start => {
                  start.addEventListener("mousedown", function(e) {
                        for (var i = 0; i < start.children.length; i++) {
                              if (start.children[i].value == "0") {
                                    start.children[i].remove();
                              }
                        }
                        start.style.color = "black"
                  })

                  start.addEventListener('change', function(e) {
                        if (e.target.value == "") {
                              const option = document.createElement("option");
                              option.value = "0"
                              option.innerText = "Vui lòng chọn trường này";
                              start.appendChild(option)
                              start.value = "0"
                              start.style.color = "red";
                              start.style.padding = "0 20px"
                              start.setAttribute('check', false);
                              submit_start.type= 'button';
                        } else {
                              start.setAttribute('check', true);
                        }
                        complete_start()
                  })

            })

      function complete_start () {
            var check = 0

                  export_start.forEach(start => {
                        if (start.getAttribute('check') == "false") {
                              check++
                        }
                  })

                  if (check == 0) {
                        submit_start.type= 'submit';
                  }
            }

     }


     var export_input = document.querySelectorAll('.input_export_validate')
     var export_submit = document.querySelector('.submit_add_export')
     
     if (export_submit) {
           export_input.forEach(item => {
                 item.setAttribute('check', false);
            })
            
            export_input.forEach(item => {
                  item.addEventListener('blur', function () {
                          complete_export()
                  })
            })
      
            export_submit.addEventListener("click", function(e) {
                  export_input.forEach(item => {
                        if (item.value == "") {
                              item.placeholder = "Bạn chưa nhập trường này !"
                              item.classList.add('error_input')
                        }
                   })
           })
      

           export_input.forEach(item => {
                  item.addEventListener("keyup", function(e) {
                        if (item.value == "") {
                            item.placeholder = "Vui lòng nhập trường này !"
                            item.classList.add('error_input')
                            item.setAttribute('check', false)
                            export_submit.type = "button"
                        } else {
                              item.setAttribute('check', true)
                        }
                        complete_export()
                  })
            })

            var input_quantity_export = document.querySelector('.input_quantity_export')

            input_quantity_export.addEventListener("change", function(e) {
                  if (e.target.value < 0) {
                        e.target.value = ''
                        e.target.placeholder = "Vui lòng nhập số lượng tối thiểu là 1"
                        e.target.classList.add("error_input")
                        export_submit.type = "button"
                        e.target.setAttribute('check', false)
                  } else {
                        e.target.setAttribute('check', true)
                  }
                  complete_export()
            })

            function complete_export () {
                  var check = 0;
                  export_input.forEach(item => {
                        if (item.getAttribute('check') == "false") {
                              check++
                        }
                  })

                  if (check == 0) {
                        export_submit.type = "submit"
                  }
            }

     }




</script>