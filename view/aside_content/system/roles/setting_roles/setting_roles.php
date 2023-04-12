<?php
if (isset($Roles)) {
      foreach ($Roles as $role) {
?>
            <div id="roles-setting<?= $role['id_roles'] ?>" class="aside-item hidden roles-content">
            <form action="?c=roles&a=update_setting&id=<?=$role['id_roles']?>" method="POST" class="content-setting-roles">
                        <div class="setting-container">
                              <div class="content-title">
                                    <h4>Bảng phân quyền</h4>
                              </div>
                              <table border="1" class="setting-table">
                                    <thead>
                                          <tr>
                                                <th>Chức năng</th>
                                                <th>Truy cập</th>
                                                <th>Thêm</th>
                                                <th>Sửa</th>
                                                <th>Xóa</th>
                                                <th>In</th>
                                                <th>Nhập</th>
                                                <th>Xuất</th>
                                          </tr>
                                    </thead>

                                    <tbody>
                                          <?php 
                                            if (isset($Functions)) {
                                                foreach ($Functions as $function) {
                                                      if ($function['id_roles'] == $role['id_roles']) {
                                                            ?> 
                                                                <tr>
                                                                        <td style="width: 15%; text-align: center; font-weight: bold"><?=$function['tenchucnang']?></td>
                                                                        <td>
                                                                              <input type="checkbox" name="truycap<?=$function['id_chucnang']?>"
                                                                              <?php if ($function['truycap'] == 1) { echo 'value=1 checked';}?>>
                                                                        </td>
                                                                        <td>
                                                                              <input type="checkbox" name="them<?=$function['id_chucnang']?>"
                                                                              <?php if ($function['them'] == 1) { echo 'value=1 checked';} else { echo 'value=0';}?>></td>
                                                                        <td>
                                                                              <input type="checkbox" name="sua<?=$function['id_chucnang']?>"
                                                                              <?php if ($function['sua'] == 1) { echo 'value=1 checked';} else { echo 'value=0';}?>></td>
                                                                        <td>
                                                                              <input type="checkbox" name="xoa<?=$function['id_chucnang']?>"
                                                                              <?php if ($function['xoa'] == 1) { echo 'value=1 checked';} else { echo 'value=0';}?>></td>
                                                                        <td>
                                                                              <input type="checkbox" name="in<?=$function['id_chucnang']?>"
                                                                              <?php if ($function['quyen_in'] == 1) { echo 'value=1 checked';} else { echo 'value=0';}?>></td>
                                                                        <td>
                                                                              <input type="checkbox" name="nhap<?=$function['id_chucnang']?>"
                                                                              <?php if ($function['nhap'] == 1) { echo 'value=1 checked';} else { echo 'value=0';}?>></td>
                                                                        <td>
                                                                              <input type="checkbox" name="xuat<?=$function['id_chucnang']?>"
                                                                              <?php if ($function['xuat'] == 1) { echo 'value=1 checked';} else { echo 'value=0';}?>></td>
                                                                </tr>
                                                                <?php
                                                      }
                                                }
                                          }
                                          ?>
                                          
                                    </tbody>
                              </table>
                        </div>
                        <div class="btn-setting-container">
                              <button class="btn save-btn">Lưu</button>
                         </div>
                  </form>
                  <div class="content-table-container">
                              <div class="content-title">
                                    <h4>Tài khoản thuộc quyền:  _<?=$role['tenroles']?>_</h4>
                              </div>
                        <div class="list-user-container">
                              <table border="1" class="list-user-table">
                                    <thead>
                                          <tr> 
                                               <th></th>
                                                <th>Họ và tên</th>
                                                <th>Tên đăng nhập</th>
                                                <th>Mật khẩu</th>
                                                <th>Bộ phận</th>
                                                <th>Chức vụ</th>
                                                <th>Ngày tạo</th>
                                                <th>Kích hoạt</th>
                                               <th></th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                          if (isset($Users)) {
                                                foreach ($Users as $user) {
                                                      if ($user['id_roles'] == $role['id_roles']) {
                                                            ?> 
                                                                  <tr style="text-align: center">
                                                                        <td></td>
                                                                        <td><?=$user['hovaten']?></td>
                                                                        <td><?=$user['email']?></td>
                                                                        <td><?=$user['password']?></td>
                                                                        <td><?=$user['tenbophan']?></td>
                                                                        <td><?=$user['tenchucvu']?></td>
                                                                        <td><?=$user['ngaytao']?></td>
                                                                        <td>
                                                                        <form action="?c=roles&a=active_user&id=<?=$user['id_nhanvien'] ?>" method="POST">
                                                                              <input name="status_active" type="checkbox" <?php if($user['user_kichhoat'] == 1) { echo 'value=1 checked';} else { echo 'value=0';}?> >
                                                                              <button style="background-color: transparent;border:none" type="submit" name="submit_active" class="btn">Cập nhật</button>
                                                                        </form>
                                                                        </td>
                                                                       <td></td>
                                                                  </tr>
                                                            <?php
                                                      }
                                                }
                                          }
                                          ?>
                                    </tbody>
                              </table>
                        </div>
                  </div>
                 
            </div>
<?php
      }
}
?>