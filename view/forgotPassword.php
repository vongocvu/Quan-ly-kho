<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Quên mật khẩu</title>
      <link rel="stylesheet" href="./public/css/login.css">
      <link rel="stylesheet" href="./public/css/base.css">
      <link rel="stylesheet" href="./public/font/fontawesome-free-6.1.1-web/css/all.min.css">

</head>

<body>
      <div class="wrapper">
            <div class="container container-login">
                  <form id="form" action="?c=auth&a=forgotPassword" method="post" enctype="multipart/form">
                        <div class="box-title">
                              <i class="fa-solid fa-users"></i>
                              <h5 class="title" style="font-weight: bold">Quên mật khẩu</h5>
                        </div>

                        <div class="form-container">
                              <div class="border-out">
                                    <h5 class="title" style="font-weight: bold; color: #000">Nhập email để khôi phục mật khẩu!</h5>
                              </div>
                              <div class="form-control border-out d-flex jus-between align-items-center">
                                    <input style="padding: 5px; font-size: 14px" name="emailForgot" class="input-control" type="text">
                              </div>
                              <div class="form-control d-flex">
                                    <div style="width: 30%"></div>
                                    <button id="login-btn" type="submit" name="submit_forgot" class="btn btn-submit d-flex align-items-center" style="padding: 0 5px; font-weight: bold">
                                           <i class="fa-solid fa-check" style="color: green; font-weight: bold; font-size:20px;padding: 5px"></i> 
                                          Xác nhận
                                    </button>
                              </div>
                        </div>

                  </form>
            </div>
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
      <script src="./public/js/login.js"></script>
</body>

</html>