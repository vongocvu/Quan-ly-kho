<div id="users_table_view" class="aside-item hidden roles-content">

      <?php
      if (isset($user_edit)) {
            $row = $user_edit->fetch_assoc();
      ?>
            <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa tài khoản</h4>
                  </div>
                  <form action="?c=users&a=edit&id=<?=$row['id_nhanvien']?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Thêm tài khoản</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Họ:</label>
                                    <input value="<?= $row['tenlot'] ?>" class="form-item-input" type="text" name="last_name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên:</label>
                                    <input value="<?= $row['tennhanvien'] ?>" class="form-item-input" type="text" name="first_name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Giới tính:</label>
                                    <select name="sex" class="form-item-input">
                                          <option value="0">Chọn giới tính</option>
                                          <option <?php if ($row['gioitinh'] == 1) {
                                                            echo 'selected';
                                                      } ?> value="1">Nam</option>s
                                          <option <?php if ($row['gioitinh'] == 2) {
                                                            echo 'selected';
                                                      } ?> value="2">Nữ</option>
                                          <option <?php if ($row['gioitinh'] == 3) {
                                                            echo 'selected';
                                                      } ?> value="3">Khác</option>
                                    </select>
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Ngày sinh:</label>
                                    <input value="<?= $row['ngaysinh'] ?>" class="form-item-input" type="date" name="birthday" placeholder="Nhập thông tin">
                              </div>


                              <div class="form-item w-30">
                                    <label class="form-item-name">Email:</label>
                                    <input value="<?= $row['email'] ?>" class="form-item-input" type="email" name="email" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Số điện thoại:</label>
                                    <input value="<?= $row['sodienthoai'] ?>" class="form-item-input" type="text" name="phone" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Địa chỉ:</label>
                                    <input value="<?= $row['diachi'] ?>" class="form-item-input" type="text" name="address" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Bộ phận:</label>
                                    <select name="part" class="form-item-input">
                                          <option value="0">Chọn bộ phận</option>
                                          <?php
                                          if (isset($parts)) {
                                                foreach ($parts as $part) {
                                          ?>
                                                      <option <?php if ($row['bophan'] == $part['id_bophan']) {
                                                                        echo 'selected';
                                                                  } ?> value="<?= $part['id_bophan'] ?>"><?= $part['tenbophan'] ?></option>
                                          <?php
                                                }
                                          }
                                          ?>
                                    </select>
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Chức vụ:</label>
                                    <select name="position" class="form-item-input">
                                          <option value="0">Chọn chức vụ</option>
                                          <?php
                                          if (isset($positions)) {
                                                foreach ($positions as $pos) {
                                          ?>
                                                      <option <?php if ($row['chucvu'] == $pos['id_chucvu']) {
                                                                        echo 'selected';
                                                                  } ?> value="<?= $pos['id_chucvu'] ?>"><?= $pos['tenchucvu'] ?></option>
                                          <?php
                                                }
                                          }
                                          ?>
                                    </select>
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Quyền điều hành:</label>
                                    <select name="roles" class="form-item-input">
                                          <option value="0">Chọn quyền</option>
                                          <?php
                                          if (isset($roles)) {
                                                foreach ($roles as $role) {
                                          ?>
                                                      <option <?php if ($row['id_roles'] == $role['id_roles']) {
                                                                        echo 'selected';
                                                                  } ?> value="<?= $role['id_roles'] ?>"><?= $role['tenroles'] ?></option>
                                          <?php
                                                }
                                          }
                                          ?>
                                    </select>
                              </div>

                              <div class="form-item w-30"></div>

                              <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                                    <button type="submit" name="submit_update" class="btn save-btn">Cập nhật</button>
                              </div>
                        </div>
                  </form>
            </div>
      <?php
      } else {
      ?>
            <div class="content-table-container">
                  <div class="content-title">
                        <h4>Danh sách tài khoản hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr >
                                    <th></th>
                                    <th>Họ và tên</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Bộ phận</th>
                                    <th>Chức vụ</th>
                                    <th>Quyền quản trị</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($All_user)) {
                                    foreach ($All_user as $user) {
                              ?>
                                          <tr style="text-align: center">
                                                <td></td>
                                                <td><?= $user['hovaten'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td>
                                                      <?php
                                                      if ($user['gioitinh'] == 1) {
                                                            echo 'Nam';
                                                      }
                                                      if ($user['gioitinh'] == 2) {
                                                            echo 'Nữ';
                                                      }
                                                      if ($user['gioitinh'] == 3) {
                                                            echo 'Bê đê';
                                                      }
                                                      ?>

                                                </td>
                                                <td><?= $user['sodienthoai'] ?></td>
                                                <td><?= $user['diachi'] ?></td>
                                                <td><?= $user['tenbophan'] ?></td>
                                                <td><?= $user['tenchucvu'] ?></td>
                                                <td><?= $user['tenroles'] ?></td>
                                                <td class="icon-table"><a href="?c=users&a=edit&id=<?= $user['id_nhanvien'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=users&a=delete&id=<?= $user['id_nhanvien'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
                                          </tr>
                              <?php
                                    }
                              }

                              ?>

                        </tbody>
                  </table>
            </div>


      <?php
      }
      ?>
</div>