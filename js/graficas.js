const mesCompras = document.getElementById("mesCompras");

function crearGrafica(datos, colores, id) {
    // Obtener el canvas
    var canvas = document.getElementById(id);
    // Obtener el contexto 2D
    var ctx = canvas.getContext("2d");
    // Calcular el total de los datos
    var total = 0;
    for (var i = 0; i < datos.length; i++) {
        total += datos[i];
    }
    // Dibujar la gráfica de pastel
    var anguloInicio = 0;
    for (var i = 0; i < datos.length; i++) {
        var angulo = Math.PI * 2 * (datos[i] / total);
        ctx.beginPath();
        ctx.moveTo(canvas.width / 2, canvas.height / 2);
        ctx.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, anguloInicio, anguloInicio + angulo);
        ctx.fillStyle = colores[i];
        ctx.fill();
        anguloInicio += angulo;
    }
}
function graficaBarras(dias, compras, colores,id) {
    const canvas = document.getElementById(id);
    const ctx = canvas.getContext('2d');
    const canvasWidth = canvas.width;
    const canvasHeight = canvas.height;
    const maxCompras = Math.max(...compras);  
    ctx.clearRect(0, 0, canvasWidth, canvasHeight);

    for (let i = 0; i < dias.length; i++) {
        const x = i * (canvasWidth / dias.length) + 10;
        const height = (compras[i] / maxCompras) * (canvasHeight);
        const y = canvasHeight - height;
        const width = canvasWidth / dias.length - 20;
    
        // dibujar la barra
        ctx.fillStyle = colores[i];
        ctx.fillRect(x, y, width, height);
    
        // dibujar el texto vertical
        ctx.save();
        ctx.translate(x + width / 2, canvasHeight-10);
        ctx.rotate(-Math.PI / 2);
        ctx.fillStyle = '#000';
        ctx.font = '22px Arial';
        ctx.textAlign = 'left';
        ctx.fillText(dias[i] + " || " +compras[i], 0, 0);
        ctx.restore();
    }
}
const datosGraficas = async (tipo) => {
    let datos = new FormData();
    datos.append("tipo", tipo);
    if(tipo == "compras"){
        mes = parseInt(mesCompras.value)+ 1;
        datos.append("mes",mes);
        console.log(mes);
    }
    const respuesta = await fetch("../../SRC/js_async/graficas.php",{
        method: 'post',
        body: datos
    }).then(async respuesta =>{
        data = await respuesta.json();
        colores = [];
        if(tipo == "proveedores"){
            provedores = [];
            datos = [];
            numero = [];
            lista = new DocumentFragment();
            for(let i=0; i<data.length; i++){
                provedores.push(data[i]['provedor']);
                datos.push(data[i]['dato']);
                colores.push(data[i]['color']);
                numero.push(data[i]['numero']);
                li = document.createElement("li");
                    li.style.color = data[i]['color'];
                    li.innerText = data[i]['provedor'] + " | " +data[i]['numero'] + " | " + data[i]['dato']+"%";
                    li.style.fontWeight = "900";
                lista.appendChild(li);
            }
            var listaProveedores = document.getElementById("listaProveedores");
            listaProveedores.innerHTML = "";
            listaProveedores.appendChild(lista);
            crearGrafica(datos,colores,"productosProveedor");
        }else if(tipo == "compras"){
            dia = [];
            console.log(data);
            compras = [];
            for(let i=0; i<data.length; i++){
                dia.push(data[i]['dia']);
                compras.push(data[i]['compras']);
                colores.push(data[i]['color']);
            }
            graficaBarras(dia, compras, colores, "comprasDia");
        }else if(tipo == "vendidos"){
            productos = [];
            cantidad = [];
            for(let i=0; i<data.length; i++){
                productos.push(data[i]['producto']);
                cantidad.push(data[i]['cantidad']);
                colores.push(data[i]['color']);
            }
            graficaBarras(productos,cantidad,colores,"masVendidos");
        }
    });
    
}
datosGraficas("proveedores");
datosGraficas("vendidos");

mesCompras.addEventListener("change",()=>{
    datosGraficas("compras");
});
setInterval(() => {
    datosGraficas("proveedores");
    datosGraficas("vendidos");
}, 90000);