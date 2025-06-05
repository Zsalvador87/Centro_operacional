<?php 
//Este documento pertenece a la página "index". Este muestra una vista general de los higienicos diferido por fechas.

//Importamos la conexión a la base de datos
require  'database.php';
require 'metas.php';

//variables
$output = [];
$output['data'] = "";
$ayer = date('Y-m-d', strtotime('-2 day'));
$mesAnterior = date('Y-m-d', strtotime('-31 day'));

//Variables para método POST
$fecha_minima = isset($_POST['fecha_minima']) ? mysqli_real_escape_string($db, $_POST['fecha_minima']) : $ayer;
$fecha_maxima = isset($_POST['fecha_maxima']) ? mysqli_real_escape_string($db, $_POST['fecha_maxima']) : $mesAnterior;
$campo = isset($_POST['campo']) ? mysqli_real_escape_string($db, $_POST['campo']) : null;

$where = '';

//Filtro
if($campo != null){
    $where .= "AND plantilla.gerente LIKE '%" . $campo . "%'";
}

//Consulta
$sql = "SELECT CAST(SUM(logintime) AS DECIMAL (18,2)) AS tpo_logeado, CAST(SUM(activo) AS DECIMAL (18,2)) AS tpo_disponible, CAST(SUM(pause) AS DECIMAL (18,2)) AS tpo_no_disponible, CAST(SUM(toilette) AS DECIMAL (18,2)) AS tpo_baño, CAST(SUM(tiempo_llamada) AS DECIMAL (18,2)) AS tpo_hablando, CAST(SUM(break) AS DECIMAL (18,2)) AS tpo_descanso, CAST(AVG((activo + pause) / logintime) AS DECIMAL (18,2)) AS adh_neta FROM higienicos INNER JOIN plantilla ON plantilla.usuario = higienicos.actor WHERE date BETWEEN '". $fecha_minima ."' AND '". $fecha_maxima ."' ". $where .";";

//echo $sql;
//Datos consultados
$consulta = mysqli_query($db,$sql);
//Datos procesados
$datos = $consulta->fetch_assoc();

//ADH Neta
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">ADH Neta</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span>'. ($datos['adh_neta'] * 100) .'%</span></p>';
$output['data'] .= '<p>Objetivo     <span>'. ($o_adhNeta * 100) .'%</span></p>';
$output['data'] .= '<p>Desviación   <span>'. (($o_adhNeta - $datos['adh_neta']) * 100) .'%</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';

//Horas Logeadas
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">Horas Logeadas</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span>'. $datos['tpo_logeado'] .'</span></p>';
$output['data'] .= '<p>Objetivo     <span>'. $o_tpoLogeado .'</span></p>';
$output['data'] .= '<p>Desviación   <span>'. ($o_tpoLogeado - $datos['tpo_logeado']) .'</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';

//Tiempo Disponible
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">Tiempo Disponible</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span class="valores_graficaG">'. $datos['tpo_disponible'] .'</span></p>';
$output['data'] .= '<p>Objetivo     <span>'. $o_tpoNoDisponible .'</span></p>';
$output['data'] .= '<p>Desviación   <span>'. ($o_tpoNoDisponible - $datos['tpo_no_disponible']) .'</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';

//Tiempo No Disponible
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">Tiempo No Disponible</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span class="valores_graficaG">'. $datos['tpo_no_disponible'] .'</span></p>';
$output['data'] .= '<p>Objetivo     <span>'. $o_tpoNoDisponible .'</span></p>';
$output['data'] .= '<p>Desviación   <span>'. ($o_tpoNoDisponible - $datos['tpo_no_disponible']) .'</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';

//Tiempo baño
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">Tiempo Baño</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span class="valores_graficaG">'. $datos['tpo_baño'] .'</span></p>';
$output['data'] .= '<p>Objetivo     <span>'. $o_tpoBaño .'</span></p>';
$output['data'] .= '<p>Desviación   <span>'. ($o_tpoBaño - $datos['tpo_baño']) .'</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';

//Tiempo Hablando
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">Tiempo Hablado</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span class="valores_graficaG">'. $datos['tpo_hablando'] .'</span></p>';
$output['data'] .= '<p>Objetivo     <span>'. $o_tpoHablado .'</span></p>';
$output['data'] .= '<p>Desviación   <span>'. ($o_tpoHablado - $datos['tpo_hablando']) .'</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';

//Tiempo Descanso
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">Tiempo Descanso</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span class="valores_graficaG">'. $datos['tpo_descanso'] .'</span></p>';
$output['data'] .= '<p>Objetivo     <span>'. $o_tpoDescanso .'</span></p>';
$output['data'] .= '<p>Desviación   <span>'. ($o_tpoDescanso - $datos['tpo_descanso']) .'</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';

//Faltas
$output['data'] .= '<div class="tarjeta">';
$output['data'] .= '<h4 class="tj__titulo">Faltas</h4>';
$output['data'] .= '<div class="tj-tipo1__indicadores">';
$output['data'] .= '<p>Ejecutado    <span>X</span></p>';
$output['data'] .= '<p>Objetivo     <span>X</span></p>';
$output['data'] .= '<p>Desviación   <span>X</span></p>';
$output['data'] .= '</div>';
$output['data'] .= '</div>';


echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>