var inputs_checkbox = document.querySelectorAll("input[type='checkbox']");


inputs_checkbox.forEach( input => {
      input.addEventListener('change', function (e) {
            if (e.target.checked == true ) {
                  e.target.value = '1'
            } else {
                  e.target.value = '0'
            }
      })
})