var curent_page = document.querySelector('.curent-page');
var navbar_items = document.querySelectorAll('.navbar-item')
var nav_contents = document.querySelectorAll('.nav-content')

navbar_items.forEach((item) => {
      item.addEventListener('click', function (e) {
            localStorage.setItem('NAVBAR_ITEM', JSON.stringify(this.id))
            navbar_items.forEach(x => {
                  x.classList.remove('active')
                  curent_page.innerHTML = this.innerText
                  document.title = this.innerText
                  this.classList.add('active')
            })
            

            nav_contents.forEach(nav_content => {
                  nav_content.classList.add('hidden')
                  if (nav_content.id == this.id) {
                    nav_content.classList.remove('hidden')
                  }
            })
           
      })
      
})



var localPage = localStorage.getItem('NAVBAR_ITEM')
if (localPage) {
      var StringLocalPage = localPage.replace(/"/g, "")
      navbar_items.forEach(x => {
            x.classList.remove('active')
            if (x.id == StringLocalPage) {
                  x.classList.add('active')
                  document.title = x.innerText
            }

            nav_contents.forEach(nav_content => {
                  nav_content.classList.add('hidden')
                  if (nav_content.id == StringLocalPage) {
                    nav_content.classList.remove('hidden')
                  }
            })
      })
}

var close_status = document.querySelector('.close-status')
var content_show_status = document.querySelector('.content-show-status')

if (close_status) {
      close_status.addEventListener('click', function () {
            content_show_status.classList.add('hidden')
      })
}
