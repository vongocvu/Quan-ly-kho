var product_exports = document.querySelectorAll('.product_export')
var view_export = document.querySelector('.export_products')
var input_export = document.querySelector('.input_export')


function removeAccents(str) {
      var AccentsMap = [
        "aàảãáạăằẳẵắặâầẩẫấậ",
        "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
        "dđ", "DĐ",
        "eèẻẽéẹêềểễếệ",
        "EÈẺẼÉẸÊỀỂỄẾỆ",
        "iìỉĩíị",
        "IÌỈĨÍỊ",
        "oòỏõóọôồổỗốộơờởỡớợ",
        "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
        "uùủũúụưừửữứự",
        "UÙỦŨÚỤƯỪỬỮỨỰ",
        "yỳỷỹýỵ",
        "YỲỶỸÝỴ"    
      ];
      for (var i=0; i<AccentsMap.length; i++) {
        var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
        var char = AccentsMap[i][0];
        str = str.replace(re, char);
      }
      return str;
}

var export_list = [];
product_exports.forEach(item => {
      export_list.push(item.innerText)
})


function reset_export () {
      view_export.innerHTML = ``
}

function show_products () {
      export_list.forEach (value => {
            view_export.innerHTML += `<li class="value_export">${value}</li>`
      })
      var value_export = document.querySelectorAll('.value_export')
      export_value(value_export)
}


if (input_export) {
      
     
      show_products();
      
      input_export.addEventListener('focus', function () {
            view_export.style.display = "block"
      })

      

      input_export.addEventListener('keyup', function(e) {
            if (e.target.value.length == 0) {
                  reset_export()
                  show_products();
            } else {
                  let search = export_list.filter( value => {
                              var valueRemoveAccents = removeAccents(value)
                              return valueRemoveAccents.toUpperCase().includes(e.target.value.toUpperCase())
                        })
                        reset_export()
                        
                        search.forEach(value => {
                              if (value.length > 0) {
                                    view_export.innerHTML += `<li class="value_export">${value}</li>`
                                    view_export.style.display = "block"
                                    view_export.style.height = "auto"
                              } 
                        })

                        if (search.length == 0) {
                              view_export.innerHTML = `<li style="font-size: 13px"> - Không tìm thấy kết quả phù hợp!</li>`
                        }
            
                  var value_export = document.querySelectorAll('.value_export')
                  export_value(value_export)
            }
      })
}


function export_value (data) {
      data.forEach(item => {
            item.addEventListener('click', function (e) {
                  e.preventDefault();
                  input_export.value = this.innerText
                  view_export.style.display = "none"
                  input_export.setAttribute('check', true)
            })

      })
      
}


var cate_import = document.querySelectorAll('.cate_import')
var form_expiry = document.querySelector('.form-expiry')
var select_cate = document.querySelector('.select_cate')

if (select_cate) {
      select_cate.addEventListener('change', function (e) {
            cate_import.forEach(item => {
                  if (item.value == e.target.value) {
                        if (item.getAttribute('expiry') == 1) {
                              form_expiry.classList.remove('hidden')
                        } else {
                              form_expiry.classList.add('hidden')
                        }
                  }
            })
      })
}




