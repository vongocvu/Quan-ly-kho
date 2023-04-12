<div id="CateProducts_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
           <div class="content-title">
                  <h4>Quản lý nhóm hàng</h4>
            </div>


            <form action="?c=cateProducts&a=add" method="POST" class="form-add-wrapper">
                   <div class="content-title form-add-title">
                          <h4><i class="fa-solid fa-plus"></i> Nhóm hàng</h4>
                   </div>
                   <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Tên nhóm hàng: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input cate_input" type="text" name="name" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Thời hạn sử dụng: <span class="input_obligatory"> * </span></label>
                              <select class="form-item-input cate_select" name="expiry" style="padding-left: 20px !important">
                                    <option value="">Chọn</option>
                                    <option value="0">Không có hạn sử dụng</option>
                                    <option value="1">Có hạn sử dụng</option>
                              </select>
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ghi chú:</label>
                              <input  class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="button" name="submit_add" class="btn save-btn cate_submit">Thêm</button>
                       </div>
                   </div>
            </form>
      </div>
</div>

<script type="text/javascript">
      var cate_input = document.querySelector('.cate_input')
      var cate_select = document.querySelector('.cate_select')
      var cate_submit = document.querySelector('.cate_submit')

      cate_input.setAttribute('check', false)
      cate_select.setAttribute('check', false)
      
      cate_submit.addEventListener("click", function (e) {
            if (cate_input.value == "") {
                  cate_input.placeholder = "Bạn chưa nhập trường này !"
                  cate_input.classList.add('error_input')
            }

            if (cate_select.value == "") {
                  const option = document.createElement("option");
                  option.value = "3"
                  option.innerText = "Vui lòng nhập trường này !";
                  cate_select.appendChild(option)
                  cate_select.value = "3"
                  cate_select.style.color = "red"
            }
      })

      cate_select.addEventListener('mousedown', function (e) {
            for (var i = 0; i < cate_select.children.length; i++) {
                  if (cate_select.children[i].value == "3") {
                        cate_select.children[i].remove()
                        cate_select.style.color = "black"
                  }
            }
      })

      cate_select.addEventListener('change', function (e) {
                  if (cate_select.value == "") {
                        const option = document.createElement("option");
                        option.value = "3"
                        option.innerText = "Vui lòng nhập trường này !";
                        cate_select.appendChild(option)
                        cate_select.value = "3"
                        cate_select.style.color = "red"
                        cate_select.setAttribute("check", false)
                        cate_submit.type = "button"
                  } else {
                        cate_select.setAttribute("check", true)
                        complete_cate()
                  }
      })

      cate_input.addEventListener("change", function (e) {
            if (cate_input.value == "") {
                  cate_input.setAttribute('check', false)
                  cate_submit.type = "button"
            } else {
                  cate_input.setAttribute('check', true)
            }
            complete_cate();
      })


      function complete_cate () {
            var error = 0;
                  
            if (cate_input.getAttribute('check') == "false") {
                  error++
            }

            if (cate_select.getAttribute('check') == "false") {
                  error++
            }

            if (error == 0) {
                  cate_submit.type = 'submit';
            } else {
                  cate_submit.type = 'button';
            }
      }


     
</script>