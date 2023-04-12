<div id="customers_table_view" class="aside-item hidden roles-content">
      <?php
      if (isset($customer_edit)) {
            $row = $customer_edit->fetch_assoc();
      ?>
            <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa khách hàng</h4>
                  </div>
                  <form action="?c=customers&a=edit&id=<?= $row['id_khachhang'] ?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa thông tin khách hàng</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Họ:</label>
                                    <input value="<?= $row['tenlot'] ?>" class="form-item-input" type="text" name="last_name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên:</label>
                                    <input value="<?= $row['tenkhachhang'] ?>" class="form-item-input" type="text" name="first_name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Giới tính:</label>
                                    <select name="sex" class="form-item-input">
                                          <option value="0">Chọn giới tính</option>
                                          <option <?php if ($row['gioitinh'] == 1) {
                                                            echo 'selected';
                                                      } ?> value="1">Nam</option>
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
                                    <label class="form-item-name">Ghi chú:</label>
                                    <input value="<?= $row['ghichu'] ?>" class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
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
                        <h4>Danh sách khách hàng hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ghi chú</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($customers)) {
                                    foreach ($customers as $customer) {
                              ?>
                                          <tr>
                                                <td></td>
                                                <td><?= $customer['hovaten'] ?></td>
                                                <td><?= $customer['email'] ?></td>
                                                <td>
                                                      <?php
                                                      if ($customer['gioitinh'] == 1) {
                                                            echo 'Nam';
                                                      }
                                                      if ($customer['gioitinh'] == 2) {
                                                            echo 'Nữ';
                                                      }
                                                      if ($customer['gioitinh'] == 3) {
                                                            echo 'Bê đê';
                                                      }
                                                      ?>

                                                </td>
                                                <td><?= $customer['sodienthoai'] ?></td>
                                                <td><?= $customer['diachi'] ?></td>
                                                <td><?= $customer['ghichu'] ?></td>
                                                <td class="icon-table"><a href="?c=customers&a=edit&id=<?= $customer['id_khachhang'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=customers&a=delete&id=<?= $customer['id_khachhang'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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