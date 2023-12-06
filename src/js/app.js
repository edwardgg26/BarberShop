let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
const diasNoTrabajo = [0];
const horasTrabajo = {
    minima: 8,
    maxima: 20
}

const cita = {
    idUsuario: null,
    nombre: "",
    fecha: "",
    hora: "",
    servicios: [],
    barbero: null
}

document.addEventListener("DOMContentLoaded", function (){
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion();
    tabs();
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();
    consultarAPIBarberos();
    consultarAPIServicios();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora();
}

function mostrarSeccion(){
    const seccionAnterior = document.querySelector(".mostrar");
    if(seccionAnterior){
        seccionAnterior.classList.remove("mostrar");
        seccionAnterior.classList.add("ocultar");
    }

    pasoSeccion = `#seccion-cita-${paso}`
    const seccion = document.querySelector(pasoSeccion);
    seccion.classList.remove("ocultar");
    seccion.classList.add("mostrar");

    const tabAnterior = document.querySelector(".active");
    if(tabAnterior){
        tabAnterior.classList.remove("active");
    }
    const tabs = document.querySelectorAll(".page-item");
    tabs.item(paso-1).classList.add("active");
}

function tabs(){
    const botones = document.querySelectorAll(".page-link");
    
    botones.forEach(boton => {
        boton.addEventListener("click", (e) => {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

function botonesPaginador(){
    const botonAnterior = document.querySelector("#anterior");
    const botonSiguiente = document.querySelector("#siguiente");
    
    if(paso == 1){
        botonAnterior.disabled = true;
        botonSiguiente.disabled = false;
    }else if (paso == 3){
        botonAnterior.disabled = false;
        botonSiguiente.disabled = true;
        mostrarResumen();
    }else{
        botonAnterior.disabled = false;
        botonSiguiente.disabled = false;
    } 
    mostrarSeccion();
}

function paginaSiguiente(){
    const botonSiguiente = document.querySelector("#siguiente");
    botonSiguiente.addEventListener("click", () => {
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    })
    
}

function paginaAnterior(){
    const botonAnterior = document.querySelector("#anterior");
    botonAnterior.addEventListener("click", () => {
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    })
}

async function consultarAPIServicios(){
    try {
        const url = "/api/servicios";
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log("Error al obtener servicios:", error);
    }
}

async function consultarAPIBarberos(){
    try {
        const url = "/api/barberos";
        const resultado = await fetch(url);
        const barberos = await resultado.json();
        mostrarBarberos(barberos);
    } catch (error) {
        console.log("Error al obtener servicios:", error);
    }
}

function mostrarBarberos(barberos){
    barberos.forEach(barbero => {
        const {nombre,apellido} = barbero;

        const elementoLista = document.createElement("OPTION");
        elementoLista.textContent = nombre+" "+apellido;
        elementoLista.value = JSON.stringify(barbero);
        
        const selectLista = document.querySelector("#select-barbero");
        selectLista.addEventListener("change",(e) => {
            if(selectLista.value !== null || selectLista.value !== "null"){
                cita.barbero = JSON.parse(e.target.value);
                borrarAlertas();
            }else{
                cita.barbero = null;
            }
        })

        selectLista.appendChild(elementoLista);
    });
}

function mostrarServicios(servicios){
    servicios.forEach(servicio => {
        const {id,nombre,precio,duracion} = servicio;
        
        const nombreServicio = document.createElement("P");
        nombreServicio.textContent = nombre;
        nombreServicio.classList.add("fw-bold");
        nombreServicio.classList.add("text-break");

        const precioServicio = document.createElement("P");
        precioServicio.textContent = "$"+precio;
        precioServicio.classList.add("mb-0");

        const duracionServicio = document.createElement("P");
        duracionServicio.textContent = duracion+" minutos";
        duracionServicio.classList.add("mb-0");

        const botonServicio = document.createElement("BUTTON");
        botonServicio.classList.add("btn");
        botonServicio.classList.add("col-5");
        botonServicio.classList.add("col-md-3");
        botonServicio.classList.add("m-1");
        // botonServicio.dataset.idServicio = id;
        botonServicio.dataset.bsToggle = "button";
        botonServicio.appendChild(nombreServicio);
        botonServicio.appendChild(precioServicio);
        botonServicio.appendChild(duracionServicio);
        botonServicio.addEventListener("click", () => {
            if(!cita.servicios.includes(servicio)){
                cita.servicios.push(servicio);
                borrarAlertas();
            }else{
                const indiceAEliminar = cita.servicios.indexOf(servicio);
                cita.servicios.splice(indiceAEliminar, 1);
            }
        });
        document.querySelector("#contenedor-servicios").appendChild(botonServicio);
    })
}

function mostrarResumen(){
    //Obtener sección
    const seccionPaso3 = document.querySelector("#seccion-cita-3");
    seccionPaso3.innerHTML = "";

    if(paso === 3 && (Object.values(cita).includes("") || cita.servicios.length === 0 || Object.values(cita).includes(null))){
        mostrarAlerta("Faltan datos de la reserva.", "danger");
        return;
    }

    borrarAlertas();
    //Crear y agregar elementos de la sección
    const subTituloPaso3 = document.createElement("H2");
    subTituloPaso3.innerHTML = "Resumen";
    subTituloPaso3.classList.add("mb-4");
    seccionPaso3.appendChild(subTituloPaso3);

    //Instanciar elemento
    const {nombre, fecha, hora, servicios, barbero} = cita;

    //Crear los servicios
    const seccionResumen = document.createElement("DIV");
    const subTituloServicios = document.createElement("H4");
    subTituloServicios.innerHTML = "Servicios";
    subTituloServicios.classList.add("mb-4");
    seccionResumen.appendChild(subTituloServicios);

    const contadorCita = {
        precioTotal: 0,
        duracionTotal: 0
    };

    //Crear campo de servicio
    servicios.forEach(servicio => {
        contadorCita.duracionTotal += parseInt(servicio.duracion);
        contadorCita.precioTotal += parseFloat(servicio.precio);
        const elementoServicio = document.createElement("DIV");
        const elNombreServicio = document.createElement("P");
        elNombreServicio.innerHTML = `<span class="fw-bold">Nombre:</span> ${servicio.nombre}`;
        const elPrecioServicio = document.createElement("P");
        elPrecioServicio.innerHTML = `<span class="fw-bold">Precio:</span> $${servicio.precio}`;
        const elDuracionServicio = document.createElement("P");
        elDuracionServicio.innerHTML = `<span class="fw-bold">Duración:</span> ${servicio.duracion} minutos`;
        const lineaSeccion = document.createElement("HR");

        elementoServicio.appendChild(elNombreServicio);
        elementoServicio.appendChild(elPrecioServicio);
        elementoServicio.appendChild(elDuracionServicio);
        elementoServicio.appendChild(lineaSeccion);

        seccionResumen.appendChild(elementoServicio);
    });


    //Trabajar con el resumen de la cita
    const elementoNombre = document.createElement("P");
    elementoNombre.innerHTML = `<span class="fw-bold">Nombre Cliente:</span> ${nombre}`;

    //Formatear Fecha
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();
    const fechaUTC = new Date(Date.UTC(year,mes,dia));
    const fechaFormateada = fechaUTC.toLocaleDateString("es-CO", {year:"numeric",month:"long",day:"2-digit",weekday:"long"});
    const elementoFecha = document.createElement("P");
    elementoFecha.innerHTML = `<span class="fw-bold">Fecha:</span> ${fechaFormateada}`;

    const elementoHora = document.createElement("P");
    elementoHora.innerHTML = `<span class="fw-bold">Hora:</span> ${hora}`;

    const elementoBarbero = document.createElement("P");
    elementoBarbero.innerHTML = `<span class="fw-bold">Barbero:</span> ${barbero.nombre+" "+barbero.apellido}`;

    const totalPrecio = document.createElement("P");
    totalPrecio.innerHTML = `<span class="fw-bold">Total a pagar:</span> $${contadorCita.precioTotal}`;

    const totalDuracion = document.createElement("P");
    totalDuracion.innerHTML = `<span class="fw-bold">Duracion total:</span> ${contadorCita.duracionTotal} minutos`;

    const linea = document.createElement("HR");

    
    seccionResumen.appendChild(elementoNombre);
    seccionResumen.appendChild(elementoFecha);
    seccionResumen.appendChild(elementoHora);
    seccionResumen.appendChild(elementoBarbero);
    seccionResumen.appendChild(totalPrecio);
    seccionResumen.appendChild(totalDuracion);
    seccionResumen.appendChild(linea);
    seccionPaso3.appendChild(seccionResumen);

    //Boton enviar, se agrega a la seccion paso 3
    const botonEnviar = document.createElement("BUTTON");
    botonEnviar.classList.add("btn");
    botonEnviar.classList.add("btn-primary");
    botonEnviar.classList.add("mb-5");
    botonEnviar.textContent = "Reservar Cita";
    botonEnviar.onclick = reservarCita;

    seccionPaso3.appendChild(botonEnviar);
}

function nombreCliente(){
    cita.nombre = document.getElementById("nombre").value;
    cita.idUsuario = document.getElementById("id_usuario").value;
}

function seleccionarFecha(){
    const inputFecha = document.getElementById("fecha");

    inputFecha.addEventListener("input", (e) => {
        const dia = new Date(e.target.value).getUTCDay();
        if(diasNoTrabajo.includes(dia)){
            e.target.value = "";
            cita.fecha = "";
            mostrarAlerta("No se atiende los domingos.", "danger");
        }else{
            cita.fecha = e.target.value;
            borrarAlertas();
        }
    });
}

function seleccionarHora(){
    const inputHora = document.getElementById("hora");

    inputHora.addEventListener("input", (e) => {
        const hora = e.target.value.split(":");

        if(hora[0] < horasTrabajo.minima || hora[0] >= horasTrabajo.maxima ){
            mostrarAlerta("La barberia abre a las 8am y cierra a las 8pm.","danger");
            e.target.value = "";
            cita.hora = "";
        }else{
            cita.hora = e.target.value;
            borrarAlertas();
        }
    });
}

function mostrarAlerta(mensaje, tipo){

    //Crear contenedor de la alerta
    const alerta = document.createElement("DIV");
    alerta.role = "alert";
    alerta.classList.add(["alert"]);
    alerta.classList.add(`alert-${tipo}`);
    alerta.classList.add("alert-dismissible");
    alerta.classList.add("fade");
    alerta.classList.add("show");

    //Crear mensaje de alerta
    const mensajeAlerta = document.createElement("P");
    mensajeAlerta.textContent = mensaje;

    //Crear boton de cierre
    const botonCerrar = document.createElement("BUTTON");
    botonCerrar.classList.add("btn-close");
    botonCerrar.dataset.bsDismiss = "alert";
    botonCerrar.ariaLabel = "Close";

    alerta.appendChild(mensajeAlerta);
    alerta.appendChild(botonCerrar);

    document.querySelector("#contenedor-alertas").appendChild(alerta);
}

function borrarAlertas(){
    const alertas = document.querySelectorAll(".alert");
    alertas.forEach(alerta => alerta.remove());
}

async function reservarCita(){
    
    const { idUsuario, fecha , hora , barbero ,servicios } = cita;
    const idServicios = servicios.map(servicio => servicio.id);
    const datos = new FormData();
    datos.append("fecha",fecha);
    datos.append("hora",hora);
    datos.append("id_usuario", parseInt(idUsuario));
    datos.append("id_barbero", barbero.id);
    datos.append("servicios", idServicios);

    try {
        const url = "/api/citas";
        const respuesta = await fetch(url, {
            method:"POST",
            body: datos
        });
    
        const resultado = await respuesta.json();
        if(resultado.resultado){
            Swal.fire({
                title: "Cita Reservada!",
                text: "Tu cita ha sido reservada con exito!",
                icon: "success"
            }).then(()=>{
                window.location.reload();
            })
        };
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error...",
            text: "Hubo un error al crear la reserva...",
        });
    }
}