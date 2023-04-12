<nav id="store_move"  class="nav-aside-left hidden">
      <div class="nav-aside-title">
            <h4>Chuyển kho</h4>
      </div>
      <ul class="nav-aside-list list-style-none">
            <li class="nav-aside-item">
                  <div id="store_move_list" class="nav-aside-name d-flex">
                        <span>Chọn kho để chuyển</span>
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
                                          <a href="?c=store&a=move_store&id=<?=$store['id_kho']?>" id="store_move_view<?=$store['id_kho']?>" class="nav-child-item">
                                                <i class="fa-solid fa-plus"></i><span id="c=store&a=move_store&id=<?=$store['id_kho']?>"> <?=$store['tenkho']?></span>
                                          </a>
                                  <?php
                            }
                        }}
                  ?>
                  </ul>
            </li>
      </ul>
</nav>