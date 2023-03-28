window.addEventListener("DOMContentLoaded",()=>{
    const id = document.getElementById("id");
    const stockV = document.getElementById("stock");
    const idV = id.value;
    const btnProducto = document.getElementById("btnProducto");
    // ----------------------------------------------------------------------
    const stock = async () =>{
        let verStock = new FormData();
        // Datos para hacer solicitud a servidor
        verStock.append('id',idV);
        const respuesta = await fetch("../stock.php",{
            method: 'post',
            body: verStock
        });
        // Regresando datos de respuesta
        return respuesta.json();
    }
    // Función para recibir datos y mostrarlos
    const datos = () =>{
        stock().then(resultado => {
            // Promesa de resultado y modificar valores en documento
            var newStock = resultado;
            id.value = newStock;
            stockV.innerHTML = newStock;
            if(newStock<1){
                btnProducto.diabled = true;
            }else {
                btnProducto.disabled = false;
            }
        });
    };
    datos();
});