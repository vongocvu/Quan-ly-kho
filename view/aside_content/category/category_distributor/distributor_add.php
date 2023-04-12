<div id="distributor_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
           <div class="content-title">
                  <h4>Quản lý nhà phân phối</h4>
            </div>


            <form action="?c=distributor&a=add" method="POST" class="form-add-wrapper">
                   <div class="content-title form-add-title">
                          <h4><i class="fa-solid fa-plus"></i> Thêm nhà phân phối</h4>
                   </div>
                   <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Tên: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_distributor" type="text" name="name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Mã số thuế: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_distributor" type="text" name="taxcode" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Số điện thoại: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_distributor" type="text" name="phone" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Email: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_distributor distibutor_email" type="email" name="email" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Địa chỉ: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input input_distributor" type="text" name="address" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ghi chú:</label>
                              <input  class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="button" name="submit_add" class="btn save-btn submit_distributor">Thêm</button>
                       </div>
                   </div>
            </form>
      </div>
</div>

<script type="text/javascript">
      var inputs_distributor = document.querySelectorAll('.input_distributor')
      var submit_distributor = document.querySelector('.submit_distributor')
      var email_distributor = document.querySelector('.distibutor_email')


      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


      inputs_distributor.forEach(item => {
         item.setAttribute('check', false);
      })

      submit_distributor.addEventListener('click', function(e) {
            inputs_distributor.forEach(item => {
                  
                  if (item.value == "") {
                        item.placeholder = "Vui lòng nhập trường này !"
                        item.classList.add('error_input')
                        item.setAttribute('check', false);
                        submit_distributor.type = 'button';
                  } else {
                        item.setAttribute('check', true);
                  }

            })

            if (!regex.test(email_distributor.value) && email_distributor.value.length > 0) {
               email_distributor.value = ""
               email_distributor.placeholder = 'Trường này phải là Email !'
            }
      })

      localStorage.setItem("VALUE_EMAIL", JSON.stringify(""));
      
      email_distributor.addEventListener('change', function (e) {
            localStorage.setItem("VALUE_EMAIL", JSON.stringify(email_distributor.value));
            if (!regex.test(email_distributor.value) && email_distributor.value.length > 0) {
                  email_distributor.value = ""
                  email_distributor.placeholder = 'Trường này phải là Email !'
                  email_distributor.classList.add('error_input')
                  email_distributor.setAttribute('check', false)
                  submit_distributor.type = 'button'
            } 
            complete()
      })

      email_distributor.addEventListener("focus", function (e) {
            email_distributor.value = localStorage.getItem('VALUE_EMAIL').replace(/"/g, "");
      })
      
      inputs_distributor.forEach(item => {
            item.addEventListener("keyup", function(e) {
                  if (item.value == "") {
                        item.placeholder = "Vui lòng nhập trường này !"
                        item.classList.add('error_input')
                        item.setAttribute('check', false);
                  } else {
                        item.setAttribute('check', true);
                  }

                  complete_distributor()

            })
      })


      function complete_distributor () {
            var error = 0;

                  inputs_distributor.forEach(input => {
                        if (input.getAttribute('check') == "false") {
                              error++
                        }
                  })

                  if (error == 0) {
                        submit_distributor.type = 'submit';
                  } else {
                        submit_distributor.type = 'button';
                  }
      }


     
</script>