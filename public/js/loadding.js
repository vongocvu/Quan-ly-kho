var spinner = document.querySelector('#spinner')


function loadding () {
      setTimeout(function () {
            spinner.classList.remove('show')
      },500)
}

loadding();