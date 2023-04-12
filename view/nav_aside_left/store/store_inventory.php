<nav id="store_inventory"  class="nav-aside-left hidden">
      <div class="nav-aside-title">
            <h4>Quản lý tồn kho</h4>
      </div>
      <ul class="nav-aside-list list-style-none">
            <li class="nav-aside-item">
                  <div id="store_ship_list" class="nav-aside-name d-flex">
                        <span> + Hàng chưa vận chuyển</span>
                        <i class="fa-solid fa-caret-right icon-drop-down"></i>
                  </div>
                  <ul class="nav-child-list list-style-none">

                  <?php 
                     require_once PATH_APPLICATION . '/core/Base_Model.php';
                     $db = new Base_Model();
                     foreach ($_SESSION['function'] as $key => $value) {
                        if ($key == 3 && $value['truycap'] == 1) {
                            $Stores = $db->conn->query("SELECT * FROM kho a");
                            foreach ($Stores as $store) {
                                  ?>
                                          <li id="store_ship_detail<?=$store['id_kho']?>" class="nav-child-item-pos content-pos-btn">
                                               <span>- <?=$store['tenkho']?></span>
                                          </li>
                                  <?php
                            }
                        }}
                  ?>
                  </ul>
            </li>

            <li class="nav-aside-item">
                  <div id="store_inventory_list" class="nav-aside-name d-flex">
                        <span> + Hàng tồn</span>
                        <i class="fa-solid fa-caret-right icon-drop-down"></i>
                  </div>
                  <ul class="nav-child-list list-style-none">

                  <?php 
                     require_once PATH_APPLICATION . '/core/Base_Model.php';
                     $db = new Base_Model();
                     foreach ($_SESSION['function'] as $key => $value) {
                        if ($key == 3 && $value['truycap'] == 1) {
                            $Stores = $db->conn->query("SELECT * FROM kho a");
                            foreach ($Stores as $store) {
                                  ?>
                                          <li id="store_inventory_detail<?=$store['id_kho']?>" class="nav-child-item-pos content-pos-btn">
                                               <span>- <?=$store['tenkho']?></span>
                                          </li>
                                  <?php
                            }
                        }}
                  ?>
                  </ul>
            </li>
      </ul>
</nav>