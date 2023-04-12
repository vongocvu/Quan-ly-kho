<div id="parts_table_view" class="aside-item hidden roles-content">

      <?php
      if (isset($part_edit)) {
            $row = $part_edit->fetch_assoc();
                  ?>
                       <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa bộ phận</h4>
                  </div>
                  <form action="?c=parts&a=edit&id=<?= $row['id_bophan'] ?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa bộ phận</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên bộ phận:</label>
                                    <input value="<?= $row['tenbophan'] ?>" class="form-item-input" type="text" name="part_name" placeholder="Nhập thông tin">
                              </div>


                              <div class="form-item w-30">
                                    <label class="form-item-name">Ghi chú:</label>
                                    <input value="<?= $row['ghichu'] ?>" class="form-item-input" type="text" name="part_note" placeholder="Nhập thông tin">
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
                        <h4>Danh sách các bộ phận hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Tên bộ phận</th>
                                    <th>Ghi chú</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($parts)) {
                                    foreach ($parts as $part) {
                              ?>
                                          <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $part['tenbophan'] ?></td>
                                                <td><?= $part['ghichu'] ?></td>
                                                <td class="icon-table"><a href="?c=parts&a=edit&id=<?= $part['id_bophan'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=parts&a=delete&id=<?= $part['id_bophan'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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