<div id="CateProducts_table_view" class="aside-item hidden roles-content">

      <?php
      if (isset($CateProduct_edit)) {
            $row = $CateProduct_edit->fetch_assoc();
                  ?>
                       <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa nhóm hàng</h4>
                  </div>
                  <form action="?c=cateProducts&a=edit&id=<?= $row['id_nhomhang'] ?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa nhóm hàng</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên nhóm hàng:</label>
                                    <input value="<?= $row['tennhomhang'] ?>" class="form-item-input" type="text" name="name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                   <label class="form-item-name">Thời hạn sử dụng:</label>
                                    <select class="form-item-input" name="expiry" style="padding-left: 20px !important">
                                          <option value="0" <?php if ($row['hansudung'] == 0 ) { echo "selected";}?>>Không có hạn sử dụng</option>
                                          <option value="1" <?php if ($row['hansudung'] == 1 ) { echo "selected";}?>>Có hạn sử dụng</option>
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
            </div>
                  <?php
      } else {
      ?>
            <div class="content-table-container">
                  <div class="content-title">
                        <h4>Danh sách các nhóm hàng hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Tên bộ phận</th>
                                    <th>Hạn sử dụng</th>
                                    <th>Ghi chú</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($CateProducts)) {
                                    foreach ($CateProducts as $cate) {
                              ?>
                                          <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $cate['tennhomhang'] ?></td>
                                                <td><?php if ($cate['hansudung'] == 0 ) { echo "Không có hạn sử dụng";} else { echo "Có hạn sử dụng";}?></td>
                                                <td><?= $cate['ghichu'] ?></td>
                                                <td class="icon-table"><a href="?c=cateProducts&a=edit&id=<?= $cate['id_nhomhang'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=cateProducts&a=delete&id=<?= $cate['id_nhomhang'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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