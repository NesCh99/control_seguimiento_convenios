var swiper = new Swiper(".mySwiper", {
    cssMode: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
    },
    mousewheel: true,
    keyboard: true,
  });



var  matriz  = document.querySelector('.matriz--click');
var  estaditica = document.querySelector('.estadistica--click');
var  caducados = document.querySelector('.caducado--click');

var  overlayMatriz = document.querySelector('.overlay__matriz');
var  overlayEstadistica = document.querySelector('.overlay_estaditica');
var  overlayCaducado = document.querySelector('.caducado_overlay--click');

matriz.addEventListener('click',()=>{
    
    overlayMatriz.classList.toggle('overlay--active');
    overlayEstadistica.classList.remove('overlay--active');
    overlayCaducado.classList.remove('overlay--active');
    estaditica.classList.remove('lock'); 
    caducados.classList.remove('lock'); 
    matriz.classList.toggle('lock');


});

estaditica.addEventListener('click',()=>{
    estaditica.classList.toggle('lock');
    overlayEstadistica.classList.toggle('overlay--active');

    overlayMatriz.classList.remove('overlay--active');
    overlayCaducado.classList.remove('overlay--active');
    matriz.classList.remove('lock'); 
    caducados.classList.remove('lock');


});




caducados.addEventListener('click',()=>{
  caducados.classList.toggle('lock');
  overlayCaducado.classList.toggle('overlay--active');

  overlayMatriz.classList.remove('overlay--active');
  overlayEstadistica.classList.remove('overlay--active');
  matriz.classList.remove('lock'); 
  estaditica.classList.remove('lock');


});
