<div id="position_add_view" class="aside-item hidden roles-content">
      <div class="content-add-roles">
           <div class="content-title">
                  <h4>Quản lý chức vụ</h4>
            </div>


            <form action="?c=position&a=add" method="POST" class="form-add-wrapper">
                   <div class="content-title form-add-title">
                          <h4><i class="fa-solid fa-plus"></i> Thêm chức vụ</h4>
                   </div>
                   <div class="form-add-container">
                        <div class="form-item w-30">
                              <label class="form-item-name">Tên chức vụ: <span class="input_obligatory"> * </span></label>
                              <input  class="form-item-input position_input" type="text" name="name" placeholder="Nhập thông tin">
                        </div>

                        
                        <div class="form-item w-30">
                              <label class="form-item-name">Bộ phận: <span class="input_obligatory"> * </span></label>
                              <select class="form-item-input position_select" name="part">
                                    <option value="">Chọn bộ phận</option>
                               <?php 
                                    require_once PATH_APPLICATION . '/core/Base_Model.php';
                                    $db = new Base_Model();

                                    $parts = $db->conn->query("SELECT * FROM bophan");
                                    foreach ($parts as $part) {
                                       ?> 
                                         <option value="<?=$part['id_bophan']?>"><?=$part['tenbophan']?></option>
                                       <?php
                                    }
                                ?>
                              </select>
                        </div>

                        <div class="form-item w-30">
                              <label class="form-item-name">Ghi chú:</label>
                              <input  class="form-item-input" type="text" name="note" placeholder="Nhập thông tin">
                        </div>

                        <div class="form-item" style="display: flex; flex-direction: row-reverse;">
                              <button type="button" name="submit_add" class="btn save-btn position_submit">Thêm</button>
                       </div>
                   </div>
            </form>
      </div>
</div>

<script type="text/javascript">
      var position_input = document.querySelector('.position_input')
      var position_select = document.querySelector('.position_select')
      var position_submit = document.querySelector('.position_submit')

      position_input.setAttribute('check', false)
      position_select.setAttribute('check', false)
      
      position_submit.addEventListener("click", function (e) {
            if (position_input.value == "") {
                  position_input.placeholder = "Bạn chưa nhập trường này !"
                  position_input.classList.add('error_input')
            }

            if (position_select.value == "") {
                  const option = document.createElement("option");
                  option.value = "0"
                  option.innerText = "Vui lòng nhập trường này !";
                  position_select.appendChild(option)
                  position_select.value = "0"
                  position_select.style.color = "red"
            }
      })

      position_select.addEventListener('mousedown', function (e) {
            for (var i = 0; i < position_select.children.length; i++) {
                  if (position_select.children[i].value == "0") {
                        position_select.children[i].remove()
                        position_select.style.color = "black"
                  }
            }
      })

      position_select.addEventListener('change', function (e) {
                  if (position_select.value == "") {
                        const option = document.createElement("option");
                        option.value = "0"
                        option.innerText = "Vui lòng nhập trường này !";
                        position_select.appendChild(option)
                        position_select.value = "0"
                        position_select.style.color = "red"
                        position_select.setAttribute("check", false)
                        position_submit.type = "button"
                  } else {
                        position_select.setAttribute("check", true)
                        complete_position()
                  }
      })

      position_input.addEventListener("change", function (e) {
            if (position_input.value == "") {
                  position_input.setAttribute('check', false)
                  position_submit.type = "button"
            } else {
                  position_input.setAttribute('check', true)
            }
            complete_position();
      })


      function complete_position () {
            var error = 0;
                  
            if (position_input.getAttribute('check') == "false") {
                  error++
            }

            if (position_select.getAttribute('check') == "false") {
                  error++
            }

            if (error == 0) {
                  position_submit.type = 'submit';
            } else {
                  position_submit.type = 'button';
            }
      }


     
</script>