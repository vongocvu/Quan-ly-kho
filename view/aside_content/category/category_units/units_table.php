<div id="units_table_view" class="aside-item hidden roles-content">

      <?php
      if (isset($unit_edit)) {
            $row = $unit_edit->fetch_assoc();
                  ?>
                       <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa đơn vị tính</h4>
                  </div>
                  <form action="?c=units&a=edit&id=<?= $row['id_donvitinh'] ?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa đơn vị tính</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-40">
                                    <label class="form-item-name">Tên đơn vị tính:</label>
                                    <input value="<?= $row['tendonvitinh'] ?>" class="form-item-input" type="text" name="name" placeholder="Nhập thông tin">
                              </div>


                              <div class="form-item w-40">
                                    <label class="form-item-name">Ghi chú:</label>
                                    <input value="<?= $row['ghichu'] ?>" class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-20"></div>

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
                        <h4>Danh sách các đơn vị tính hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Tên đơn vị tính</th>
                                    <th>Ghi chú</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($units)) {
                                    foreach ($units as $unit) {
                              ?>
                                          <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $unit['tendonvitinh'] ?></td>
                                                <td><?= $unit['ghichu'] ?></td>
                                                <td class="icon-table"><a href="?c=units&a=edit&id=<?= $unit['id_donvitinh'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=units&a=delete&id=<?= $unit['id_donvitinh'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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