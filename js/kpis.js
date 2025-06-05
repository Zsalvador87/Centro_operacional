'use strict'
//Importaciones para el uso de porcentajes.


//Constantes para el DOM

//Fechas para pestaña supervisión
const fecha_minimaS = document.getElementById("fecha_minimaS");
const fecha_maximaS = document.getElementById("fecha_maximaS");
const aplicar_fechaS = document.getElementById("aplicar_fechaS");
//Fechas para pestaña coordinación
const fecha_minimaC = document.getElementById("fecha_minimaC");
const fecha_maximaC = document.getElementById("fecha_maximaC");
const aplicar_fechaC = document.getElementById("aplicar_fechaC");
//Fechas para pestaña gerencia
const fecha_minimaG = document.getElementById("fecha_minimaG");
const fecha_maximaG = document.getElementById("fecha_maximaG");
const aplicar_fechaG = document.getElementById("aplicar_fechaG");
//Bloques donde se colocan las tarjetas
const section_tarjetasS = document.getElementById("tarjetas_supervisor");
const section_tarjetasC = document.getElementById("tarjetas_coordinador");
const section_tarjetasG = document.getElementById("tarjetas_gerente");

const tab = document.querySelectorAll('.tab');
const bloque = document.querySelectorAll('.bloque');

//Lista de Selects con nombres
const campoS = document.getElementById("campoS");
const campoC = document.getElementById("campoC");
const campoG = document.getElementById("campoG");

//Constantes para gráficas de Chart JS
const ctx_supervision = document.getElementById('grafica-pastel__supervision').getContext('2d');
const ctx_coordinacion = document.getElementById('grafica-pastel__coordinacion').getContext('2d');
const ctx_gerencia = document.getElementById('grafica-pastel__gerencia').getContext('2d');

//url de documentos PHP
const url_supervisor = '../includes/supervisor_kpis.php';
const url_coordinador = '../includes/coordinador_kpis.php';
const url_gerente = '../includes/gerente_kpis.php';

//Variables para uso de funciones
const hoy = new Date();
const ayer = hoy.getDate()-1;
const mesActual = hoy.getMonth()+1;
const mesAnterior = hoy.getMonth();
const año = new Date().getFullYear();

//valores default
const dia_ayer = `${año}-${mesActual.toString().padStart(2, '0')}-${ayer.toString().padStart(2, '0')}`;
const dia_mesAnterior = `${año}-${mesAnterior.toString().padStart(2, '0')}-${ayer.toString().padStart(2, '0')}`;

//Declaramos una variable vacía para generar las gráficas de manera dinámica y la anterior pueda ser eliminada.
let graficaPastel_supervision = null;
let graficaPastel_coordinacion = null;
let graficaPastel_gerencia = null;

//Define fecha de la consulta
//Pestaña supervisor
fecha_minimaS.value = dia_mesAnterior;
fecha_maximaS.value = dia_ayer;
//Pestaña coordinador
fecha_minimaC.value = dia_mesAnterior;
fecha_maximaC.value = dia_ayer;
//Pestaña gerente
fecha_minimaG.value = dia_mesAnterior;
fecha_maximaG.value = dia_ayer;

//Consulta inicial
consultarDatosGeneralesS(campoS.value);
consultarDatosGeneralesC(campoC.value);
consultarDatosGeneralesG(campoG.value);

aplicar_fechaS.addEventListener('click',() =>{
    consultarDatosGeneralesS(campoS.value);
});

aplicar_fechaC.addEventListener('click',() =>{
    consultarDatosGeneralesC(campoC.value);
});

aplicar_fechaG.addEventListener('click',() =>{
    consultarDatosGeneralesG(campoG.value);
});


function consultarDatosGeneralesS(cS){
    const formData = new FormData();
    formData.append("fecha_minima", fecha_minimaS.value);
    formData.append("fecha_maxima", fecha_maximaS.value);
    formData.append("campo", cS);

    fetch(url_supervisor, {
        method: "POST",
        body: formData,
    }).then(Response => Response.json())
    .then(data => {
        section_tarjetasS.innerHTML = data.data;
        const valores_graficaS = document.querySelectorAll('.valores_graficaS');
        let valores_rebanadas = [];
        // Convertir a array (opcional, pero útil)
        valores_graficaS.forEach(p => {
            valores_rebanadas.push(parseFloat(p.textContent));
        });
        generarGraficaSupervisor(valores_rebanadas);
    }).catch(err => console.log(err))
}

