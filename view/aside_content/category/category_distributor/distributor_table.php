<div id="distributor_table_view" class="aside-item hidden roles-content">

      <?php
      if (isset($distributor_edit)) {
            $row = $distributor_edit->fetch_assoc();
                  ?>
                       <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa nhà phân phối</h4>
                  </div>
                  <form action="?c=distributor&a=edit&id=<?= $row['id_nhaphanphoi'] ?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa nhà phân phối</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên nhà phân phối:</label>
                                    <input value="<?= $row['tennhaphanphoi'] ?>" class="form-item-input" type="text" name="name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Mã số thuế:</label>
                                    <input value="<?= $row['masothue'] ?>" class="form-item-input" type="text" name="taxcode" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Số điện thoại:</label>
                                    <input value="<?= $row['sodienthoai'] ?>" class="form-item-input" type="text" name="phone" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Email:</label>
                                    <input value="<?= $row['email'] ?>" class="form-item-input" type="text" name="email" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Địa chỉ:</label>
                                    <input value="<?= $row['diachi'] ?>" class="form-item-input" type="text" name="address" placeholder="Nhập thông tin">
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
            </div>
                  <?php
      } else {
      ?>
            <div class="content-table-container">
                  <div class="content-title">
                        <h4>Danh sách các nhà phân phối hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Tên nhà phân phối</th>
                                    <th>Mã số thuế</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày tạo</th>
                                    <th>Ghi chú</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($distributors)) {
                                    foreach ($distributors as $distributor) {
                              ?>
                                          <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $distributor['tennhaphanphoi'] ?></td>
                                                <td><?= $distributor['masothue'] ?></td>
                                                <td><?= $distributor['sodienthoai'] ?></td>
                                                <td><?= $distributor['email'] ?></td>
                                                <td><?= $distributor['diachi'] ?></td>
                                                <td><?= $distributor['ngaytao'] ?></td>
                                                <td><?= $distributor['ghichu'] ?></td>
                                                <td class="icon-table"><a href="?c=distributor&a=edit&id=<?= $distributor['id_nhaphanphoi'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=distributor&a=delete&id=<?= $distributor['id_nhaphanphoi'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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