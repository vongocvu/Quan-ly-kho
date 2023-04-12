<?php 
      require_once PATH_APPLICATION . '/core/Base_Model.php';
            $db = new Base_Model();
            foreach ($_SESSION['function'] as $key => $value) {
                  if ($key == 2 && $value['truycap'] == 1 && $value['them'] == 1 ) { 
                        $users = $db->conn->query("SELECT *, CONCAT(tenlot, ' ', tennhanvien) as hovaten FROM nhanvien");
                        $Storess = $db->conn->query("SELECT *, CONCAT(tenlot, ' ', tennhanvien) as hovaten FROM nhanvien a, kho b WHERE a.id_nhanvien = b.quanlykho");
                  }
            }
      ?>
<div id="store_add_view" class="aside-item hidden roles-content">

      <?php
      if (isset($store_edit)) {
            $row = $store_edit->fetch_assoc();
      ?>
            <form action="?c=store&a=edit&id=<?= $row['id_kho'] ?>" method="POST" class="form-add-wrapper">
                  <div class="content-title form-add-title">
                        <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa kho</h4>
                  </div>
                  <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Tên kho:</label>
                              <input value="<?= $row['tenkho'] ?>" class="form-item-input" type="text" name="name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name ">Quản lý kho:</label>
                              <select name="admin" class="form-item-input">
                                    <option value="">Chọn quản lý</option>
                                    <?php 
                                          if(isset($users)) {
                                          foreach($users as $user) {
                                                ?> 
                                                      <option <?php if ($user['id_nhanvien'] == $row['quanlykho']) { echo 'selected';}?> value="<?=$user['id_nhanvien']?>"><?=$user['hovaten']?></option>
                                                <?php
                                          }
                                          }
                                    ?>
                              </select>
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ghi chú:</label>
                              <input value="<?= $row['ghichu'] ?>" class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="submit" name="submit_update" class="btn save-btn">Cập nhật</button>
                        </div>
                  </div>
            </form>
           
      <?php
      } else {
      ?>
        

            <div class="content-add-roles">
                  <form action="?c=store&a=add" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Thêm kho</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên kho: <span class="input_obligatory"> * </span></label>
                                    <input class="form-item-input store_input" type="text" name="name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Quản lý kho: <span class="input_obligatory"> * </span></label>
                                    <td>
                                    <select name="admin" class="form-item-input store_select">
                                          <option value="">Chọn quản lý</option>
                                         <?php 
                                             if(isset($users)) {
                                                foreach($users as $user) {
                                                      ?> 
                                                          <option value="<?=$user['id_nhanvien']?>"><?=$user['hovaten']?></option>
                                                      <?php
                                                }
                                             }
                                         ?>
                                    </select>
                              </td>
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Ghi chú:</label>
                                    <input class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                                    <button type="button" name="submit_add" class="btn save-btn store_submit">Thêm</button>
                              </div>
                        </div>
                  </form>
            </div>
            <div class="content-table-container">
                  <div class="content-title">
                        <h4>Danh sách kho hiện có</h4>
                  </div>
                  <div class="box_table_scroll">
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Tên kho</th>
                                    <th>Quản lý kho</th>
                                    <th>Ghi chú</th>
                                    <th>Kích hoạt</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                    <th></th>
                              </tr>
                        </thead>

                        <tbody>
                                    <?php
                                    if (isset($Storess)) {
                                          foreach ($Storess as $store) {
                                    ?>
                                                <tr style="text-align: center;">
                                                      <td></td>
                                                      <td><?= $store['tenkho'] ?></td>
                                                      <td><?= $store['hovaten'] ?></td>
                                                      <td><?= $store['ghichu'] ?></td>
                                                      <td>
                                                            <form action="?c=store&a=active_store&id=<?= $store['id_kho'] ?>" method="POST">
                                                                  <input name="status_active" type="checkbox" <?php if($store['kichhoat'] == 1) { echo 'value=1 checked';} else {  echo 'value=0';}?>>
                                                                  <button style="background-color: transparent;border:none" type="submit" name="submit_active" class="btn">Cập nhật</button>
                                                            </form>
                                                      </td>
                                                      <td class="icon-table"><a href="?c=store&a=edit&id=<?= $store['id_kho'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                      <td class="icon-table"><a href="?c=store&a=delete&id=<?= $store['id_kho'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
                                                      <td></td>
                                                </tr>
                                    <?php
                                          }
                                    }
                                    ?>
                              </tbody>
                        </table>
                  </div>
            </div>
            <?php
      }
            ?>
</div>      

<script type="text/javascript">
                  var store_input = document.querySelector('.store_input');
                  var store_select = document.querySelector('.store_select');
                  var store_submit = document.querySelector('.store_submit');

                  store_input.setAttribute('check', false)
                  store_select.setAttribute('check', false)
                  
                  store_submit.addEventListener('click', function (e) {
                        if (store_input.value == "") {
                              store_input.placeholder = "Bạn chưa nhập tên kho !";
                              store_input.classList.add("error_input")
                              store_input.setAttribute('check', false);
                              store_submit.type = 'button';
                        }

                        if (store_select.value == "") {
                              const option = document.createElement("option");
                              option.value = "0"
                              option.innerText = "Bạn chưa chọn quản lý kho !";
                              store_select.appendChild(option)
                              store_select.value = "0"
                              store_select.style.color = "red";
                              store_select.setAttribute('check', false);
                              store_submit.type = 'button';
                        }
                  })


                  store_input.addEventListener('keyup', function (e) {
                        if (store_input.value == "") {
                              store_submit.type = 'button';
                              store_input.setAttribute('check', false)
                        } else {
                              store_input.setAttribute('check', true)
                              complete_store()
                        }
                  })


                  store_select.addEventListener('mousedown', function (e) {
                        for (var i = 0; i < store_select.children.length; i++) {
                              if (store_select.children[i].value == "0") {
                                    store_select.children[i].remove();
                              }
                        }
                        store_select.style.color = "black"
                  })

                  store_select.addEventListener('change', function(e) {
                  if (e.target.value == "" || e.target.value == 0) {
                        const option = document.createElement("option");
                        option.value = "0"
                        option.innerText = "Vui lòng nhập trường này !";
                        store_select.appendChild(option)
                        store_select.value = "0"
                        store_select.style.color = "red";
                        store_select.style.padding = "0 20px"
                        store_submit.type = 'button';
                        store_select.setAttribute('check', false);
                  } else {
                        store_select.setAttribute('check', true);
                  }

                  complete_store()
            })


                  function complete_store () {
                        var check = 0;
                        if (store_input.getAttribute('check') == "false") {
                              check++;
                        }

                        if (store_select.getAttribute('check') == "false") {
                              check++;
                        }

                        if (check == 0) {
                            store_submit.type = 'submit';
                        }
                  }
                  
            </script>