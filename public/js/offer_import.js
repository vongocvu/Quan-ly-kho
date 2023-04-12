var product_offers = document.querySelectorAll('.product_offer')
var view_offer = document.querySelector('.offer_products')
var input_offer = document.querySelector('.input_offer')


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

var offer_list_main = [];
product_offers.forEach((item, index) => {
      offer_list_main[index] = [
            {
               name: item.children[0].innerText,
               price: item.children[1].innerText,
               price_sell: item.children[2].innerText,
               price_export: item.children[3].innerText,
               unit: item.children[4].innerText,
               image: item.children[5].innerText,
               address: item.children[6].innerText,
               cate: item.children[7].innerText,
               expiry: item.children[8].innerText,
               note: item.children[9].innerText,
               type_cate: item.children[10].innerText,
            }
      ]; 
})

var offer_list = [];


offer_list_main.forEach(offer_value => {
      offer_list.push(offer_value[0].name);
})

function reset_offer () {
      view_offer.innerHTML = ``
}


function show_products_offer () {
      offer_list.forEach(offer => {
            view_offer.innerHTML += `<li class="value_offer">${offer}</li>`
      })
      var value_offer = document.querySelectorAll('.value_offer')
      import_value(value_offer)
}

if (input_offer) {

            input_offer.addEventListener("focus", function () {
                  if (input_offer.value == "") {
                        view_offer.style.display = "block"
                        reset_offer()
                        show_products_offer()
                  }
            })


            input_offer.addEventListener('keyup', function(e) {
                  reset_input_all()
                  let search = offer_list.filter( value => {
                              var valueRemoveAccents = removeAccents(value)
                              return valueRemoveAccents.toUpperCase().trim().includes( removeAccents(input_offer.value).toUpperCase().trim())
                        })
            
                        reset_offer()
      
                        if (input_offer.value == "") {
                              view_offer.style.display = "block"
                              reset_offer()
                              show_products_offer()
                              search = [];
                        } else {
                              search.forEach(value => {
                                    view_offer.style.display = "block"
                                    view_offer.innerHTML += `<li class="value_offer">${value}</li>`
                              })

                              if (search.length == 0) {
                                    view_offer.style.display = "none"
                              };
                        }

                        var value_offer = document.querySelectorAll('.value_offer')
                        import_value(value_offer)
                  })
            }
            
            
