var nav_aside_name = document.querySelectorAll('.nav-aside-name')
var icon_dropdown = document.querySelectorAll('.icon-drop-down')
var nav_child_items = document.querySelectorAll('.nav-child-item')
var tab_list = document.querySelector('.tab-list')
var aside_items = document.querySelectorAll('.aside-item')


var nav_list = [];
var checked = 0

var step1 = localStorage.getItem('NAV_ACTIVE');
if (step1) {
      var step2 = step1.replace('[', "")
      var step3 = step2.replace(']', "")
      var step4 = step3.replace(/"/g, "")
      var String = step4.replace(/,/g, " ")
      var localStorageArray = String.split(" ")
}

if (localStorageArray && localStorageArray.length > 0) {
      nav_list = localStorageArray
}

nav_list.forEach(curent_active => {
      nav_aside_name.forEach(nav_aside_name => {
            if (nav_aside_name.id == curent_active) {
                  nav_aside_name.children[1].classList.add('rotate-90');
                  nav_aside_name.nextElementSibling.classList.add('height-100');
            }
      })
})


nav_aside_name.forEach((item, index) => {
      item.addEventListener('click', function(e) {
            var is_checked = true
            
            if (nav_list.length == 0 ) {
                  nav_list.push(this.id)
                  localStorage.setItem('NAV_ACTIVE', JSON.stringify(nav_list));
            } else {
                  nav_list.forEach(( arr, index ) => {
                        if (arr == this.id) {
                              nav_list.splice(index, 1);
                              localStorage.setItem('NAV_ACTIVE', JSON.stringify(nav_list));
                              is_checked = false
                              checked = 0
                        } else {
                              checked++
                        }

                  })

                  if (checked > 0 && is_checked == true) {
                        nav_list.push(this.id)
                        localStorage.setItem('NAV_ACTIVE', JSON.stringify(nav_list));
                        checked = 0
                        is_checked == false
                  }
            }

                  this.children[1].classList.toggle('rotate-90');
                  this.nextElementSibling.classList.toggle('height-100');

      })
})





var nav_child_list = [];

var step1 = localStorage.getItem('NAV_CHILD_ACTIVE');
if (step1) {
      var step2 = step1.replace('[', "")
      var step3 = step2.replace(']', "")
      var step4 = step3.replace(/"/g, "")
      var String = step4.replace(/,/g, " ")
      var localNavChildArray = String.split(" ")
}

if (localNavChildArray && localNavChildArray !== null) {
      nav_child_list = localNavChildArray
      
      nav_child_list.forEach(nav_tab => {
            nav_child_items.forEach(nav_child_items => {
                    if (nav_child_items.id == nav_tab) {
                          var name = nav_child_items.children[1].innerText;
                          var href = nav_child_items.children[1].id
                          var active = localStorage.getItem("NAV_CHILD_VALUE")
                          var activeString = active.replace(/"/g, "")
                          var active_class = ""
                          var value = "0"
                          if (activeString == nav_tab) {
                              active_class = 'active-tab'
                              value = "1"
                          }
                         
                          var nav_tabs = document.querySelector('.nav-tabs')
                          nav_tabs.style.height = '50px';


                          aside_items.forEach(aside => {
                                    aside.classList.add('hidden')
                                    if (aside.id == activeString) {
                                          aside.classList.remove('hidden')
                                    }
                              })
                          tab_list.innerHTML+= 
                                            `
                                                  <li  id="${nav_tab}" class="tab-item agn-items-center ${active_class}" value="${value}">
                                                        <a href="?${href}" class="tab-name">${name}</a>
                                                        <span>
                                                              <i class="fa-solid fa-xmark"></i>
                                                        </span>
                                                  </li>    
                                            `
                        var tab_items = document.querySelectorAll('.tab-item')
                        var tab_names = document.querySelectorAll('.tab-name')

                              handerDelele(tab_items)
                              handerActive_tab(tab_items)
                              handleSlideShow(tab_items, tab_names)

                    }
            })
      })
}




nav_child_items.forEach((item) => {
      item.addEventListener('click', function(e) {
            if (tab_list.children.length > 0) {
                  var checked = 0;
                  var tab_items = document.querySelectorAll('.tab-item')
                  tab_items.forEach(tab_item => {
                        if (tab_item.id == this.id) {
                              tab_items.forEach( _item => {
                                    _item.value = '0'
                                    _item.classList.remove('active-tab')
                                    if (_item.id == this.id) {
                                          _item.classList.add('active-tab')
                                          _item.value = '1'
                                          localStorage.setItem('NAV_CHILD_VALUE', JSON.stringify(_item.id))
                                          var nav_tabs = document.querySelector('.nav-tabs')
                                          var slideContainer = document.querySelector('.slider')
                                          var nav_tabs = document.querySelector('.nav-tabs')

                                          slideContainer.style.left = - _item.offsetLeft + (nav_tabs.offsetWidth / 2 - 100 ) +'px'
                                          if (parseInt(slideContainer.style.left) > 0) {
                                                            slideContainer.style.left = '0'
                                                            slideContainer.style.transition = 'none';
                                                     } 

                                                     if ( 
                                                                  _item.offsetLeft > (slideContainer.getBoundingClientRect().width - (nav_tabs.offsetWidth / 2)) &&
                                                                  slideContainer.getBoundingClientRect().width >= nav_tabs.offsetWidth
                                                        ) {
                                                             slideContainer.style.left = - (slideContainer.getBoundingClientRect().width - nav_tabs.offsetWidth) + 'px'
                                                            slideContainer.style.transition = 'none';
                                                     } 

                                          }
                              })
                              aside_items.forEach(aside => {
                                    aside.classList.add('hidden')
                                    if (aside.id == tab_item.id) {
                                          aside.classList.remove('hidden')
                                    }
                              })
                              checked++;
                        } 
                  })

                  if ( checked == 0 ) {
                        var name = item.children[1].innerText
                        var href = item.children[1].id
                        nav_child_list.push(item.id)
                        localStorage.setItem('NAV_CHILD_ACTIVE', JSON.stringify(nav_child_list));

                        tab_list.innerHTML+= 
                              `
                                    <li id="${item.id}" class="tab-item align-items-center">
                                          <a href="?${href}" class="tab-name">${name}</a>
                                          <span>
                                                <i class="fa-solid fa-xmark"></i>
                                          </span>
                                    </li>    
                        `
                        var tab_items = document.querySelectorAll('.tab-item')
                        var tab_names = document.querySelectorAll('.tab-name')
                               handerDelele(tab_items)
                               handerActive_tab(tab_items)
                               handleSlideShow(tab_items, tab_names)
                        tab_items.forEach(item => {
                              item.classList.remove('active-tab')
                              item.value = '0'
                        })

                        var sliderContainer = document.querySelector('.slider')
                        var nav_tabs = document.querySelector('.nav-tabs')
                        if (sliderContainer.offsetWidth > nav_tabs.offsetWidth) {
                              var total = sliderContainer.offsetWidth - nav_tabs.offsetWidth
                              sliderContainer.style.left = - total + `px`;
                        }
                        
                        
                        if (nav_child_list.length > 0) {
                              nav_tabs.style.transition = 'all 0.5s ease';
                              nav_tabs.style.height = '50px';
                        } else {
                              nav_tabs.style.transition = 'all 0.5s ease';
                              nav_tabs.style.height = '0px';
                        }
            
                        tab_list.lastElementChild.classList.add('active-tab');
                        tab_list.lastElementChild.value = '1'
                        localStorage.setItem('NAV_CHILD_VALUE', JSON.stringify(tab_list.lastElementChild.id))
                        aside_items.forEach(aside => {
                              aside.classList.add('hidden')
                              if (aside.id == item.id) {
                                    aside.classList.remove('hidden')
                              }
                        })

                  }
            } else if (tab_list.children.length == 0) {
                  var nav_tabs = document.querySelector('.nav-tabs')
                  nav_tabs.style.transition = 'all 0.5s ease';
                  nav_tabs.style.height = '50px';
                  var name = item.children[1].innerText
                  var href = item.children[1].id
                   nav_child_list.push(item.id)
                   localStorage.setItem('NAV_CHILD_ACTIVE', JSON.stringify(nav_child_list));
                   
                   tab_list.innerHTML+= 
                        `
                              <li id="${item.id}" class="tab-item align-items-center">
                                    <a href="?${href}" class="tab-name">${name}</a>
                                    <span>
                                          <i class="fa-solid fa-xmark"></i>
                                    </span>
                              </li>    
                      `
                          var tab_items = document.querySelectorAll('.tab-item')
                          var tab_names = document.querySelectorAll('.tab-name')
                               handerDelele(tab_items)
                               handerActive_tab(tab_items)
                               handleSlideShow(tab_items, tab_names)

                      tab_items.forEach(item => {
                            item.classList.remove('active-tab')
                            item.value = '0'
                      })
          
                      tab_list.lastElementChild.classList.add('active-tab');
                      tab_list.lastElementChild.value ='1'; 
                      localStorage.setItem('NAV_CHILD_VALUE', JSON.stringify(tab_list.lastElementChild.id))
                      aside_items.forEach(aside => {
                        aside.classList.add('hidden')
                        if (aside.id == item.id) {
                              aside.classList.remove('hidden')
                        }
                  })
      
            }
            
      })
})

function handerActive_tab (tab_items) {
      tab_items.forEach(item => {
            item.children[0].addEventListener('click', function() {
                  var _this = this.parentElement
                  aside_items.forEach(aside => {
                        aside.classList.add('hidden')
                        if (aside.id == _this.id) {
                              aside.classList.remove('hidden')
                        }
                  })
                  tab_items.forEach(item => {
                         item.classList.remove('active-tab')
                         item.value = '0'
                  })
                  _this.classList.add('active-tab')
                  _this.value = '1'
                  localStorage.setItem('NAV_CHILD_VALUE', JSON.stringify(_this.id))
            })
      })
}

function handerDelele(tab_items) {
      tab_items.forEach(item => {
           var iconDelete = item.children[1];
           iconDelete.addEventListener('click', function () {
                  if (this.parentElement.value == '0') {
                       this.parentElement.remove();
                       nav_child_list.forEach((nav_child, index) => {
                           if (this.parentElement.id == nav_child) {
                              nav_child_list.splice(index, 1)
                              localStorage.setItem('NAV_CHILD_ACTIVE', JSON.stringify(nav_child_list));
                           }
                       })

                       var nav_tabs = document.querySelector('.nav-tabs')

                       if (nav_child_list.length > 0) {
                              nav_tabs.style.transition = 'all 0.5s ease';
                              nav_tabs.style.height = '50px';
                        } else {
                              nav_tabs.style.transition = 'all 0.5s ease';
                              nav_tabs.style.height = '0px';
                        }
                       
                  } else {
                        if (this.parentElement.previousElementSibling == null && tab_list.children.length == 1) {  
                              aside_items.forEach(aside => {
                                    aside.classList.add('hidden')
                              })
                              nav_child_list.forEach((nav_child, index) => {
                                    if (this.parentElement.id == nav_child) {
                                       nav_child_list.splice(index, 1)
                                       localStorage.setItem('NAV_CHILD_ACTIVE', JSON.stringify(nav_child_list));
                                        console.log("2");
                                    }
                                })
                                localStorage.setItem('NAV_CHILD_VALUE', JSON.stringify());
                                var nav_tabs = document.querySelector('.nav-tabs')
                                          nav_tabs.style.transition = 'all 0.5s ease';
                                          nav_tabs.style.height = '0px';
                              this.parentElement.remove();
                         } else if (this.parentElement.previousElementSibling == null) {
                              tab_items.forEach(item => {
                                    item.classList.remove('active-tab')
                                    item.value = '0'
                              })
                              nav_child_list.forEach((nav_child, index) => {
                                    if (this.parentElement.id == nav_child) {
                                       nav_child_list.splice(index, 1)
                                       localStorage.setItem('NAV_CHILD_ACTIVE', JSON.stringify(nav_child_list));
                                    }
                                })
                              this.parentElement.nextElementSibling.classList.add('active-tab')
                              this.parentElement.nextElementSibling.value = '1'
                              localStorage.setItem('NAV_CHILD_VALUE', JSON.stringify(this.parentElement.nextElementSibling.id))
                              console.log("3");
                              aside_items.forEach(aside => {
                                    aside.classList.add('hidden')
                                    if (aside.id == this.parentElement.nextElementSibling.id) {
                                          aside.classList.remove('hidden')
                                    }
                              })
                              this.parentElement.remove();
                       } else {
                              this.parentElement.previousElementSibling
                              var SiblingsElement = this.parentElement.previousElementSibling
                              if (SiblingsElement !== null) {
                                    tab_items.forEach(item => {
                                          item.classList.remove('active-tab')
                                          item.value = '0'
                                    })
                                    SiblingsElement.classList.add('active-tab');
                                    SiblingsElement.value = '1'
                                    localStorage.setItem('NAV_CHILD_VALUE', JSON.stringify(SiblingsElement.id))
                                    console.log("3");
                                    aside_items.forEach(aside => {
                                          aside.classList.add('hidden')
                                          if (aside.id == SiblingsElement.id) {
                                                aside.classList.remove('hidden')
                                          }
                                    })
                              }
                              nav_child_list.forEach((nav_child, index) => {
                                    if (this.parentElement.id == nav_child) {
                                       nav_child_list.splice(index, 1)
                                       localStorage.setItem('NAV_CHILD_ACTIVE', JSON.stringify(nav_child_list));

                                    }
                                })
                              this.parentElement.remove();
                        }
                  }
                   
           })
      })
}






function handleSlideShow(card, tab_names) {
      let sliderContainer = document.querySelector('.slider');
      let tab_list = document.querySelector('.tab-list')
      var nav_tabs = document.querySelector('.nav-tabs')
      let pressed = false;
      let startX;
      let x;


      sliderContainer.addEventListener('mouseup', function (e) {
            pressed = false;
            sliderContainer.style.cursor = "grab"; 
            sliderContainer.style.transition = "all 0.5s ease-in-out";
            tab_names.forEach( tab_name => {
                  tab_name.style.pointerEvents = "auto";
                  tab_name.nextElementSibling.style.pointerEvents = "auto"
            })
            checkBoundary();
            tab_list.style.pointerEvents = "auto";
      })
      
      
      sliderContainer.addEventListener("mousedown", (e) => {
            pressed = true;
            innerSlider = sliderContainer;
            startX = e.layerX - innerSlider.offsetLeft;;
            tab_list.style.pointerEvents = "none";
            sliderContainer.style.cursor = "grabbing";
      });
    
        
      sliderContainer.addEventListener("mousemove", (e) => {
            if (!pressed) return;
            tab_names.forEach( tab_name => {
                  tab_name.style.pointerEvents = "none";
                  tab_name.nextElementSibling.style.pointerEvents = "none"
            })
            
            x = e.layerX;
            innerSlider = sliderContainer;
            innerSlider.style.left = `${x - startX}px`;
            tab_list.style.pointerEvents = "none";    
            sliderContainer.style.transition = "none";
      });

      
      window.addEventListener('mouseup', function (e) {
            pressed = false;
            sliderContainer.style.cursor = "grab";
            sliderContainer.style.transition = "all 0.5s ease-in-out";
            tab_names.forEach( tab_name => {
                  tab_name.style.pointerEvents = "auto";
                  tab_name.nextElementSibling.style.pointerEvents = "auto"
            })
            tab_list.style.pointerEvents = "auto";
            checkBoundary();
      })

    
      const checkBoundary = () => {
      
        if (sliderContainer.getBoundingClientRect().right < nav_tabs.getBoundingClientRect().right) {
            var total = sliderContainer.offsetWidth - nav_tabs.offsetWidth
              sliderContainer.style.left = - (total + 7) + `px`;
        }
        
        if (parseInt(sliderContainer.style.left) > 0) {
            sliderContainer.style.left = "0";
        }
 
    };
    
}


