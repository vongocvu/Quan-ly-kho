var wrapper = document.querySelector('.wrapper')
var box_table_scroll = document.querySelector('.box_table_scroll')

if (box_table_scroll.getBoundingClientRect().height > wrapper.getBoundingClientRect().height) {
      box_table_scroll.style.overflowX = 'scroll'
};