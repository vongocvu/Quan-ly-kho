var nav_asides_left = document.querySelectorAll('.nav-aside-left')
var nav_main_btn = document.querySelectorAll('.nav-main-btn')
var content_pos = document.querySelector('.content-pos')
var content_pos_btn = document.querySelectorAll('.content-pos-btn')
var content_pos_view = document.querySelectorAll('.content-pos-view')



nav_main_btn.forEach(block_item => {
      block_item.addEventListener('click', function(e) {
            nav_main_btn.forEach(block => {
                  block.classList.remove('block-active')
            })
            localStorage.setItem('BLOCK_ACTIVE', JSON.stringify(this.id));
            if (localStorage.getItem('BLOCK_ACTIVE') !== null) {
                  var localStorage_block_id = localStorage.getItem('BLOCK_ACTIVE').replace('"', '')
                  var localStorage_block_id2 = localStorage_block_id.replace('"', '')
                  if (localStorage_block_id2 == block_item.id) {
                        block_item.classList.add('block-active')
                  }
            }

            nav_asides_left.forEach(nav_aside => {
                  if (nav_aside.id == block_item.id) {
                        nav_asides_left.forEach(nav_hidden => {
                              nav_hidden.classList.add('hidden')
                        })
                        nav_aside.classList.remove('hidden')
                  }
            })
      })
})

nav_main_btn.forEach(block_item => {
      block_item.classList.remove('block-active')
      if (localStorage.getItem('BLOCK_ACTIVE') !== null) {
            var localStorage_block_id = localStorage.getItem('BLOCK_ACTIVE').replace('"', '')
            var localStorage_block_id2 = localStorage_block_id.replace('"', '')
            if (localStorage_block_id2 == block_item.id) {
                  block_item.classList.add('block-active')
                  nav_asides_left.forEach(nav_aside => {
                        if (nav_aside.id == localStorage_block_id2) {
                              nav_asides_left.forEach(nav_hidden => {
                                    nav_hidden.classList.add('hidden')
                              })
                              nav_aside.classList.remove('hidden')
                        }
                  })
            }
      }
})




content_pos_btn.forEach(btn_pos => {
      btn_pos.addEventListener('click', function () {
            content_pos.classList.remove('hidden')
            content_pos_view.forEach(view => {
                  if (view.id == this.id) {
                        view.classList.remove('hidden')
                  }
            })
      })
})

