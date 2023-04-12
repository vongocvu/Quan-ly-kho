var content_pos = document.querySelector('.content-pos')
var close_content_pos = document.querySelector('.close-content-pos')
var content_pos_view = document.querySelectorAll('.content-pos-view')

close_content_pos.addEventListener('click', function () {
      content_pos.classList.add('hidden')
      content_pos_view.forEach(view => {
            view.classList.add('hidden')
      })
})

