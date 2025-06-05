'use strict'

//Constantes
//Sistema de plantillas
const tab = document.querySelectorAll('.tab');
const bloque = document.querySelectorAll('.bloque');

//Modal
const modal = document.querySelector('#modal');

//Zona para documento
const zonaCarga = document.querySelector('.zona_carga');
//Zona para enlace
const zonaEnlace = document.querySelector('.zona_enlace');

//Cuando hacemos click en un li: 
// *Todos los li quitar clase activo
// *Todos los bloques quitar clase activo
// *.li con la posición le añadimos la clase activo
// *.bloque con la posición le añadimos la clase activo

//Recorriendo todos los elementos
tab.forEach( (cadaLi, i)=>{
    //Asisgnando un click a cada li
    tab[i].addEventListener('click',()=>{
        
        //Recorrer todos los li
        tab.forEach( (cadaLi, i)=>{
            //Quitando cada clase activo a cada li y bloque
            tab[i].classList.remove('activo-p')
            bloque[i].classList.remove('activo-p')
        })

        //En el li que hacemos click le añadimos la clase activo al igual que al bloque
        tab[i].classList.add('activo-p')
        bloque[i].classList.add('activo-p')
    })
});

function abrirModal(){
    modal.showModal();
}

function cerrarModal(){
    modal.close();
}

function mostrarZona(n){
    if(n == "archivo"){
        zonaCarga.classList.add('activar_zona');
        zonaEnlace.classList.remove('activar_zona');
    }else if(n == "enlace"){
        zonaEnlace.classList.add('activar_zona');
        zonaCarga.classList.remove('activar_zona');
    }
}

document.getElementById("archivoPDF").addEventListener("change", function () {
    const archivo = this.files[0];
    const error = document.getElementById("error");
    error.textContent = "";

    if (archivo) {
        if (archivo.size > 1048576) { // 1 MB = 1024 * 1024 bytes
            error.textContent = "El archivo no debe pesar más de 1 MB.";
            this.value = ""; // limpia el input
        } else if (archivo.type !== "application/pdf") {
            error.textContent = "Solo se permiten archivos PDF.";
            this.value = "";
        }
    }
});


//Zona de consulta de todos los agentes y la aplicación del filtro y paginado.
//Constantes para el DOM
const tablaS = document.getElementById("tb_supervisor");
const filtroS = document.getElementById("campoS").value;

//url de documentos PHP
let url_supervicion = '../includes/tb_supervicionPA.php';

//Variables
let paginaActual = 1;

//Consulta inicial

obtenerSupervisores(paginaActual);
document.getElementById('campoS').addEventListener('change', () =>{
    obtenerSupervisores(paginaActual);
});

//Se obtiene la consulta de la página php y se imprime en el cuerpo de la tabla por medio
//del metodo POST
function obtenerSupervisores(pagina = 1){
    //Constantes de elementos utilizados en el filtro


    if (pagina != null) {
        paginaActual = pagina;
    }

    let limite_registros = "25";

    const formData = new FormData()
    formData.append("campo", filtroS)
    formData.append("registros", limite_registros)
    formData.append("pagina", paginaActual)

    fetch(url_supervicion, {
        method: "POST",
        body: formData,
    }).then(Response => Response.json())
    .then(data => {
        tablaS.innerHTML = data.data;
        document.getElementById('lbl-total').innerHTML = `${data.total_filtro} de ${data.total_registros} registros`;
        document.getElementById('paginacion').innerHTML = data.paginacion;
    }).catch(err => console.log(err))
}
