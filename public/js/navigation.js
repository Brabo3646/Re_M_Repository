'use strict';

console.log('js読み取り完了');
const menu = document.getElementById('menu');
const linkspace = document.querySelector('.linkspace');
const close = document.getElementById('close');

menu.addEventListener('click', () => {
    linkspace.classList.add('show');
    menu.classList.add('hide');
});
close.addEventListener('click',() => {
    linkspace.classList.remove('show');
    menu.classList.remove('hide');
})