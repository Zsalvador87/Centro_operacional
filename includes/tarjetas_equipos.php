<?php 
//Este documento pertenece a la página "index". Este muestra una vista general de los higienicos diferido por fechas.

//Importamos la conexión a la base de datos
require  'database.php';

//variables
$output = [];
$output['data'] = "";
$ayer = date('Y-m-d', strtotime('-2 day'));
$mesAnterior = date('Y-m-d', strtotime('-31 day'));

//Variables para método POST
$fecha_minima = isset($_POST['fecha_minima']) ? mysqli_real_escape_string($db, $_POST['fecha_minima']) : $ayer;
$fecha_maxima = isset($_POST['fecha_maxima']) ? mysqli_real_escape_string($db, $_POST['fecha_maxima']) : $mesAnterior;



//Consulta
$sql = "SELECT DISTINCT plantilla.gerente, COUNT(DISTINCT plantilla.usuario) AS miembros, CAST(AVG((activo + pause) / logintime) AS DECIMAL (18,2)) AS adh_neta FROM higienicos INNER JOIN plantilla ON plantilla.usuario = higienicos.actor WHERE date BETWEEN '". $fecha_minima ."' AND '". $fecha_maxima ."' GROUP BY plantilla.gerente;";

//Datos consultados
$consulta = mysqli_query($db,$sql);

while($gerente = mysqli_fetch_assoc($consulta)) {
    $output['data'] .= '<div class="tarjeta">';
    $output['data'] .= '<h4 class="tj__titulo">'.$gerente['gerente'].'</h4>';
    $output['data'] .= '<div class="tj-tipo2__indicadores">';
    $output['data'] .= '<p>Miembros     <span>'.$gerente['miembros'].'</span></p>';
    $output['data'] .= '<p>ADH neta    <span>'. ($gerente['adh_neta'] * 100) .'%</span></p>';
    $output['data'] .= '<p>Alertas      <span>X</span></p>';
    $output['data'] .= '</div>';
    $output['data'] .= '<button class="boton">Detalles</button>';
    $output['data'] .= '</div>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>