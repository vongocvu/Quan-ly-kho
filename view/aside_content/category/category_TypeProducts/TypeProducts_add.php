<div id="TypeProducts_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
            <div class="content-title">
                  <h4>Quản lý mặt hàng trong kho:</h4>
            </div>


            <div class="form-add-wrapper">


                  <?php
                        if (isset($cateProducts)) {
                              ?>
                                    <div class="content-title form-add-title">
                                          <h4><i class="fa-solid fa-plus"></i> <?= $_SESSION['add_typeProducts']['store']['name'] ?> - Chọn nhóm hàng</h4>
                                    </div>
                                    <a class="btn_cancel" href="?c=typeProducts&a=add&cancel_step1">Quay lại</a>
                                    <div class="box_show_list">
                                          <?php
                                                 foreach ($cateProducts as $cate) {
                                                      ?>
                                                            <form action="?c=typeProducts&a=add&id=<?= $cate['id_nhomhang'] ?>" method="POST" class="box_link_a w-30">
                                                                  <button class="a_link" type="submit" name="id_cate"> - <?= $cate['tennhomhang'] ?></button>
                                                            </form>
                                                      <?php
                                                }
                                          ?>
                                    </div>
                              <?php
                        } else if (isset($products)) {
                                           ?>
                                          <div class="content-title form-add-title">
                                                <h4><i class="fa-solid fa-plus"></i> <?= $_SESSION['add_typeProducts']['cate']['name'] ?> - Thêm mặt hàng</h4>
                                          </div>
                                          <a class="btn_cancel" href="?c=typeProducts&a=add&cancel_step2&id=<?= $_SESSION['add_typeProducts']['store']['id'] ?>">Quay lại</a>
                                          <form action="?c=typeProducts&a=add" method="POST" class="form-add-container">
                                                <div class="form-item w-30">
                                                      <label class="form-item-name">Tên mặt hành mới:</label>
                                                      <input  class="form-item-input" type="text" name="name" placeholder="Nhập tên mặt hàng">
                                                </div>

                                                <div class="form-item w-30">
                                                      <label class="form-item-name">Ghi chú:</label>
                                                      <input  class="form-item-input" type="text" name="note" placeholder="Nhập ghi chú">
                                                </div>

                                                <div class="form-item w-30">
                                                      <button type="submit" class=" btn_cancel" name='submit_add_type'>Thêm</button>
                                                </div>
                                          </form>
                                          <h4 class="title_show">- Các mặt hàng hiện đã có trong nhóm hàng: _ <?=$_SESSION['add_typeProducts']['cate']['name']?> _</h4>
                                                <?php
                                                foreach ($products as $product) {
                                                      ?>
                                                            <div class="box_link_a w-30">
                                                                  <span>+ <?= $product['tenloaihanghoa'] ?></span>
                                                            </div>
                                                      <?php
                                                  }
                                                ?>
                                          <?php
                                    }
                                    else {
                               ?>

                              <div class="content-title form-add-title">
                                    <h4><i class="fa-solid fa-plus"></i> Chọn kho </h4>
                              </div>
                              <div class="box_show_list">
                              <?php
                              if (isset($stores)) {
                                    foreach ($stores as $store) {
                              ?>
                                          <form action="?c=typeProducts&a=add&id=<?= $store['id_kho'] ?>" method="POST" class="box_link_a w-30">
                                                <button type="submit" class="a_link" name="id_store"> - <?= $store['tenkho'] ?></button>
                                          </form>
                              <?php
                                    }
                              }
                              ?>
                              </div>
                        <?php
                        }
                  ?>

            </div>
      </div>
</div>