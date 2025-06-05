// DOM Elements
const fecha_minima = document.getElementById("fecha_minima");
const fecha_maxima = document.getElementById("fecha_maxima");
const aplicar_fecha = document.getElementById("aplicar_fecha");
const section_tarjetas = document.getElementById("tarjetas_gerentes");
const campoCoordinador = document.getElementById("campo");
const tabla = document.getElementById("tbe_tabla");
const lblTotal = document.getElementById("lbl-total");
const paginacion = document.getElementById("paginacion");

// URLs para fetch
const url_vista = "../includes/tarjetas_equipos.php";
const url_tabla = "../includes/tb_equipos.php";

// Variables globales
let paginaActual = 1;

// Calcular fechas por defecto
const hoy = new Date();
const ayer = new Date(hoy);
ayer.setDate(hoy.getDate() - 1);
const mesAnterior = new Date(hoy);
mesAnterior.setMonth(hoy.getMonth() - 1);

const formatoFecha = (fecha) => {
    return fecha.toISOString().split("T")[0];
};

// Asignar fechas por defecto a inputs
fecha_minima.value = formatoFecha(mesAnterior);
fecha_maxima.value = formatoFecha(ayer);

// Consultas iniciales
consultarGerentes();
obtenerSupervisores(paginaActual);

// Eventos
aplicar_fecha.addEventListener("click", () => {
    consultarGerentes();
});

campoCoordinador.addEventListener("change", () => {
    obtenerSupervisores();
});

// Función para consultar tarjetas de gerentes
function consultarGerentes() {
    const formData = new FormData();
    formData.append("fecha_minima", fecha_minima.value);
    formData.append("fecha_maxima", fecha_maxima.value);

    fetch(url_vista, {
        method: "POST",
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        section_tarjetas.innerHTML = data.data;
    })
    .catch((err) => console.error("Error cargando gerentes:", err));
}

// Función para obtener supervisores con filtro y paginación
function obtenerSupervisores(pagina = 1) {
    if (pagina != null) {
        paginaActual = pagina;
    }

    const formData = new FormData();
    formData.append("campo", campoCoordinador.value);
    formData.append("registros", "25");
    formData.append("pagina", paginaActual);

    fetch(url_tabla, {
        method: "POST",
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        tabla.innerHTML = data.data;
        lblTotal.innerHTML = `${data.total_filtro} de ${data.total_registros} registros`;
        paginacion.innerHTML = data.paginacion;
    })
    .catch((err) => console.error("Error cargando supervisores:", err));
}
