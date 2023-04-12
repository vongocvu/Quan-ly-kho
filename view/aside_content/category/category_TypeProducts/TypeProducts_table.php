<div id="TypeProducts_table_view" class="aside-item hidden roles-content">

      <?php
      if (isset($TypeProduct_edit)) {
            $row = $TypeProduct_edit->fetch_assoc();
                  ?>
                       <div class="content-add-roles">
                  <div class="content-title">
                        <h4>Chỉnh sủa loại hàng hóa</h4>
                  </div>
                  <form action="?c=typeProducts&a=edit&id=<?= $row['id_loaihanghoa'] ?>" method="POST" class="form-add-wrapper">
                        <div class="content-title form-add-title">
                              <h4><i class="fa-solid fa-plus"></i> Chỉnh sửa loại hàng hóa</h4>
                        </div>
                        <div class="form-add-container">
                              <div class="form-item w-30">
                                    <label class="form-item-name">Tên loại hàng hóa:</label>
                                    <input value="<?= $row['tenloaihanghoa'] ?>" class="form-item-input" type="text" name="name" placeholder="Nhập thông tin">
                              </div>

                              <div class="form-item w-30">
                                    <label class="form-item-name">Nhóm hàng hóa:</label>
                                    <select name="cate" class="form-item-input">
                                          <option value="0">Chọn nhóm hàng</option>
                                    <?php 
                                      if (isset($cates)) {
                                          foreach ($cates as $cate) {
                                                ?> 
                                                        <option <?php if ($cate['id_nhomhang'] == $row['nhomhang']) { echo 'selected'; } ?> value="<?=$cate['id_nhomhang']?>"><?=$cate['tennhomhang']?></option>
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
                        <h4>Danh sách các mặt hàng hiện có</h4>
                  </div>
                  <table border='1' class="content-table">
                        <thead>
                              <tr>
                                    <th></th>
                                    <th>Tên mặt hàng</th>
                                    <th>Nhóm hàng hóa</th>
                                    <th>Kho</th>
                                    <th>Ghi chú</th>
                                    <th>Sủa</th>
                                    <th>Xóa</th>
                              </tr>
                        </thead>

                        <tbody class="show-table">
                              <?php
                              if (isset($TypeProducts)) {
                                    foreach ($TypeProducts as $type) {
                              ?>
                                          <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $type['tenloaihanghoa'] ?></td>
                                                <td><?= $type['tennhomhang'] ?></td>
                                                <td><?= $type['tenkho'] ?></td>
                                                <td><?= $type['ghichu_hanghoa'] ?></td>
                                                <td class="icon-table"><a href="?c=typeProducts&a=edit&id=<?= $type['id_loaihanghoa'] ?>"><i class="icon-green fa-solid fa-pen-to-square"></i></a></td>
                                                <td class="icon-table"><a href="?c=typeProducts&a=delete&id=<?= $type['id_loaihanghoa'] ?>"><i class="icon-red fa-solid fa-trash-can"></i></a></td>
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