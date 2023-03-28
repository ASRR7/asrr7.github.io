const registro = document.getElementById("registro");
const inicio = document.getElementById("inicio");
const contenedorRegistro = document.getElementById("form-usuario-registro");
const contenedorInicio = document.getElementById("form-usuario-inicio");
registro.addEventListener("click",()=>{
    contenedorInicio.classList.add("desaparecer");
    setTimeout(() => {
        contenedorInicio.classList.remove("desaparecer");
        contenedorInicio.classList += " none";
        contenedorRegistro.classList.remove("none");
        contenedorRegistro.classList.add("aparecer");
    }, 650);
});
inicio.addEventListener("click",()=>{
    contenedorRegistro.classList.add("desaparecer");
    setTimeout(() => {
        contenedorRegistro.classList += " none";
        contenedorRegistro.classList.remove("desaparecer");
        contenedorInicio.classList.remove("none");
        contenedorInicio.classList.add("aparecer");
    }, 650);
});