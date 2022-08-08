/* menu header display */
var  nav__element  = document.querySelector('.nav__element--click');
var  link__arrow = document.querySelector('.link__arrow--transform');
var  menu_despegable = document.querySelector('.overlay');
nav__element.addEventListener('click',()=>{
    link__arrow.classList.toggle('link__arrow--rotate');
    menu_despegable.classList.toggle('overlay--active');
});



/*menu aside expand */
var  expand__icon  = document.querySelector('.expand__icon--click');
var  aside  = document.querySelector('.aside');

var nav__link__inicio=document.querySelector(".nav__link-inicio");
var nav__link__usuario=document.querySelector(".nav__link-usuario");
var coordinador=document.querySelector(".nav__link-coordinador");
var convenio=document.querySelector(".nav__link-convenio");
var reporte=document.querySelector(".nav__link-reporte");
var dependencia=document.querySelector(".nav__link-dependencia");
var clasificacion=document.querySelector(".nav__link-clasificacion");
var eje=document.querySelector(".nav__link-eje");

var  main  = document.querySelector('.main');
var  expan__liner  = document.querySelector('.expan__liner');
expand__icon.addEventListener('click',()=>{
    aside.classList.toggle('aside--expand');
    main.classList.toggle('main--expand');
    expan__liner.classList.toggle('expan__liner--active');
    nav__link__inicio.classList.toggle('nav__link--active');
    nav__link__usuario.classList.toggle('nav__link--active');
    coordinador.classList.toggle('nav__link--active');
    convenio.classList.toggle('nav__link--active');
    reporte.classList.toggle('nav__link--active');
    clasificacion.classList.toggle('nav__link--active');
    dependencia.classList.toggle('nav__link--active');
    eje.classList.toggle('nav__link--active');
});


/*table */
$(document).ready( function () {
    $('#Table__Usuarios').DataTable({
        "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          });
} );

$(document).ready( function () {
  $('#Table__Roles').DataTable({
      "language":{
          "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        }
        });
} );

$(document).ready( function () {
    $('#Table__Dependencias').DataTable({
        "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          });
} );
$(document).ready( function () {
    $('#Table__Clasificaciones').DataTable({
        "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          });
} );
$(document).ready( function () {
    $('#Table__Ejes').DataTable({
        "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          });
} );

$(document).ready( function () {
    $('#Table__Coordinadores').DataTable({
        "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          });
} );

$(document).ready( function () {
    $('#Table__CoordinadoresAsignados').DataTable({
        "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          });
} );

$(document).ready( function () {
    $('#Table__Convenios').DataTable({
        

          "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          
          });
} );

$(document).ready( function () {
    $('#Table__Resoluciones').DataTable({
        

          "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          
          });
} );

$(document).ready( function () {
    $('#Table__ResolucionesAsignadas').DataTable({
        

          "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          
          });
} );

$(document).ready( function () {
    $('#Table__InformesPendientes').DataTable({
        

          "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          
          });
} );

$(document).ready( function () {
    $('#Table__InformesPresentados').DataTable({
        

          "language":{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
          }
          
          });
} );