function import_value (data) {
      data.forEach(item => {
            item.addEventListener('click', function (e) {
                  input_offer.value = this.innerText
                  input_offer.setAttribute('check', true)
                  show_offer_one(this.innerText)
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


function show_offer_one (offer) {
      var form_expiry = document.querySelector('.form-expiry')
      offer_list_main.forEach(offer_value => {
            if (removeAccents(offer_value[0].name).toUpperCase().trim() == removeAccents(offer).toUpperCase().trim()) {
                input_offer.value =  offer_value[0].name
                document.querySelector('.import_price').value = offer_value[0].price
                document.querySelector('.import_price').setAttribute('readonly', true)
                document.querySelector('.import_price').style.fontWeight = 'bold'
                document.querySelector('.import_price_sell').value = offer_value[0].price_sell
                document.querySelector('.import_price_sell').setAttribute('readonly', true)
                document.querySelector('.import_price_sell').style.fontWeight = 'bold'
                document.querySelector('.import_price_export').value = offer_value[0].price_export
                document.querySelector('.import_price_export').setAttribute('readonly', true)
                document.querySelector('.import_price_export').style.fontWeight = 'bold'
                document.querySelector('.import_unit').value = offer_value[0].unit
                document.querySelector('.import_unit').setAttribute('readonly', true)
                document.querySelector('.import_unit').style.fontWeight = 'bold'
                document.querySelector('.import_unit').style.color = 'black'
                document.querySelector('.import_address').value = offer_value[0].address
                document.querySelector('.import_address').setAttribute('readonly', true)
                document.querySelector('.import_address').style.fontWeight = 'bold'
                document.querySelector('.import_cate').value = offer_value[0].cate
                document.querySelector('.import_cate').setAttribute('readonly', true)
                document.querySelector('.import_cate').style.fontWeight = 'bold'
                document.querySelector('.import_cate').style.color = 'black'
                document.querySelector('.import_note').value = offer_value[0].note
                document.querySelector('.import_note').setAttribute('readonly', true)
                document.querySelector('.import_note').style.fontWeight = 'bold'
                check_form_import()
                view_offer.style.display = "none"
                if (offer_value[0].type_cate == 1) {
                  form_expiry.classList.remove('hidden')
                } else {
                  form_expiry.classList.add('hidden')
                }
            }
      })
}



function reset_input_all () {
            document.querySelector('.import_price').value = ""
            document.querySelector('.import_price').removeAttribute('disabled')
            document.querySelector('.import_price').style.fontWeight = "550"
            document.querySelector('.import_price_sell').value = ""
            document.querySelector('.import_price_sell').removeAttribute('disabled')
            document.querySelector('.import_price_sell').style.fontWeight = "550"
            document.querySelector('.import_price_export').value = ""
            document.querySelector('.import_price_export').removeAttribute('disabled')
            document.querySelector('.import_price_export').style.fontWeight = "550"
            document.querySelector('.import_unit').value = ""
            document.querySelector('.import_unit').removeAttribute('disabled')
            document.querySelector('.import_unit').style.fontWeight = "550"
            document.querySelector('.import_address').value = ""
            document.querySelector('.import_address').removeAttribute('disabled')
            document.querySelector('.import_address').style.fontWeight = "550"
            document.querySelector('.import_cate').value = ""
            document.querySelector('.import_cate').removeAttribute('disabled')
            document.querySelector('.import_cate').style.fontWeight = "550"
            document.querySelector('.import_note').value = ""
            document.querySelector('.import_note').removeAttribute('disabled')
            document.querySelector('.import_note').style.fontWeight = "550"
            check_form_import()
}


var import_start = document.querySelectorAll('.select_start_import')
var submit_startt = document.querySelector('.submit_startt')


if (submit_startt) {
       import_start.forEach(start => {
            start.setAttribute('check', false);
       })

 submit_startt.addEventListener('click', function () {
                   import_start.forEach(start => {
                   if (start.value == "") {
                         const option = document.createElement("option");
                         option.value = "0"
                         option.innerText = "Bạn chưa chọn trường này !";
                         start.appendChild(option)
                         start.value = "0"
                         start.style.color = "red";
                   }
             })
       })

 import_start.forEach(start => {
             start.addEventListener("mousedown", function(e) {
                   for (var i = 0; i < start.children.length; i++) {
                         if (start.children[i].value == "0") {
                               start.children[i].remove();
                         }
                   }
                   start.style.color = "black"
             })

             start.addEventListener('change', function(e) {
                   if (e.target.value == "") {
                         const option = document.createElement("option");
                         option.value = "0"
                         option.innerText = "Vui lòng chọn trường này";
                         start.appendChild(option)
                         start.value = "0"
                         start.style.color = "red";
                         start.style.padding = "0 20px"
                         start.setAttribute('check', false);
                         submit_startt.type= 'button';
                   } else {
                         start.setAttribute('check', true);
                   }
                   complete_start()
             })

       })

 function complete_start () {
       var check = 0
             import_start.forEach(start => {
                   if (start.getAttribute('check') == "false") {
                         check++
                   }
             })

             if (check == 0) {
                   submit_startt.type= 'submit';
             }
       }

}


function check_form_import () {
      var inputs_import = document.querySelectorAll('.input_import')
      var selects_import = document.querySelectorAll('.select_import')
      var submit_import = document.querySelector('.submit_import')
      var image_import = document.querySelector('.image_import')
      if (image_import) {
            if (image_import.value !== "") {
                  image_import.setAttribute('check', true);
            } else {
                  image_import.setAttribute('check', false);
            }

            inputs_import.forEach(item => {
                  if (item.value !== "") {
                        item.setAttribute('check', true);
                  } else {
                        item.setAttribute('check', false);
                  }
            })
     
            selects_import.forEach(select => {
                  if ( select.value !== "") {
                        select.setAttribute('check', true);
                  } else {
                        select.setAttribute('check', false);
                  }
            })
     
            submit_import.addEventListener('click', function(e) {
                  inputs_import.forEach(item => {
                        if (item.value == "") {
                              item.placeholder = "Bạn chưa nhập trường này !"
                              item.classList.add('error_input')
                        } 
                  })
                  
     
                  selects_import.forEach(select => {
     
                        if (select.value == "") {
                              const option = document.createElement("option");
                              option.value = "0"
                              option.innerText = "Bạn chưa chọn trường này !";
                              select.appendChild(option)
                              select.value = "0"
                              select.style.color = "red";
                        } 
                  })
     
                  if (image_import.value == "") {
                        image_import.type = "text"
                        image_import.placeholder = "Bạn chưa chọn ảnh !"
                        image_import.classList.add('error_input')
                  }
            })
     
            image_import.addEventListener("focus", function (e) {
                  image_import.type = "file"
            })
     
            image_import.addEventListener("change", function (e) {
                  if (image_import.value == "") {
                        image_import.type = "text"
                        image_import.placeholder = "Ơ kìa! Chưa chọn ảnh mà !"
                        image_import.classList.add('error_input')
                        image_import.setAttribute('check', false)
                        submit_import.type = 'button';
                  } else {
                        image_import.setAttribute('check', true)
                  }
                  complete_import()
            })
     
            inputs_import.forEach(item => {
     
                  item.addEventListener("change", function(e) {
                        if (item.value == "") {
                              item.placeholder = "Bạn chưa nhập trường này !"
                              item.classList.add('error_input')
                              item.setAttribute('check', false);
                              submit_import.type = 'button';
                        } else {
                              item.setAttribute('check', true);
                        }
     
                        complete_import()
                  })
     
            })
     
            selects_import.forEach(select => {
                  select.addEventListener("mousedown", function(e) {
                        for (var i = 0; i < select.children.length; i++) {
                              if (select.children[i].value == "0") {
                                    select.children[i].remove();
                              }
                        }
                        select.style.color = "black"
                  })
     
                  select.addEventListener('change', function(e) {
                        if (e.target.value == "") {
                              const option = document.createElement("option");
                              option.value = "0"
                              option.innerText = "Vui lòng chọn trường này";
                              select.appendChild(option)
                              select.value = "0"
                              select.style.color = "red";
                              select.style.padding = "0 20px"
                              select.setAttribute('check', false);
                              submit_import.type = 'button';
                        } else {
                              select.setAttribute('check', true);
                        }
     
                        complete_import()
                  })
     
            })
     
     
            function complete_import () {
                  var error = 0;
     
                  selects_import.forEach(select => {
                        if (select.getAttribute('check') == "false") {
                              error++
                        }
                  })
     
                  inputs_import.forEach(input => {
                        if (input.getAttribute('check') == "false") {
                              error++
                        }
                  })

                  if (image_import.getAttribute('check') == "false") {
                        error++
                  }
     
                  if (error == 0) {
                        submit_import.type = 'submit';
                  } else {
                        submit_import.type = 'button';
                  }
            }
     
     
      }
}

check_form_import()