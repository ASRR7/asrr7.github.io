document.addEventListener("DOMContentLoaded",()=>{
    const menuMobile = document.getElementById("menuMobile");
    const menuPC = document.getElementById("menuPC");
    const cerrarEnlacesMobile = document.getElementById("cerrarEnlacesMobile");
    const enlacesMobile = document.getElementById("enlacesMobile");

    menuMobile.addEventListener("click",()=>{
        enlacesMobile.classList.add("activo");
        document.body.classList.add("no-scroll");
    });
    cerrarEnlacesMobile.addEventListener("click",()=>{
        enlacesMobile.classList.remove("activo");
        document.body.classList.remove("no-scroll");
    });

    // ANCHO DE PANTALLA
    ancho = window.screen.width;
    if(ancho<769){
        menuMobile.classList.remove("none");
        menuPC.classList.add("none");
    } else {
        menuMobile.classList.add("none");
        menuPC.classList.remove("none");
    }
    // RESIZE DE PANTALLA
    window.addEventListener("resize",()=>{
        ancho = window.screen.width;
        if(ancho<769){
            menuMobile.classList.remove("none");
            menuPC.classList.add("none");
        }else{
            menuMobile.classList.add("none");
            menuPC.classList.remove("none");
        }
    });
});
