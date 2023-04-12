var btn_move_store = document.querySelectorAll('.btn_move_store')
var box_move_store = document.querySelector('.box_move_store')
var input_number_store = document.querySelector('.input_number_store')
var input_select_store = document.querySelector('.input_select_store')
var input_error = document.querySelector('.input_error')
var select_error = document.querySelector('.select_error')
var cancel_move = document.querySelector('.cancel_move')
var complete_move = document.querySelector('.complete_move')
var id_product = document.querySelector('.id_product')
var id_store = document.querySelector('.id_store')

btn_move_store.forEach(item => {
      item.addEventListener('click', function (e) {
            box_move_store.classList.remove('hidden')
            input_number_store.id = this.id
            id_product.value = this.value
            id_store.value = this.getAttribute('number')
      })
})

var error_quantity = false
var error_select = false
input_number_store.addEventListener('keyup', function (e) {
      if (parseInt(e.target.value) < 0) {
            input_error.innerText = 'Vui lòng không nhập số âm !'
            error_quantity = false
       } else if (parseInt(e.target.value) > parseInt(e.target.id)) {
            input_error.innerText = 'Số lượng trong kho không đủ !'
            error_quantity = false
            if (error_quantity !== true || error_select !== true ) {
                  complete_move.type = 'button'
            }
      } else {
            input_error.innerText = ''
            error_quantity = true
            if (error_quantity == true && error_select == true ) {
                  complete_move.type = 'submit'
            }
      }
})


input_select_store.addEventListener('change', function (e) {
      if (e.target.value == 0) {
            select_error.innerText = 'Vui lòng chọn kho !'
            error_select = false
            if (error_quantity !== true || error_select !== true ) {
                  complete_move.type = 'button'
            }
      } else {
            select_error.innerText = '';
            error_select = true
            if (error_quantity == true && error_select == true ) {
                  complete_move.type = 'submit'
            }
      }
})


cancel_move.addEventListener('click', function (e) {
      box_move_store.classList.add('hidden')
      input_error.innerText = ''
      select_error.innerText = ''
      error_quantity = false
      error_select = false
      input_number_store.value = ''
      input_select_store.value = '0'
      complete_move.type = 'button'
})



complete_move.addEventListener('click', function (e) {
      if ( input_number_store.value == "" ) {
            input_error.innerText = 'Bạn chưa nhập số lượng !'
            error_quantity = false
      }

      if ( input_select_store.value == '0' ) {
            select_error.innerText = 'Bạn chưa chọn kho !'
            error_select = false
      }
})

