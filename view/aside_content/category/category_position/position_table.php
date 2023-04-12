<div id="position_table_view" class="aside-item hidden roles-content">

      <?php
      if (isset($position_edit)) {
            $row = $position_edit->fetch_assoc();
                  ?>
                       <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa chức vụ</h4>
                  </div>
                  <form action="?c=position&a=edit&id=<?= $row['id_chucvu'] ?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa chức vụ</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên chức vụ:</label>
                                    <input value="<?= $row['tenchucvu'] ?>" class="form-item-input" type="text" name="name" placeholder="Nhập thông tin">
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
                        <h4>Danh sách các chức vụ hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Chức vụ</th>
                                    <th>Bộ phân</th>
                                    <th>Ghi chú</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($positions)) {
                                    foreach ($positions as $position) {
                              ?>
                                          <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $position['tenchucvu'] ?></td>
                                                <td><?= $position['tenbophan'] ?></td>
                                                <td><?= $position['ghichu'] ?></td>
                                                <td class="icon-table"><a href="?c=position&a=edit&id=<?= $position['id_chucvu'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=position&a=delete&id=<?= $position['id_chucvu'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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