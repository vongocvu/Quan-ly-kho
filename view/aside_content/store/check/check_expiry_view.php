<?php 
    require_once PATH_APPLICATION . '/core/Base_Model.php';
    $db = new Base_Model();
    $Stores = $db->conn->query("SELECT * FROM kho");

    foreach ($Stores as $store) {
      ?> 
            <div id="products_expired_view<?=$store['id_kho']?>" class="aside-item hidden roles-content">
                  <div class="content-add-roles pos-relative">
                        <div class="content-title d-flex" style="justify-content: space-between; background: var(--main_bgc)">
                              <div class="box_search_expired d-flex">
                                    <span style="color: white">Tìm kiếm sản phẩm: </span>
                                    <div class="search_ckeck">
                                          <input class="input_search_check" type="text" placeholder="Tìm kiếm sản phẩm">
                                          <i class="fa-solid fa-magnifying-glass"></i>
                                    </div>
                              </div>
                              <div class="box_search_expired">
                                    <span style="color: white">Bộ lọc số lượng: </span>
                                    <select name="" class="form-select select_quantity">
                                          <option value="all">Hiển thị tất cả</option>
                                          <option value="0">Sản phẩm đã hết hàng</option>
                                          <option value="50">Còn dưới 50 sản phẩm</option>
                                          <option value="100">Còn dưới 100 sản phẩm</option>
                                          <option value="200">Còn dưới 200 sản phẩm</option>
                                          <option value="500">Còn dưới 500 sản phẩm</option>
                                          <option value="1000">Còn dưới 1000 sản phẩm</option>
                                          <option value="2000">Còn dưới 2000 sản phẩm</option>
                                    </select>
                              </div>
                              <div class="box_search_expired">
                                    <span style="color: white">Bộ lọc ngày hết hạn: </span>
                                    <select name="" class="form-select select_expiry">
                                          <option value="all">Hiển thị tất cả</option>
                                          <option value="5">Còn dưới 5 ngày</option>
                                          <option value="10">Còn dưới 10 ngày</option>
                                          <option value="15">Còn dưới 15 ngày</option>
                                          <option value="20">Còn dưới 20 ngày</option>
                                          <option value="25">Còn dưới 25 ngày</option>
                                          <option value="30">Còn dưới 30 ngày</option>
                                    </select>
                              </div>
                        </div>
                         <div class="box_move">
                              <div class="table_move">
                                    <table border="1">
                                          <thead>
                                                <tr>
                                                      <th>STT</th>
                                                      <th>Tên sản phẩm</th>
                                                      <th>Số lượng</th>
                                                      <th>Đơn vị</th>
                                                      <th>Nhóm hàng</th>
                                                      <th>Ngày nhập kho</th>
                                                      <th>Ngày hết hạn</th>
                                                      <th>Ghi chú</th>
                                                </tr>
                                          </thead>
                                          <tbody >
                                                <?php 
                                                $i = 1;
                                                   $id_store = $store['id_kho'];
                                                   $product = $db->conn->query("SELECT *,a.ghichu as ghichusanpham FROM hanghoa a, nhomhang b, donvitinh c
                                                                               WHERE a.nhomhang = b.id_nhomhang AND a.donvitinh = c.id_donvitinh AND a.kho = '$id_store'");
                                                   foreach ($product as $item) {
                                                         $id_hanghoa = $item['id_hanghoa'];
                                                         $date_expiry = $db->conn->query("SELECT DATEDIFF(CURDATE(), ngaynhapkho) AS ngayhethan, hansudung FROM hanghoa WHERE id_hanghoa = '$id_hanghoa'");
                                                         $row = $date_expiry->fetch_assoc();
                                                           ?> 
                                                              <tr style="text-align: center;" class="tr" quantity="<?=$item['soluong']?> "expiry="<?=$row['hansudung'] - $row['ngayhethan']?>">
                                                                  <td><?=$i++?></td>
                                                                  <td class="name_product" style="text-align: left;"><?=$item['tenhanghoa']?></td>
                                                                  <td><span style="color: red; font-weight: bold"><?php if ($item['soluong'] == 0) { echo 'Hết hàng';} else { echo $item['soluong'];}?></span></td>
                                                                  <td><?=$item['tendonvitinh']?></td>
                                                                  <td><?=$item['tennhomhang']?></td>
                                                                  <td><?=$item['ngaynhapkho']?></td>
                                                                  <td>Còn <span style="color: red; font-weight: bold"><?=$row['hansudung'] - $row['ngayhethan']?></span> Ngày</td>
                                                                  <td><?=$item['ghichusanpham']?></td>
                                                              </tr>
                                                           <?php 
                                                      }
                                                ?>

                                                
                                          </tbody>
                                    </table>
                                    <div class="table_body"></div>
                              </div>

                         </div>
                  </div>
            </div>
            <script type="text/javascript">
                  var select_expiry = document.querySelectorAll('.select_expiry')
                  var tr = document.querySelectorAll('.tr')
                  select_expiry.forEach(select => {
                        select.addEventListener('change', function (e) {
                              tr.forEach(item => {
                                    item.classList.add('hidden')
                              if (parseInt(item.getAttribute('expiry')) <= parseInt(e.target.value)) {
                                    item.classList.remove('hidden')
                              }
                              
                              
                        })

                        if (e.target.value == 'all') {
                              tr.forEach(item => {
                                    item.classList.remove('hidden')
                              })
                        }
                        })
                  })

                  var select_quantity = document.querySelectorAll('.select_quantity')
                  select_quantity.forEach(select => {
                        select.addEventListener('change', function (e) {
                              tr.forEach(item => {
                                    item.classList.add('hidden')
                              if (parseInt(item.getAttribute('quantity')) <= parseInt(e.target.value)) {
                                    item.classList.remove('hidden')
                              }
                              
                              
                        })

                        if (e.target.value == 'all') {
                              tr.forEach(item => {
                                    item.classList.remove('hidden')
                              })
                        }
                        })
                  })

                  function removeAccents(str) {
                  var AccentsMap = [
                  "aàảãáạăằẳẵắặâầẩẫấậ",
                  "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
                  "dđ", "DĐ",
                  "eèẻẽéẹêềểễếệ",
                  "EÈẺẼÉẸÊỀỂỄẾỆ",
                  "iìỉĩíị",
                  "IÌỈĨÍỊ",
                  "oòỏõóọôồổỗốộơờởỡớợ",
                  "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
                  "uùủũúụưừửữứự",
                  "UÙỦŨÚỤƯỪỬỮỨỰ",
                  "yỳỷỹýỵ",
                  "YỲỶỸÝỴ"    
                  ];

                  for (var i=0; i<AccentsMap.length; i++) {
                  var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
                  var char = AccentsMap[i][0];
                  str = str.replace(re, char);
                  }
                  return str;
            }


                  prducts_check_list = [];
                  var name_products = document.querySelectorAll('.name_product')
                  var input_search_check = document.querySelectorAll('.input_search_check')
                  var table_body = document.querySelectorAll('.table_body')

                  name_products.forEach(item => {
                  prducts_check_list.push(item.innerText);
                  })

                  if (input_search_check) {
                  input_search_check.forEach(input => {
                        input.addEventListener('keyup', function (e) {
                              let search = prducts_check_list.filter(value => {
                                    var valueRemoveAccents = removeAccents(value).trim()
                                    return valueRemoveAccents.toUpperCase().includes(e.target.value.toUpperCase().trim())
                              })

                              if (e.target.value.length > 0) {
                                    name_products.forEach(item => {
                                          item.parentElement.classList.add('hidden')
                                    })

                                    if (search.length == 0) {
                                          table_body.forEach(item => item.innerHTML = `<span>Không tiềm thấy kết quả với từ khóa :  '${e.target.value}'</span>`)
                                    }
                                    search.forEach(value => {
                                          name_products.forEach(name => {
                                                      if (name.innerText == value) {
                                                            name.parentElement.classList.remove('hidden')
                                                            table_body.forEach(item => item.innerHTML = "")
                                                      }
                                                })
                                    })
                              } else {

                                    table_body.forEach(item => item.innerHTML = "")
                                    name_products.forEach(item => {
                                          item.parentElement.classList.remove('hidden')
                                    })
                              }
                              

                              
                        })

                  })
                  }


                  

      </script>
      <?php 
    }
 ?>

