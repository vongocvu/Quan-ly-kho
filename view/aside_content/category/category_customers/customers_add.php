<div id="customers_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
           <div class="content-title">
                  <h4>Thêm mới khách hàng</h4>
            </div>


            <form action="?c=customers&a=add" method="POST" class="form-add-wrapper">
                   <div class="content-title form-add-title">
                          <h4><i class="fa-solid fa-plus"></i> Nhập thông tin khách hàng</h4>
                   </div>
                   <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Họ: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_customer" type="text" name="last_name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Tên: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_customer" type="text" name="first_name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Giới tính: <span class="input_obligatory"> * </span></label>
                              <select name="sex" class="form-item-input select_customer">
                                          <option value="">Chọn giới tính</option>
                                          <option value="1">Nam</option>s
                                          <option value="2">Nữ</option>
                                          <option value="2">Giới tính khác</option>
                                    </select>
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ngày sinh: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input date_customer" type="date" name="birthday" placeholder="Nhập thông tin">
                        </div>

                        
                        <div class="form-item w-30">
                              <label class="form-item-name">Email: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_customer" type="email" name="email" placeholder="Nhập thông tin">
                        </div>
                        
                        <div class="form-item w-30">
                              <label class="form-item-name">Số điện thoại: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_customer" type="text" name="phone" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Địa chỉ: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_customer" type="text" name="address" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ghi chú:</label>
                              <input  class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30"></div>

                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="button" name="submit_add" class="btn save-btn submit_customer">Thêm</button>
                       </div>
                   </div>
            </form>
      </div>
</div>

<script type="text/javascript">
      var inputs_customer = document.querySelectorAll('.input_customer')
      var submit_customer = document.querySelector('.submit_customer')
      var selects_customer = document.querySelector('.select_customer')
      var date_customer = document.querySelector('.date_customer')

      date_customer.setAttribute('check', false)

      inputs_customer.forEach(item => {
         item.setAttribute('check', false);
      })

      selects_customer.setAttribute('check', false);

      submit_customer.addEventListener('click', function(e) {
            inputs_customer.forEach(item => {
                  if (item.value == "") {
                        item.placeholder = "Vui lòng nhập trường này !"
                        item.classList.add('error_input')
                        item.setAttribute('check', false);
                        submit_customer.type = 'button';
                  } else {
                        item.setAttribute('check', true);
                  }
            })

                  if (selects_customer.value == "") {
                        const option = document.createElement("option");
                        option.value = "0"
                        option.innerText = "Vui lòng nhập trường này !";
                        selects_customer.appendChild(option)
                        selects_customer.value = "0"
                        selects_customer.style.color = "red";
                        selects_customer.setAttribute('check', false);
                        submit_customer.type = 'button';
                  } else {
                        selects_customer.setAttribute('check', true);
                  }

            if (date_customer.value == "") {
                  date_customer.type = 'text';
                  date_customer.placeholder = "Vui lòng nhập trường này !"
                  date_customer.classList.add('error_input')
                  date_customer.setAttribute('check', false);
                  submit_customer.type = 'button';
            } else {
                  date_customer.setAttribute('check', true);
            }
      })


      date_customer.addEventListener('focus', function (e) {
            date_customer.type = 'date';
            date_customer.classList.remove('error_input')
      })

      date_customer.addEventListener("blur", function (e) {
            if (date_customer.value == "") {
                  date_customer.type = 'text';
                  date_customer.placeholder = "Vui lòng nhập trường này !"
                  date_customer.classList.add('error_input')
                  date_customer.setAttribute('check', false);
                  submit_customer.type = 'button';
            } else {
                  date_customer.setAttribute('check', true);
                  complete_customer()
            }
      })



      inputs_customer.forEach(item => {

            item.addEventListener("keyup", function(e) {
                  if (item.value == "") {
                        item.placeholder = "Vui lòng nhập trường này !"
                        item.classList.add('error_input')
                        item.setAttribute('check', false);
                  } else {
                        item.setAttribute('check', true);
                  }

                  complete_customer()

            })

      })


            selects_customer.addEventListener("mousedown", function(e) {
                  for (var i = 0; i < selects_customer.children.length; i++) {
                        if (selects_customer.children[i].value == "0") {
                              selects_customer.children[i].remove();
                        }
                  }
                  selects_customer.style.color = "black"
            })

            selects_customer.addEventListener('change', function(e) {
                  if (e.target.value == 0) {
                        const option = document.createElement("option");
                        option.value = "0"
                        option.innerText = "Vui lòng nhập trường này !";
                        selects_customer.appendChild(option)
                        selects_customer.value = "0"
                        selects_customer.style.color = "red";
                        selects_customer.style.padding = "0 20px"
                        selects_customer.setAttribute('check', false);
                  } else {
                        selects_customer.setAttribute('check', true);
                  }

                  complete_customer()
            })


      function complete_customer () {
            var error = 0;
                        if (selects_customer.getAttribute('check') == "false") {
                              error++
                        }

                  inputs_customer.forEach(input => {
                        if (input.getAttribute('check') == "false") {
                              error++
                        }
                  })

                  if (date_customer.value == "") {
                        error++;
                  }

                  if (error == 0) {
                        submit_customer.type = 'submit';
                  } else {
                        submit_customer.type = 'button';
                  }
      }


     
</script>