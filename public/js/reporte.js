var  matriz  = document.querySelector('.matriz--click');
var  estaditica = document.querySelector('.estadistica--click');
var  overlayMatriz = document.querySelector('.overlay__matriz');
var  overlayEstadistica = document.querySelector('.overlay_estaditica');
matriz.addEventListener('click',()=>{
    
    overlayMatriz.classList.toggle('overlay--active');
    overlayEstadistica.classList.remove('overlay--active');
    estaditica.classList.remove('lock'); 
    matriz.classList.toggle('lock');


});

estaditica.addEventListener('click',()=>{
   
    overlayMatriz.classList.remove('overlay--active');
    overlayEstadistica.classList.toggle('overlay--active');
    matriz.classList.remove('lock'); 
    estaditica.classList.toggle('lock');
});






