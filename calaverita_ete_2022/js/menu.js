let ubicacionPrincipal = window.pageYOffset
let cabecera = document.getElementById("cabecera");
window.addEventListener("scroll", function() {
    let ubicacionActual = window.pageYOffset;
    if (800 >= ubicacionActual){
        cabecera.classList.remove("cabecera-transicion");
    }
    else {
        cabecera.classList.add("cabecera-transicion");
    }
});
