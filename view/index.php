<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Hệ thống</title>
      <link rel="shortcut icon" href="./public/logo/logo.jpg" type="image/x-icon">
      <link rel="stylesheet" href="./public/css/base.css">
      <link rel="stylesheet" href="./public/css/index.css">
      <link rel="stylesheet" href="./public/css/table.css">
      <link rel="stylesheet" href="./public/css/content.css">
      <link rel="stylesheet" href="./public/css/forgot_password.css">
      <link rel="stylesheet" href="./public/font/fontawesome-free-6.1.1-web/css/all.min.css">
      <link rel="stylesheet" href="./public/css/loadding.css">
      <link rel="stylesheet" href="./public/css/store.css">
      <link rel="stylesheet" href="./public/css/history.css">
</head>

<body>

      <div class="wrapper pos-relative">
            <div class="header-title">
                  <h5><span class="curent-page">Hệ thống </span> - Phần mềm quản lý kho</h5>
                  <div class="logo">
                        <i class="fa-brands fa-slack"></i>
                  </div>
            </div>

            <div class="container">
                  <div class="nav-container">
                        <div class="box-nav d-flex">
                              <ul class="navbar-list d-flex">
                                      
                                    <li id="navbar_system" class="navbar-item active">Hệ thống</li>
                                    <li id="navbar_category" class="navbar-item">Danh mục</li>
                                    <li id="navbar_store" class="navbar-item">Kho hàng</li>
                              </ul>
                        </div>
                  </div>
                  <div class="nav_bar">
                        <?php require_once PATH_APPLICATION . '/view/nav_main/index.php' ?>
                        <div class="nav-tabs">
                              <div class="slider">
                                    <ul class="tab-list">
                                    </ul>
                              </div>
                        </div>
                  </div>
                  <div class="main-content">
                         <?php require_once PATH_APPLICATION . '/view/nav_aside_left/index.php' ?>
                        
                        
                        <aside class="aside-content">
                              
                                    <?php require_once PATH_APPLICATION . '/view/aside_content/index.php' ?>
                                    <div id="spinner" class="show">
                  <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                  </div>
            </div>
                        </aside>
                  </div>
            </div>

            <div class="content-pos pos-absolute <?php if (!isset($cancel_pos) && !isset($inventory)) { echo "hidden";}?>">
                  <div class="pos-container pos-relative">
                        <button class="close-content-pos">
                              <i class="fa-solid fa-xmark"></i>
                        </button>
                        <?php require_once PATH_APPLICATION . '/view/content_pos/index.php' ?>
                  </div>
            </div>

            <div class="box_move_store hidden">
                  <form class="form_move_store" action="?c=store&a=move_store" method="POST">
                        <div class="form-control">

                              <input type="hidden" class="id_product" name='id_product'>     
                              <input type="hidden" class="id_store" name='id_store'>     

                              <div class="form-move-item">
                                    <label for="name">Số lượng muốn chuyển:</label>
                                    <input name="number_move" class="input_number_store input_move" type="number" placeholder="Nhập số lượng"/>
                              </div>

                              <div class="form-btn-move">
                                    <span class="input_error"></span>
                              </div>

                              <div class="form-move-item">
                                    <label for="name">Kho muốn chuyển đến:</label>
                                    <select name="select_move" class="input_select_store input_move">
                                          <option value="0">Chọn kho</option>
                                          <?php 
                                          if (isset($Store_move)) { 
                                                foreach ($Store_move as $item) {
                                                      ?> 
                                                      <option value="<?=$item['id_kho']?>"><?=$item['tenkho']?></option>
                                                      <?php
                                                }
                                          }
                                          ?>
                                    </select>
                              </div>

                              <div class="form-btn-move">
                                    <span class="select_error"></span>
                              </div>

                              <div class="form-move-item">
                                    <label for="note">Ghi chú:</label>
                                    <input name="note" class="input_move" type="text" placeholder="Nhập ghi chú"/>
                              </div>

                              <div class="form-btn-move">
                                    <button type="button" class="cancel_move">Quay lại</button>
                                    <button type="button" class="complete_move" name="complete_move">Chuyển</button>
                              </div>
                        </div>
                  </form>
            </div>

            <?php 
               if (isset($error)) {
                  ?> 
                        <div class="content-show-status">
                              <div class="box-status">
                                    <div class="status-title <?php if (isset($fail)) { echo 'fail';}?> <?php if (isset($success)) { echo 'success';}?>" >
                                          <span><?=$error['name']?> :</span>
                                    </div>
                                    <div class="status-description <?php if (isset($fail)) { echo 'fail';}?> <?php if (isset($success)) { echo 'success';}?>">
                                    <span>- <?=$error['content']?></span>
                                    </div>
                                    <div class="box-btn">
                                          <div class="space"></div>
                                          <button class="btn submit-btn close-status">OK</button>
                                    </div>
                              </div>
                        </div>
                  <?php
               }
            
            ?>
      </div>

      <script src="./public/js/index.js"></script>
      <script src="./public/js/login.js"></script>
      <script src="./public/js/content.js"></script>
      <script src="./public/js/nav_control.js"></script>
      <script src="./public/js/content_pos.js"></script>
      <script src="./public/js/loadding.js"></script>
      <script src="./public/js/handel_checkbox.js"></script>
      <script src="./public/js/scroll_custom.js"></script>
      <script src="./public/js/move_products.js"></script>
      <script src="./public/js/offer_export.js"></script>
      <script src="./public/js/offer_import.js"></script>
</body>

</html>