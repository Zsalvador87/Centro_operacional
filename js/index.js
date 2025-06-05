//Constantes para el DOM
const fecha_minima = document.getElementById("fecha_minima");
const fecha_maxima = document.getElementById("fecha_maxima");
const aplicar_fecha = document.getElementById("aplicar_fecha");
const section_tarjetas = document.getElementById("tarjetas_index");

//url de documentos PHP
let url_vista = '../includes/vista_general.php';

//Variables para uso de funciones
const hoy = new Date();
const ayer = hoy.getDate()-1;
const mesActual = hoy.getMonth()+1;
const mesAnterior = hoy.getMonth();
const año = new Date().getFullYear();

//valores default
const dia_ayer = `${año}-${mesActual.toString().padStart(2, '0')}-${ayer.toString().padStart(2, '0')}`;
const dia_mesAnterior = `${año}-${mesAnterior.toString().padStart(2, '0')}-${ayer.toString().padStart(2, '0')}`;

//Define fecha de la consulta
fecha_minima.value = dia_mesAnterior;
fecha_maxima.value = dia_ayer;

//Consulta inicial
consultarDatosGenerales(dia_ayer, dia_mesAnterior);

aplicar_fecha.addEventListener('click',() =>{
    consultarDatosGenerales(dia_ayer, dia_mesAnterior);
});

function consultarDatosGenerales(){
    const formData = new FormData();
    formData.append("fecha_minima", fecha_minima.value);
    formData.append("fecha_maxima", fecha_maxima.value);

    fetch(url_vista, {
        method: "POST",
        body: formData,
    }).then(Response => Response.json())
    .then(data => {
        section_tarjetas.innerHTML = data.data;
    }).catch(err => console.log(err))
}