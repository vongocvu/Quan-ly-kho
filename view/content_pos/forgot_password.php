
                  <div id="forgot_password" class="content-pos-view form_forgot hidden" style="background: var(--main_bgc)">
                        <form id="form" action="?c=auth&a=changePassword&id=<?=$_SESSION['id']?>&status=change" method="post" enctype="multipart/form">
                              <div class="box-title" style="color: white; background: var(--main_bgc)">
                                    <i class="fa-solid fa-users"></i>
                                    <h5 class="title" style="font-weight: bold">Đổi mật khẩu</h5>
                              </div>

                              <div class="form-container" style="background: white">
                                    <div class="form-control d-flex jus-between align-items-center">
                                          <h6 class="name" style="font-size: 13px">Mật khẩu mới:</h6>
                                          <input style="padding: 5px" name="password" class="input-control input_password" check="false" type="password" placeholder="Nhập mật khẩu mới">
                                    </div>
                                    <div class="form-control d-flex align-items-center">
                                          <h6 class="name" style="font-size: 13px">Nhập lại:</h6>
                                          <div class="box-password">
                                          <input style="padding: 5px" name="password_confirm" class="input-control-password input_password_confirm" check="false" type="password" placeholder="Nhập lại mật khẩu">
                                          <i class="eye fa-regular fa-eye eye-show"></i>
                                          <i class="eye fa-regular fa-eye-slash eye-close"></i>
                                          </div>
                                    </div>
                                    <div class="form-control d-flex">
                                          <div style="width: 30%"></div>
                                          <button id="login-btn" type="button" name="submit_change" class="submit_change btn btn-submit d-flex align-items-center" style="padding: 0 5px; font-weight: bold">
                                                <i class="fa-solid fa-check" style="color: green; font-weight: bold; font-size:20px;padding: 5px"></i> 
                                                Thay đổi
                                          </button>
                                    </div>
                              </div>

                         </form>
                  </div>

                  <script type="text/javascript">
                       var input_password = document.querySelector('.input_password')
                       var password_confirm = document.querySelector('.input_password_confirm')
                       var submit_change = document.querySelector('.submit_change')

                       submit_change.addEventListener('click', function () {
                          if (input_password.value == '') {
                              input_password.placeholder = "Ơ kìa! Chưa nhập mật khẩu mà !"
                              input_password.classList.add('error_input')
                              password_confirm.placeholder = "Nhập lại mật khẩu"
                              password_confirm.classList.remove('error_input')
                          } else {
                              password_confirm.placeholder = "Chưa nhập lại mật khẩu tề !"
                              password_confirm.classList.add('error_input')
                          }

                       })

                       input_password.addEventListener("keyup", function () {
                          if (input_password.value !== '') {
                              input_password.setAttribute('check', true)
                          } else {
                              input_password.placeholder = "Ơ kìa! Chưa nhập mật khẩu mà !"
                              input_password.classList.add('error_input')
                              input_password.setAttribute('check', false)
                              submit_change.type = 'button';
                          }

                          complete_change()
                       })


                       password_confirm.addEventListener("change", function () {
                          if (input_password.value !== '') {
                                    if (input_password.value == password_confirm.value) {
                                          password_confirm.setAttribute('check', true)
                                    } else {
                                          password_confirm.value = ""
                                          password_confirm.setAttribute('check', false)
                                          password_confirm.placeholder = "Mật khẩu không trùng khớp !"
                                          password_confirm.classList.add('error_input')
                                          submit_change.type = 'button';
                                    }
                              } else {
                                    password_confirm.value = ""
                                    password_confirm.setAttribute('check', false)
                                    password_confirm.placeholder = "Nhập mật khẩu mới trước cái đã !"
                                    password_confirm.classList.add('error_input')
                                    submit_change.type = 'button';
                              }
                        complete_change()
                       })


                       function complete_change () {
                           var check = 0;
                          
                           if (input_password.getAttribute('check') == "false") {
                              check++
                           }

                           if (password_confirm.getAttribute('check') == "false") {
                              check++
                           }

                           if (check == 0) {
                              submit_change.type = 'submit';
                           }
                       }

                       
                  </script>

