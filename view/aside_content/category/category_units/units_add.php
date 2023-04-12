<div id="units_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
           <div class="content-title">
                  <h4>Quản lý đơn vị tính</h4>
            </div>


            <form action="?c=units&a=add" method="POST" class="form-add-wrapper">
                   <div class="content-title form-add-title">
                          <h4><i class="fa-solid fa-plus"></i> Thêm đơn vị tính</h4>
                   </div>
                   <div class="form-add-container">
                        <div class="form-item w-40">
                              <label class="form-item-name">Tên đơn vị tính: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input unit_input" type="text" name="name" placeholder="Nhập thông tin">
                        </div>


                        <div class="form-item w-40">
                              <label class="form-item-name">Ghi chú:</label>
                              <input  class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-20"></div>

                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="button" name="submit_add" class="btn save-btn unit_submit">Thêm</button>
                       </div>
                   </div>
            </form>
      </div>
</div>

<script type="text/javascript">
      var unit_input = document.querySelector('.unit_input')
      var unit_submit = document.querySelector('.unit_submit')

      unit_input.setAttribute('check', false)
      
      unit_submit.addEventListener("click", function (e) {
            if (unit_input.value == "") {
                  unit_input.placeholder = "Bạn chưa nhập trường này !"
                  unit_input.classList.add('error_input')
            }
      })


      unit_input.addEventListener("change", function (e) {
            if (unit_input.value == "") {
                  unit_input.setAttribute('check', false)
            } else {
                  unit_input.setAttribute('check', true)
            }
            complete_unit();
      })


      function complete_unit () {
            var error = 0;
                  
            if (unit_input.getAttribute('check') == "false") {
                  error++
            }

            if (error == 0) {
                  unit_submit.type = 'submit';
            } else {
                  unit_submit.type = 'button';
            }
      }


     
</script>