function consultarDatosGeneralesC(cC){
    const formData = new FormData();
    formData.append("fecha_minima", fecha_minimaC.value);
    formData.append("fecha_maxima", fecha_maximaC.value);
    formData.append("campo", cC);

    fetch(url_coordinador, {
        method: "POST",
        body: formData,
    }).then(Response => Response.json())
    .then(data => {
        section_tarjetasC.innerHTML = data.data;
        const valores_graficaC = document.querySelectorAll('.valores_graficaC');
        let valores_rebanadas = [];
        // Convertir a array (opcional, pero útil)
        valores_graficaC.forEach(p => {
            valores_rebanadas.push(parseFloat(p.textContent));
        });
        generarGraficaCoordinador(valores_rebanadas);
    }).catch(err => console.log(err))
}

function consultarDatosGeneralesG(cG){
    const formData = new FormData();
    formData.append("fecha_minima", fecha_minimaG.value);
    formData.append("fecha_maxima", fecha_maximaG.value);
    formData.append("campo", cG);

    fetch(url_gerente, {
        method: "POST",
        body: formData,
    }).then(Response => Response.json())
    .then(data => {
        section_tarjetasG.innerHTML = data.data;
        const valores_graficaG = document.querySelectorAll('.valores_graficaG');
        let valores_rebanadas = [];
        // Convertir a array (opcional, pero útil)
        valores_graficaG.forEach(p => {
            valores_rebanadas.push(parseFloat(p.textContent));
        });
        generarGraficaGerente(valores_rebanadas);
    }).catch(err => console.log(err))
}


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
            tab[i].classList.remove('activo-i')
            bloque[i].classList.remove('activo-i')
        })

        //En el li que hacemos click le añadimos la clase activo al igual que al bloque
        tab[i].classList.add('activo-i')
        bloque[i].classList.add('activo-i')
    })
})

function generarGraficaSupervisor(array) {
    if (graficaPastel_supervision) {
        graficaPastel_supervision.destroy();
    }

    const total = array.reduce((acc, val) => acc + val, 0);

    graficaPastel_supervision = new Chart(ctx_supervision, {
        type: 'pie',
        data: {
            labels: ['Tpo. disponible', 'Tpo. No Disponible', 'Tpo. Baño', 'Tpo. Hablando', 'Tpo. Descanso'],
            datasets: [{
                label: 'Distribución de Tiempo',
                data: array,
                backgroundColor: [
                    'rgba(39, 245, 54, 0.8)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: ['rgba(0,0,0,1)'],
                borderWidth: 3
            }]
        },
        options: {
            animation: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const porcentaje = ((value / total) * 100).toFixed(1);
                            return `${label}: ${porcentaje}%`;
                        }
                    }
                },
                title: {
                    display: false
                }
            }
        }
    });
}

function generarGraficaCoordinador(array) {
    if (graficaPastel_coordinacion) {
        graficaPastel_coordinacion.destroy();
    }

    const total = array.reduce((acc, val) => acc + val, 0);

    graficaPastel_coordinacion = new Chart(ctx_coordinacion, {
        type: 'pie',
        data: {
            labels: ['Tpo. disponible', 'Tpo. No Disponible', 'Tpo. Baño', 'Tpo. Hablando', 'Tpo. Descanso'],
            datasets: [{
                label: 'Distribución de Tiempo',
                data: array,
                backgroundColor: [
                    'rgba(39, 245, 54, 0.8)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: ['rgba(0,0,0,1)'],
                borderWidth: 3
            }]
        },
        options: {
            animation: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const porcentaje = ((value / total) * 100).toFixed(1);
                            return `${label}: ${porcentaje}%`;
                        }
                    }
                },
                title: {
                    display: false
                }
            }
        }
    });
}

function generarGraficaGerente(array) {
    if (graficaPastel_gerencia) {
        graficaPastel_gerencia.destroy();
    }

    const total = array.reduce((acc, val) => acc + val, 0);

    graficaPastel_gerencia = new Chart(ctx_gerencia, {
        type: 'pie',
        data: {
            labels: ['Tpo. disponible', 'Tpo. No Disponible', 'Tpo. Baño', 'Tpo. Hablando', 'Tpo. Descanso'],
            datasets: [{
                label: 'Distribución de Tiempo',
                data: array,
                backgroundColor: [
                    'rgba(39, 245, 54, 0.8)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: ['rgba(0,0,0,1)'],
                borderWidth: 3
            }]
        },
        options: {
            animation: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const porcentaje = ((value / total) * 100).toFixed(1);
                            return `${label}: ${porcentaje}%`;
                        }
                    }
                },
                title: {
                    display: false
                }
            }
        }
    });
}


