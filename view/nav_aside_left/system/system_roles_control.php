<nav id="system_roles"  class="nav-aside-left hidden">
      <div class="nav-aside-title">
            <h4>Phân quyền</h4>
      </div>
      <ul class="nav-aside-list list-style-none">
            <li class="nav-aside-item">
                  <div id="nav_roles" class="nav-aside-name d-flex">
                        <span>Danh sách quyển quản trị</span>
                        <i class="fa-solid fa-caret-right icon-drop-down"></i>
                  </div>
                  <ul class="nav-child-list list-style-none">
                        <a href="?c=roles&a=table" target="" id="add-roles" class="nav-child-item"><i class="fa-solid fa-plus"></i><span id="c=roles&a=table">Thêm quyền quản trị </span></a>
                  </ul>
            </li>
            <li class="nav-aside-item">
                  <div id="nav_roles_setting" class="nav-aside-name d-flex">
                        <span>Thiết lập phân quyền</span>
                        <i class="fa-solid fa-caret-right icon-drop-down"></i>
                  </div>
                  <ul class="nav-child-list list-style-none">
                        <?php 
                           require_once PATH_APPLICATION . '/model/Roles_Model.php';
                           $ROLES_MODEL = new Roles_Model();

                           $Roles = $ROLES_MODEL->get();
                           foreach ($Roles as $role) {
                              if ($role['kichhoat'] == 1 &&  $_SESSION['function'][1]['truycap'] == 1) {
                                    ?> 
                                    <a href="?c=roles&a=setting&id=<?=$role['id_roles']?>" id="roles-setting<?=$role['id_roles']?>" class="nav-child-item">
                                          <i class="fa-solid fa-plus"></i>
                                          <span id="c=roles&a=setting&id=<?=$role['id_roles']?>"><?=$role['tenroles']?></span>
                                    </a>
                                    <?php
                              }
                           }
                        ?>
                  </ul>
            </li>
      </ul>
</nav>
