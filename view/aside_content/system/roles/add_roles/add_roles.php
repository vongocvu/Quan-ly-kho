<div id="add-roles" class="aside-item hidden roles-content">

      <?php
      if (isset($role_edit)) {
            $row = $role_edit->fetch_assoc();
      ?>
            <form action="?c=roles&a=edit&id=<?= $row['id_roles'] ?>" method="POST" class="form-add-wrapper">
                  <div class="content-title form-add-title">
                        <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa quyền quản trị</h4>
                  </div>
                  <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Tên quyền: </label>
                              <input value="<?= $row['tenroles'] ?>" class="form-item-input" type="text" name="name_roles" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Vai trò: </label>
                              <input value="<?= $row['vaitro'] ?>" class="form-item-input" type="text" name="position_roles" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Diễn giải:</label>
                              <input value="<?= $row['ghichu'] ?>" class="form-item-input" type="text" name="note_roles" placeholder="Nhập thông tin">
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
                  <form action="?c=roles&a=add" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Thêm quyền quản trị</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên quyền: <span class="input_obligatory"> * </span></label>
                                    <input class="form-item-input input_role" type="text" name="name_roles" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Vai trò: <span class="input_obligatory"> * </span></label>
                                    <input class="form-item-input input_role" type="text" name="position_roles" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Diễn giải:<span class="input_obligatory"> * </span></label>
                                    <input class="form-item-input input_role" type="text" name="note_roles" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                                    <button type="button" name="submit_add" class="btn save-btn submit_role">Thêm</button>
                              </div>
                        </div>
                  </form>
            </div>
            <div class="content-table-container">
                  <div class="content-title">
                        <h4>Danh sách quyền quản trị hiện có</h4>
                  </div>
                  <div class="box_table_scroll">
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Mã nhóm</th>
                                    <th>Vai trò</th>
                                    <th>Diễn giải</th>
                                    <th>Kích hoạt</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                    <th></th>
                              </tr>
                        </thead>

                        <tbody>
                                    <?php
                                    if (isset($Roles)) {
                                          foreach ($Roles as $role) {
                                    ?>
                                                <tr style="text-align: center;">
                                                      <td></td>
                                                      <td><?= $role['tenroles'] ?></td>
                                                      <td><?= $role['vaitro'] ?></td>
                                                      <td><?= $role['ghichu'] ?></td>
                                                      <td>
                                                            <form action="?c=roles&a=active_roles&id=<?= $role['id_roles'] ?>" method="POST">
                                                                  <input name="status_active" type="checkbox" <?php if($role['kichhoat'] == 1) { echo 'value=1 checked';} else {  echo 'value=0';}?>>
                                                                  <button style="background-color: transparent;border:none" type="submit" name="submit_active" class="btn">Cập nhật</button>
                                                            </form>
                                                      </td>
                                                      <td class="icon-table"><a href="?c=roles&a=edit&id=<?= $role['id_roles'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                      <td class="icon-table"><a href="?c=roles&a=delete&id=<?= $role['id_roles'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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
      var input_role = document.querySelectorAll('.input_role')
      var submit_role = document.querySelector('.submit_role')

      input_role.forEach(item => {
            item.setAttribute('check', false)
      })
      
      submit_role.addEventListener("click", function (e) {
            input_role.forEach(item => {
                  if (item.value == "") {
                        item.placeholder = "Bạn chưa nhập trường này !"
                        item.classList.add('error_input')
                  }
            })
      })

      input_role.forEach(item => {
            item.addEventListener("keyup", function (e) {
                  if (item.value == "") {
                        item.setAttribute('check', false)
                  } else {
                        item.setAttribute('check', true)
                  }
                  complete_role();
            })
      })


      function complete_role () {
            var error = 0;
            input_role.forEach(item => {
                  if (item.getAttribute('check') == "false") {
                        error++
                  }
            })

            if (error == 0) {
                  submit_role.type = 'submit';
            } else {
                  submit_role.type = 'button';
            }
      }


     
</script>