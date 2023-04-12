<div id="parts_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
           <div class="content-title">
                  <h4>Quản lý bộ phận</h4>
            </div>


            <form action="?c=parts&a=add" method="POST" class="form-add-wrapper">
                   <div class="content-title form-add-title">
                          <h4><i class="fa-solid fa-plus"></i> Thêm bộ phận</h4>
                   </div>
                   <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Tên bộ phận: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input part_input" type="text" name="part_name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ghi chú:</label>
                              <input  class="form-item-input" type="text" name="part_note" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30"></div>

                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="button" name="submit_add" class="btn save-btn part_submit">Thêm</button>
                       </div>
                   </div>
            </form>
      </div>
</div>

<script type="text/javascript">
      var part_input = document.querySelector('.part_input')
      var part_submit = document.querySelector('.part_submit')

      part_input.setAttribute('check', false)
      
      part_submit.addEventListener("click", function (e) {
            if (part_input.value == "") {
                  part_input.placeholder = "Bạn chưa nhập trường này !"
                  part_input.classList.add('error_input')
            }
      })


      part_input.addEventListener("change", function (e) {
            if (part_input.value == "") {
                  part_input.setAttribute('check', false)
            } else {
                  part_input.setAttribute('check', true)
            }
            complete_part();
      })


      function complete_part () {
            var error = 0;
                  
            if (part_input.getAttribute('check') == "false") {
                  error++
            }

            if (error == 0) {
                  part_submit.type = 'submit';
            } else {
                  part_submit.type = 'button';
            }
      }


     
</script>