const botonCompra = document.getElementById("botonCompra");
let pantallaPago = document.getElementById("pantallaPago");

botonCompra.addEventListener("click",()=>{
    pantallaPago.classList.remove("none");
    pantallaPago.classList.add("aparecer");
    document.body.classList.add("no-scroll");
});
document.addEventListener('onhaschange', ()=>{
    pantallaPago.classList.add("none");
    pantallaPago.classList.remove("aparecer");
    document.body.classList.remove("no-scroll");
});