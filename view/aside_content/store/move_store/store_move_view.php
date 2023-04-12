<?php
require_once PATH_APPLICATION . '/core/Base_Model.php';
$db = new Base_Model();
$Stores = $db->conn->query("SELECT * FROM kho");

foreach ($Stores as $store) {
?>
      <div id="store_move_view<?= $store['id_kho'] ?>" class="aside-item hidden roles-content">
            <div class="content-add-roles pos-relative">
                  <div class="content-title" style="background: var(--main_bgc)">
                        <div class="box_search_expired d-flex" style="align-items: center">
                              <h4> + <?= $store['tenkho'] ?>:</h4>
                              <div class="search_ckeck">
                                    <input class="input_search_move" type="text" placeholder="Tìm kiếm sản phẩm">
                                    <i class="fa-solid fa-magnifying-glass" style="color: black"></i>
                              </div>
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
                                                <th>Chuyển</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                          $i = 1;
                                          $id_store = $store['id_kho'];
                                          $product = $db->conn->query("SELECT * FROM hanghoa a, nhomhang b, donvitinh c WHERE a.nhomhang = b.id_nhomhang AND a.donvitinh = c.id_donvitinh AND a.kho = '$id_store'");
                                          foreach ($product as $item) {
                                          ?>
                                                <tr style="text-align: center;">
                                                      <td><?= $i++ ?></td>
                                                      <td class="name_move" style="text-align: left;"><?= $item['tenhanghoa'] ?></td>
                                                      <td><?= $item['soluong'] ?></td>
                                                      <td><?= $item['tendonvitinh'] ?></td>
                                                      <td><?= $item['tennhomhang'] ?></td>
                                                      <td><button class="btn_move_store" id="<?= $item['soluong'] ?>" number="<?= $store['id_kho'] ?>" name="quantity_move" type="button" value="<?= $item['id_hanghoa'] ?>"><i class="fa-solid fa-arrow-right-arrow-left"></i></button></td>
                                                </tr>
                                          <?php
                                          }
                                          ?>
                                    </tbody>
                              </table>
                        </div>
                  </div>
                  <div class="not_find" style="color: red; font-size: 15px; margin-left: 30px"></div>
            </div>
      </div>
      <script type="text/javascript">
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

                  for (var i = 0; i < AccentsMap.length; i++) {
                        var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
                        var char = AccentsMap[i][0];
                        str = str.replace(re, char);
                  }
                  return str;
            }


            prducts_check_list = [];
            var name_products_move = document.querySelectorAll('.name_move')
            var input_search_move = document.querySelectorAll('.input_search_move')
            var not_find = document.querySelectorAll('.not_find')

            name_products_move.forEach(item => {
                  prducts_check_list.push(item.innerText);
            })

            if (input_search_move) {
                  input_search_move.forEach(input => {
                        input.addEventListener('keyup', function(e) {
                              let search = prducts_check_list.filter(value => {
                                    var valueRemoveAccents = removeAccents(value)
                                    return valueRemoveAccents.toUpperCase().includes(e.target.value.toUpperCase())
                              })
                              if (e.target.value.length > 0) {
                                    name_products_move.forEach(item => {
                                          console.log(item.parentElement);
                                          item.parentElement.classList.add('hidden')
                                    })
                                    
                                    if (search.length == 0) {
                                          not_find.forEach(item => item.innerHTML = `<span> - Không tìm thấy kết quả với từ khóa :  '${e.target.value}'</span>`)
                                    }

                                    search.forEach(value => {
                                          name_products_move.forEach(name => {
                                                if (name.innerText == value) {
                                                      name.parentElement.classList.remove('hidden')
                                                      not_find.forEach(item => item.innerHTML = "")
                                                }
                                          })
                                    })
                              } else {
                                    not_find.forEach(item => item.innerHTML = "")
                                    name_products_move.forEach(item => {
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