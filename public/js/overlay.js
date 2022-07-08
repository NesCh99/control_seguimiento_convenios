/* menu header display */
var  buscar  = document.querySelector('.fila__label--click');
var  overlay = document.querySelector('.overlay__table');
var  overlayOff = document.querySelector('.nav__link--small--click');

buscar.addEventListener('click',()=>{
    overlay.classList.toggle('overlay__table--active');
});

overlayOff.addEventListener('click',()=>{
    overlay.classList.remove('overlay__table--active');
    
});


var  buscarDelegado  = document.querySelector('.fila__label--click1');
var  overlayDelegado = document.querySelector('.overlay__table1');
var  overlayOff1 = document.querySelector('.nav__link--small--click1');
buscarDelegado.addEventListener('click',()=>{
    overlayDelegado.classList.toggle('overlay__table--active');
});

overlayOff1.addEventListener('click',()=>{
    overlayDelegado.classList.remove('overlay__table--active');
    
});

