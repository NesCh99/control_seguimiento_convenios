const btnImagen = document.querySelector("#exportar__grafico--1");
const imagen1 = document.querySelector("#graph1");
const btnImagen2 = document.querySelector("#exportar__grafico--2");
const imagen2 = document.querySelector("#graph2");
const btnImagen3 = document.querySelector("#exportar__grafico--3");
const imagen3 = document.querySelector("#graph3");



const btnImagen4 = document.querySelector("#exportar__grafico--4");
const imagen4 = document.querySelector("#graph4");
const btnImagen5 = document.querySelector("#exportar__grafico--5");
const imagen5 = document.querySelector("#graph5");

const btnImagen6 = document.querySelector("#exportar__grafico--6");
const imagen6 = document.querySelector("#graph7");

const btnImagen8 = document.querySelector("#exportar__grafico--8");
const imagen8 = document.querySelector("#graph8");



const btnImagen9 = document.querySelector("#exportar__grafico--9");
const imagen9 = document.querySelector("#graph9");



const btnImagen10 = document.querySelector("#exportar__grafico--10");
const imagen10 = document.querySelector("#graph10");


const btnImagen11 = document.querySelector("#exportar__grafico--11");
const imagen11 = document.querySelector("#graph11");

const btnImagen12 = document.querySelector("#exportar__grafico--12");
const imagen12 = document.querySelector("#graph12");



const btnImagen13 = document.querySelector("#exportar__grafico--13");
const imagen13 = document.querySelector("#graph13");




btnImagen.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(imagen1.msToBlob(), "convenios-clasificacion.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen1.toDataURL();
        a.download = "convenios-clasificacion.png";
        a.click();
    }
});

btnImagen2.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(imagen2.msToBlob(), "nivel-cumplimineto-parcial.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen2.toDataURL();
        a.download = "nivel-cumplimineto-parcial.png";
        a.click();
    }
});

btnImagen3.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(imagen3.msToBlob(), "nivel-cumplimineto-total.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen3.toDataURL();
        a.download = "nivel-cumplimineto-total.png";
        a.click();
    }
});

btnImagen4.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(imagen4.msToBlob(), "convenios-caducados.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen4.toDataURL();
        a.download = "convenios-caducados.png";
        a.click();
    }
});







btnImagen5.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(imagen5.msToBlob(), "nivel-cumplimineto-Parcial-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen5.toDataURL();
        a.download = "nivel-cumplimineto-Parcial-caducado.png";
        a.click();
    }
});

btnImagen6.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(image6.msToBlob(), "nivel-cumplimineto-total-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen6.toDataURL();
        a.download = "nivel-cumplimineto-total-caducado.png";
        a.click();
    }
});




btnImagen8.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(image8.msToBlob(), "nivel-cumplimineto-total-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen8.toDataURL();
        a.download = "nivel-cumplimineto-total-caducado.png";
        a.click();
    }
});



btnImagen9.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(image9.msToBlob(), "nivel-cumplimineto-total-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen9.toDataURL();
        a.download = "nivel-cumplimineto-total-caducado.png";
        a.click();
    }
});




btnImagen10.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(image10.msToBlob(), "nivel-cumplimineto-total-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen10.toDataURL();
        a.download = "nivel-cumplimineto-total-caducado.png";
        a.click();
    }
});




btnImagen11.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(image11.msToBlob(), "nivel-cumplimineto-total-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen11.toDataURL();
        a.download = "nivel-cumplimineto-total-caducado.png";
        a.click();
    }
});








btnImagen12.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(image12.msToBlob(), "nivel-cumplimineto-total-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen12.toDataURL();
        a.download = "nivel-cumplimineto-total-caducado.png";
        a.click();
    }
});






btnImagen13.addEventListener("click", function () {

    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(image13.msToBlob(), "nivel-cumplimineto-total-caducado.png");
    } else {
        const a = document.createElement("a");
        a.href = imagen13.toDataURL();
        a.download = "nivel-cumplimineto-total-caducado.png";
        a.click();
    }
});

