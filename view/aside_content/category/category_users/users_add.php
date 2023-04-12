<div id="users_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
           <div class="content-title">
                  <h4>Quản lý nhân viên</h4>
            </div>


            <form action="?c=users&a=add" method="POST" class="form-add-wrapper">
                   <div class="content-title form-add-title">
                          <h4><i class="fa-solid fa-plus"></i> Thêm tài khoản</h4>
                   </div>
                   <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Họ: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_user" type="text" name="last_name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Tên: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_user" type="text" name="first_name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Giới tính: <span class="input_obligatory"> * </span></label>
                              <select name="sex" class="form-item-input select_user">
                                          <option value="">Chọn giới tính</option>
                                          <option value="1">Nam</option>s
                                          <option value="2">Nữ</option>
                                          <option value="2">Giới tính khác</option>
                                    </select>
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ngày sinh: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input date_user " type="datetime-local" name="birthday">
                        </div>

                        
                        <div class="form-item w-30">
                              <label class="form-item-name">Email: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input email_user" type="email" name="email" placeholder="Nhập thông tin">
                        </div>
                        
                        <div class="form-item w-30">
                              <label class="form-item-name">Mật khẩu: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_user password" type="text" name="password" placeholder="Nhập mật khẩu">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Nhập lại: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_user password_confirm" type="text" name="password_confirm" placeholder="Nhập lại mật khẩu">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Số điện thoại: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_user" type="text" name="phone" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Địa chỉ: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_user" type="text" name="address" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Bộ phận: <span class="input_obligatory"> * </span></label>
                              <select name="part" class="form-item-input select_user box_part">
                                    <option value="">Chọn bộ phận</option>
                                          <?php 
                                          if (isset($parts)) {
                                                foreach ($parts as $part) {
                                                      ?> 
                                                      <option value="<?= $part['id_bophan']?>"><?=$part['tenbophan']?></option>
                                                      <?php
                                                }
                                          }
                                          ?>
                              </select>
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Chức vụ: <span class="input_obligatory"> * </span></label>
                              <select name="position" class="form-item-input select_user box_position">
                                    <option value="">Chọn chức vụ</option>
                                          <?php 
                                          if (isset($positions)) {
                                                foreach ($positions as $pos) {
                                                      ?> 
                                                      <option class="position" id_part="<?=$pos['bophan']?>" value="<?= $pos['id_chucvu']?>"><?=$pos['tenchucvu']?></option>
                                                      <?php
                                                }
                                          }
                                          ?>
                              </select>
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Quyền điều hành: <span class="input_obligatory"> * </span></label>
                              <select name="roles" class="form-item-input select_user">
                                    <option value="">Chọn quyền</option>
                                          <?php 
                                          if (isset($roles)) {
                                                foreach ($roles as $role) {
                                                      ?> 
                                                      <option value="<?= $role['id_roles']?>"><?=$role['tenroles']?></option>
                                                      <?php
                                                }
                                          }
                                          ?>
                              </select>
                        </div>
                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="button" name="submit_add" class="btn save-btn submit_user">Thêm</button>
                       </div>
                   </div>
            </form>
      </div>
</div>

