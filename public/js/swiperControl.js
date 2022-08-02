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



  
var matriz = document.querySelector('.matriz--click');
var estaditica = document.querySelector('.estadistica--click');
var caducados = document.querySelector('.caducado--click');

var vigente_general = document.querySelector('.vigente-g--click');
var caducado_general = document.querySelector('.caducado-g--click');



var overlayMatriz = document.querySelector('.overlay__matriz');
var overlayEstadistica = document.querySelector('.overlay_estaditica');
var overlayCaducado = document.querySelector('.caducado_overlay--click');

var overlayCaducadoG = document.querySelector('.caducadoG_overlay--click');

var overlayVidgenteG = document.querySelector('.vigenteG_overlay--click');

matriz.addEventListener('click', () => {

  overlayMatriz.classList.toggle('overlay--active');
  matriz.classList.toggle('lock');
  overlayEstadistica.classList.remove('overlay--active');
  overlayCaducado.classList.remove('overlay--active');
  estaditica.classList.remove('lock');
  caducados.classList.remove('lock');

  vigente_general.classList.remove('lock');
  caducado_general.classList.remove('lock');
  overlayCaducadoG.classList.remove('overlay--active');
  overlayVidgenteG.classList.remove('overlay--active');
 

});

estaditica.addEventListener('click', () => {
  estaditica.classList.toggle('lock');
  overlayEstadistica.classList.toggle('overlay--active');

  overlayMatriz.classList.remove('overlay--active');
  overlayCaducado.classList.remove('overlay--active');
  matriz.classList.remove('lock');
  caducados.classList.remove('lock');

  vigente_general.classList.remove('lock');
  caducado_general.classList.remove('lock');
  overlayCaducadoG.classList.remove('overlay--active');
  overlayVidgenteG.classList.remove('overlay--active');


});




caducados.addEventListener('click', () => {
  caducados.classList.toggle('lock');
  overlayCaducado.classList.toggle('overlay--active');

  overlayMatriz.classList.remove('overlay--active');
  overlayEstadistica.classList.remove('overlay--active');
  matriz.classList.remove('lock');
  estaditica.classList.remove('lock');


  vigente_general.classList.remove('lock');
  caducado_general.classList.remove('lock');
  overlayCaducadoG.classList.remove('overlay--active');
  overlayVidgenteG.classList.remove('overlay--active');


});




vigente_general.addEventListener('click', () => {

  vigente_general.classList.toggle('lock');
  overlayVidgenteG.classList.toggle('overlay--active');



  caducados.classList.remove('lock');
  overlayCaducado.classList.remove('overlay--active');

  overlayMatriz.classList.remove('overlay--active');
  overlayEstadistica.classList.remove('overlay--active');
  matriz.classList.remove('lock');
  estaditica.classList.remove('lock');


 

  caducado_general.classList.remove('lock');
  overlayCaducadoG.classList.remove('overlay--active');
 


});




caducado_general.addEventListener('click', () => {


  caducado_general.classList.toggle('lock');
  overlayCaducadoG.classList.toggle('overlay--active');



  caducados.classList.remove('lock');
  overlayCaducado.classList.remove('overlay--active');

  overlayMatriz.classList.remove('overlay--active');
  overlayEstadistica.classList.remove('overlay--active');
  matriz.classList.remove('lock');
  estaditica.classList.remove('lock');


  vigente_general.classList.remove('lock');

  overlayVidgenteG.classList.remove('overlay--active');


});







