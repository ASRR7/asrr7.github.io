window.addEventListener("DOMContentLoaded",()=>{
    const username = document.getElementById("username");
    const correo = document.getElementById("correo");
    const msjCorreo = document.getElementById("msjCorreo");

    const msjUsername = document.getElementById("msjUsername");
    const btnUsername = document.getElementById("btnUsername");
    // ---------------------------------------------------------- //
    const userDisponible = async (a) =>{
        let userDis = new FormData();
        // Datos para hacer solicitud a servidor
        if(a =="correo"){
            userC = correo.value;
        }else if(a =="username"){
            userC = username.value;
        }
        userDis.append(''+a,userC);
        const respuesta = await fetch("SRC/js_async/username.php",{
            method: 'post',
            body: userDis
        });
        // Regresando datos de respuesta
        res = respuesta.text();
        return res;
    }
    // Función para recibir datos y mostrarlos
    const user = (a) =>{
        userDisponible(a).then(resultado => {
            // Promesa de resultado y modificar valores en documento
            let userE = resultado;
            if(a =="correo"){
                // Para el correo
                if(userE == "none"){
                    msjCorreo.classList.add("none");
                    btnUsername.disabled = false;
                    btnUsername.classList.remove("no-cursor");
                }else{
                    msjCorreo.classList.remove("none");
                    btnUsername.disabled = true;
                    btnUsername.classList.add("no-cursor");
                }
                // USERNAME
            }else if(a =="username"){ 
                if(userE == "none"){
                    msjUsername.classList.add("none");
                    btnUsername.disabled = false;
                    btnUsername.classList.remove("no-cursor");
                }else{
                    msjUsername.classList.remove("none");
                    btnUsername.disabled = true;
                    btnUsername.classList.add("no-cursor");
                }
            }
        });
    };
    // Llamando a la función
    username.addEventListener("keyup",()=>{
        user("username");
    });
    correo.addEventListener("keyup",()=>{
        if(correo.value.indexOf("@") > -1){
            user("correo");
        }
    });
});