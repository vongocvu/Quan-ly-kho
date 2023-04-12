<?php 
      require_once PATH_APPLICATION . '/core/Base_Model.php';
      $db = new Base_Model();
      $pages = $db->conn->query("SELECT * FROM chucnang");

      foreach ($pages as $page) {
            $id_page = $page['id_chucnang'];
            ?>
                  <div id="history<?=$page['id_chucnang']?>" class="hidden content-pos-view">
                        <div class="wrapper_history">
                              <div class="container_history">
                                    <div class="title_history">
                                          <h1>NHẬT KÝ <?=$page['tenchucnang']?></h1>
                                    </div>
                                    <div class="box_table_history">
                                          <table border="1" cellspacing="">
                                                <thead>
                                                      <tr>
                                                            <th>STT</th>
                                                            <th>Nội dung</th>
                                                            <th>Thời gian</th>
                                                            <th>Nhân viên</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php
                                                      
                                                      $history = $db->conn->query("SELECT *, CONCAT(b.tenlot,' ',b.tennhanvien) as hovaten FROM nhatky a, nhanvien b WHERE a.id_nhanvien = b.id_nhanvien AND a.id_page = '$id_page'");
                                                      $i = 1;
                                                      foreach ($history as $item) {
                                                            ?>
                                                            <tr>
                                                                        <td><?=$i++?></td>
                                                                        <td style="text-align: left"><?=$item['noidung']?></td>
                                                                        <td><?=$item['thoigian']?></td>
                                                                        <td><?=$item['hovaten']?></td>
                                                            </tr>
                                                            <?php
                                                      }
                                                      ?>
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
            <?php
      }
?>

