var eye_show = document.querySelector('.eye-show');
var eye_close = document.querySelector('.eye-close');
var input = document.querySelector('.input-control-password')
var close_status = document.querySelectorAll('.close-status');
var content_show_status = document.querySelectorAll('.content-show-status')

if (eye_close || eye_show) {
      eye_close.classList.add('hidden')
      
      eye_show.addEventListener('click', function (e) {
            eye_show.classList.add('hidden')
            eye_close.classList.remove('hidden')
            input.type = 'text'
      })
      
      eye_close.addEventListener('click', function (e) {
            eye_show.classList.remove('hidden')
            eye_close.classList.add('hidden')
            input.type = 'password'
      })
}


close_status.forEach( item => {
      item.addEventListener('click', function (e) {
            var parent1 = this.parentElement
            var parent2 = parent1.parentElement
            var parent3 = parent2.parentElement
            parent3.classList.add('hidden')
      })
})