<script type="text/javascript">
      var inputs_user = document.querySelectorAll('.input_user')
      var submit_user = document.querySelector('.submit_user')
      var selects_user = document.querySelectorAll('.select_user')
      var date_user = document.querySelector('.date_user')
      var email_user = document.querySelector('.email_user')
      var password_user = document.querySelector('.password')
      var password_confirm_user = document.querySelector('.password_confirm')
      var box_part = document.querySelector('.box_part')
      var box_position = document.querySelector('.box_position')

      function setDefaultPos () {
            for (var i = 0; i < box_position.children.length; i++) {
                  box_position.children[i].classList.add('hidden')
            }
      
            const option = document.createElement("option");
            option.value = "notthing"
            option.innerText = "Bạn chưa chọn bộ phận !";
            box_position.appendChild(option)
            box_position.value = "notthing"
      }

      setDefaultPos();

      box_part.addEventListener("change", function (e) {
            if (box_part.value == "" || box_part.value == "0") {
                  setDefaultPos();
            } else {
                  for (var i = 0; i < box_position.children.length; i++) {
                            box_position.children[i].classList.add('hidden')
                        if (box_part.value == box_position.children[i].getAttribute("id_part")) {
                              box_position.children[i].classList.remove("hidden");
                        }

                        if (box_position.children[i].value == "") {
                              box_position.children[i].classList.remove("hidden");
                              box_position.value = ""
                        }

                        if (box_position.children[i].value == "notthing") {
                              box_position.children[i].remove();
                        }
                  }
            }
      })
 

      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


      date_user.setAttribute('check', false)

      password_confirm_user.setAttribute('check', false)

      inputs_user.forEach(item => {
         item.setAttribute('check', false);
      })

      selects_user.forEach(item => {
         item.setAttribute('check', false);
      })


      submit_user.addEventListener('click', function(e) {
            inputs_user.forEach(item => {
                  if (item.value == "") {
                        item.placeholder = "Bạn chưa nhập trường này !"
                        item.classList.add('error_input')
                  } 
            })

            selects_user.forEach(item => {
                  if (item.value == "") {
                        const option = document.createElement("option");
                        option.value = "0"
                        option.innerText = "Bạn chưa chọn trường này !";
                        item.appendChild(option)
                        item.value = "0"
                        item.style.color = "red";
                  } 
            })


            if (password_confirm_user.value !== password_user.value && password_user.value !== "" && password_confirm_user.value !== "") {
                  password_confirm_user.value = ""
                  password_confirm_user.placeholder = "Mật khẩu nhập lại không chính xác !"
                  password_confirm_user.classList.add("error_input")
            }

            if (date_user.value == "") {
                  date_user.type = 'text';
                  date_user.placeholder = "Vui lòng nhập trường này !"
                  date_user.classList.add('error_input')
            }

            if (email_user.value == "") {
                  email_user.placeholder = "Bạn chưa nhập Email !"
                  email_user.classList.add('error_input')
            } 
      })


      password_confirm_user.addEventListener ('change', function () {
            if (password_confirm_user.value !== password_user.value) {
                  password_confirm_user.value = ""
                  password_confirm_user.placeholder = "Mật khẩu nhập lại không chính xác !"
                  password_confirm_user.classList.add("error_input")
                  password_confirm_user.setAttribute('check', false)
            } else {
                  password_confirm_user.setAttribute('check', true)
            }
            complete()
      })

      localStorage.setItem("VALUE_EMAIL", JSON.stringify(""));
      
      email_user.addEventListener('change', function (e) {
            localStorage.setItem("VALUE_EMAIL", JSON.stringify(email_user.value));
            if (!regex.test(email_user.value) && email_user.value.length > 0) {
                  email_user.value = ""
                  email_user.placeholder = 'Trường này phải là Email !'
                  email_user.classList.add('error_input')
                  email_user.setAttribute('check', false)
                  submit_user.type = 'button'
            } else {
                  email_user.setAttribute('check', true)
            }
            complete()
      })

      email_user.addEventListener("focus", function (e) {
            email_user.value = localStorage.getItem('VALUE_EMAIL').replace(/"/g, "");
      })


      date_user.addEventListener('focus', function (e) {
            date_user.type = 'date';
            date_user.classList.remove('error_input')
      })

      date_user.addEventListener("blur", function (e) {
            if (date_user.value == "") {
                  date_user.type = 'text';
                  date_user.placeholder = "Vui lòng nhập trường này !"
                  date_user.classList.add('error_input')
                  date_user.setAttribute('check', false);
                  submit_user.type = 'button';
            } else {
                  date_user.setAttribute('check', true);
                  complete()
            }
      })


      inputs_user.forEach(item => {

            item.addEventListener("keyup", function(e) {
                  if (item.value == "") {
                        item.placeholder = "Vui lòng nhập trường này !"
                        item.classList.add('error_input')
                        item.setAttribute('check', false);
                  } else {
                        item.setAttribute('check', true);
                  }

                  complete()

            })

      })

      selects_user.forEach(item => {

            item.addEventListener("mousedown", function(e) {
                  for (var i = 0; i < item.children.length; i++) {
                        if (item.children[i].value == "0") {
                              item.children[i].remove();
                        }
                  }
                  item.style.color = "black"
            })

            item.addEventListener('change', function(e) {
                  if (e.target.value == 0) {
                        const option = document.createElement("option");
                        option.value = "0"
                        option.innerText = "Vui lòng nhập trường này !";
                        item.appendChild(option)
                        item.value = "0"
                        item.style.color = "red";
                        item.style.padding = "0 20px"
                        item.setAttribute('check', false);
                  } else {
                        item.setAttribute('check', true);
                  }

                  complete()
            })


      })


      function complete () {
            var error = 0;
                  selects_user.forEach(select => {
                        if (select.getAttribute('check') == "false") {
                              error++
                        }

                  })

                  inputs_user.forEach(input => {
                        if (input.getAttribute('check') == "false") {
                              error++
                        }
                  })

                  if (email_user.getAttribute('check') == "false") {
                        error++
                  }

                  if (date_user.value == "") {
                        error++;
                  }

                  if (error == 0) {
                        submit_user.type = 'submit';
                  } else {
                        submit_user.type = 'button';
                  }
      }


     
</script>