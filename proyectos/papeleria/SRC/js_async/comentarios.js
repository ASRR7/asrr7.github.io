window.addEventListener("DOMContentLoaded",()=>{
    const btnComentar = document.getElementById("btnComentar");
    var producto_id = document.getElementById("id").value;

    // Respuesta a comentario
    // --------------------------------------------------

    const eventosRespuesta = (nameClass) => {
        let comRes = document.getElementsByClassName(nameClass);
        for (let res of comRes){
            res.addEventListener("click", (e) => {
                var padre = e.target.value;
                // console.log(padre);
                contenedorPadre = document.getElementById(padre);
                let recuadroResp = document.getElementById("contresc"+padre);
                if(recuadroResp){
                    recuadroResp.remove();
                }else {
                    let contresp = document.createElement("div");
                        contresp.setAttribute("id","contresc"+padre);
                        contresp.style.marginLeft = 30;
                    let respCuadro = document.createElement("div");
                        respCuadro.classList.add("com-coment");
                        respCuadro.classList.add("aparecer");
                        respCuadro.setAttribute("contenteditable","true");
                        respCuadro.setAttribute("id","resc"+padre);
                    let btnRespEnviar = document.createElement("button");
                        btnRespEnviar.className = "btn btn-enviar btn-comentar btn-responder";
                        btnRespEnviar.setAttribute("value","resc"+padre);
                        btnRespEnviar.innerText = "Responder";
                        // Añadiendo recuadro de respuesta y boton
                    contresp.appendChild(respCuadro);
                    contresp.appendChild(btnRespEnviar);
                    let btnRespArriba = document.getElementById("resB"+padre);
                    btnRespArriba.parentNode.insertBefore(contresp,btnRespArriba.nextSibling);
                    // /// contenedorPadre.insertAdjacentElement("afterbegin",contresp);
                    btnResponder = document.getElementsByClassName("btn-responder");
                    // Darle addEvent a los botones de respuesta
                    for (let j=0; j<btnResponder.length; j++){
                        btnResponder[j].addEventListener("click",(e)=>{
                            var btnResValue = e.target.value;
                            let ress = document.getElementById(btnResValue);
                            if(ress.textContent.length>0){
                                var username = localStorage.getItem("username");
                                var tipo = 1;
                                crearComentario(tipo,username,ress,padre);
                            }
                        });
                    }
                }
            });
        }
    }
    eventosRespuesta("com-res");

    const actualComentario = async (producto_id)=>{
        var contenedor = document.getElementById("comentarios");
        // Enviar producto id
        let actualComentBBDD = new FormData();
            // Datos para hacer solicitud a servidor
            // ID del padre
            actualComentBBDD.append('actualizar',1);
            actualComentBBDD.append('producto_id',producto_id);
            const respuesta = await fetch("../SRC/js_async/actual-coment.php",{
                method: 'post',
                body: actualComentBBDD
            }).then(async respuesta => { // Recibir JSON
                if(respuesta.ok){
                    res = await respuesta.json();
                    // console.log(res);
                    comentariosA = new DocumentFragment();
                    for(let i=0; i<res.length; i++){
                        contenedorA = document.createElement("div");
                        contenedorA.classList.add("com-contenedor");
                        infoA = document.createElement("div");
                            infoA.classList.add("com-info");
                        usernameA = document.createElement("h3");
                            usernameA.className = "subtitulo sub-com";
                        comentA = document.createElement("div");
                            comentA.classList.add("com-coment");
                        fechaA = document.createElement("h4");
                            fechaA.className = "subtitulo sub-com sub-com-fecha";
                        horaA = document.createElement("h4");
                            horaA.className = "subtitulo sub-com sub-com-fecha";
                        btnA = document.createElement("button");
                            btnA.classList.add("com-res");
                            btnA.innerText = "Responder";
                        // Iterar para cargar los comentarios
                        // Información del comenrtario
                        usernameA.innerText = res[i]['username'];
                        fechaA.innerText = res[i]['fecha'];
                        horaA.innerText = res[i]['hora'];
                            infoA.appendChild(usernameA);
                            infoA.appendChild(fechaA);
                            infoA.appendChild(horaA);
                            // Comentario y id
                        comentA.innerText = res[i]['comentario'];
                        contenedorA.setAttribute("id",res[i]['id_comentario']);
                            contenedorA.appendChild(infoA);
                            contenedorA.appendChild(comentA);
                        // Botón de respuesta
                        btnA.setAttribute("value",res[i]['id_comentario']);
                        btnA.setAttribute("id","resB"+res[i]['id_comentario']);
                        contenedorA.appendChild(btnA);
                        if(res[i]['hijos']){
                            comentariosHijos = res[i]['hijos'].length;
                            for(var j=0; j<comentariosHijos; j++){
                                // Elementos para comentarios hijos
                                contenedorR = document.createElement("div");
                                contenedorR.classList.add("com-contenedor");
                                infoR = document.createElement("div");
                                    infoR.classList.add("com-info");
                                usernameR = document.createElement("h3");
                                    usernameR.className = "subtitulo sub-com";
                                comentR = document.createElement("div");
                                    comentR.classList.add("com-coment");
                                fechaR = document.createElement("h4");
                                    fechaR.className = "subtitulo sub-com sub-com-fecha";
                                horaR = document.createElement("h4");
                                    horaR.className = "subtitulo sub-com sub-com-fecha";
                                    // 
                                    // 
                                    // 
                                usernameR.innerText = res[i]['hijos'][j]['username'];
                                fechaR.innerText = res[i]['hijos'][j]['fecha'];
                                horaR.innerText = res[i]['hijos'][j]['hora'];
                                    infoR.appendChild(usernameR);
                                    infoR.appendChild(fechaR);
                                    infoR.appendChild(horaR);
                                comentR.innerText = res[i]['hijos'][j]['comentario'];
                                    contenedorR.style.marginLeft = "30px";
                                    contenedorR.style.marginTop = "0px";
                                    contenedor.style.padding = "2% 2%";
                                    contenedorR.appendChild(infoR);
                                    contenedorR.appendChild(comentR);
                                contenedorA.appendChild(contenedorR);
                                // contenedorR.innerHTML = "";
                                // infoR.innerHTML = "";
                                // comentR.innerHTML = "";
                                // usernameR.innerHTML = "";
                                // fechaR.innerHTML = "";
                                // horaR.innerHTML = "";
                            } 
                        }
                        // console.log(contenedorA);
                        comentariosA.appendChild(contenedorA);
                        // contenedorA.innerHTML = "";
                        // infoA.innerHTML = "";
                        // comentA.innerHTML = "";
                        // usernameA.innerHTML = "";
                        // fechaA.innerHTML = "";
                        // horaA.innerHTML = "";
                    }
                    
                // Insertarlos en el contenedor de comentarios
                    contenedor.innerHTML ="";
                    contenedor.append(comentariosA);
                    comentariosA.innerHTML = "";
                    eventosRespuesta("com-res");
                }
            });
    };

    const crearComentario  = async(tipo,user,comm,padre) => {
        if(tipo == 1){
            var contenedor  = document.getElementById(padre);
        }else if(tipo == 0){
            var contenedor = document.getElementById("comentarios");
            var resp = document.createElement("button");
            resp.classList.add("com-res");
            resp.innerHTML = "Responder";
        }
        if(user != null){
            let conten = document.createElement("div");
                conten.classList.add("com-contenedor");
            let infor = document.createElement("div");
                infor.classList.add("com-info");
                let h3 = document.createElement("h3");
                    h3.classList.add("subtitulo");
                    h3.classList.add("sub-com");
                    h3.innerHTML = user;
                    infor.appendChild(h3);
                let h41 = document.createElement("h4");
                    let date = new Date();
                    let fecha = String(date.getDate()).padStart(2, '0') + '/' + String(date.getMonth() + 1).padStart(2, '0') + '/' + date.getFullYear();
                    h41.classList.add("subtitulo")
                    h41.classList.add("sub-com")
                    h41.classList.add("sub-com-fecha");
                        h41.innerHTML = fecha;
                    infor.appendChild(h41);
                let h42 = document.createElement("h4");
                    h42.classList.add("subtitulo")
                    h42.classList.add("sub-com")
                    h42.classList.add("sub-com-fecha");
                    let hora = String(date.getHours()) + ':' + String(date.getMinutes()).padStart(2, '0')+ ':' + String(date.getSeconds()).padStart(2, '0');
                        h42.innerHTML = hora;
                    infor.appendChild(h42);
            let mensa = document.createElement("div");
                mensa.classList.add("com-coment");
                mensa.innerText = comm.textContent;            
            // Subir comentario a base de datos
            // ----------------------------------
            let comenBBDD = new FormData();
            // Datos para hacer solicitud a servidor
            // ID del padre
            comenBBDD.append('comentar',1);
            comenBBDD.append('producto_id',producto_id);
            comenBBDD.append('id_padre',padre);
            // Comentario
            comenBBDD.append('comentario',comm.textContent);
            // Username
            comenBBDD.append('username',user);
            // Fecha
            comenBBDD.append('fecha',fecha);
            // Hora
            comenBBDD.append('hora',hora);
            contenedor.insertAdjacentElement("afterbegin", conten);
            const respuesta = await fetch("../SRC/js_async/comentarios.php",{
                method: 'post',
                body: comenBBDD
            }).then(async respuesta=>{
            // Regresando datos de respuesta
                res = await respuesta.text();
                conten.setAttribute("id",res);
                if(tipo == 0){
                    resp.setAttribute("value",res);
                }
            });
            // Asignando id a nuevo comentario
            if(res != false){
                conten.appendChild(infor);
                conten.appendChild(mensa);
                if(padre==0){
                    conten.appendChild(resp);
                }
                comm.innerHTML = "";
                actualComentario(producto_id);
            }else{
                msjerr = document.getElementById("msjErrorComm");
                if(msjerr == null){
                    let msjp = document.createElement("p");
                    msjp.classList.add("msj");
                    msjp.classList.add("msj-error");
                    msjp.value = "1";
                    msjp.setAttribute("id","msjErrorComm");
                    msjp.innerHTML = "Ocurrió un error. Intenta más tarde.";
                    contenedor.insertAdjacentElement("afterbegin",msjp);
                    setTimeout(() => {
                        document.getElementById("msjErrorComm").remove();
                    }, 2000);
                }
            }
        }else{
            msjerr = document.getElementById("msjErrorComm");
            if(msjerr == null){
                let msjp = document.createElement("p");
                msjp.classList.add("msj");
                msjp.classList.add("msj-error");
                msjp.value = "1";
                msjp.setAttribute("id","msjErrorComm");
                msjp.innerHTML = "Inicia sesi&oacute;n para comentar.";
                contenedor.insertAdjacentElement("afterbegin",msjp);
                setTimeout(() => {
                    document.getElementById("msjErrorComm").remove();
                }, 2000);
            }
        }
    };


    // Intervalo para actualizar comentarios
    actualComentario(producto_id);
    // Comentario nuevo
    // ----------------------------------------------------
    btnComentar.addEventListener("click",() => {
        // 0: Nuevo
        // 1: Respuesta
        var tipo = 0;
        var comm = document.getElementById("comentario");
        var username = localStorage.getItem("username");
        if(comm.textContent.length>0){
            crearComentario(tipo,username,comm,-1);
        }
    });
    
});



