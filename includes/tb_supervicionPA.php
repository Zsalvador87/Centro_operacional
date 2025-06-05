<?php
require  'database.php'; 

//Variables
$columnas = ['nombre', 'usuario', 'supervisor'];
$id = 'nombre';
$tabla = 'plantilla';


$campo = isset($_POST['campo']) ? mysqli_real_escape_string($db, $_POST['campo']) : null;
$where = '';

//Filtro
if($campo != null){
    $where = "AND ";
    $cont = count($columnas);
    $where .= $columnas[1] . " LIKE '%" . $campo . "%'";

    //Este bucle toma como busqueda las tres columnas dentro de la consulta. Para activar, hay que borrar la línea 17:$where .= $columnas[1] . " LIKE '%" . $campo . "%'";
    // for($i = 0; $i < $cont; $i++){
    //     $where .= $columnas[$i] . " LIKE '%" . $campo . "%' OR ";
    // }
    
    //Esta línea quita el "OR" al final
    //$where = substr_replace($where, "", -3);
}

//Limite
$limite = isset($_POST['registros']) ? mysqli_real_escape_string($db, $_POST['registros']) : 30;
$pagina = isset($_POST['pagina']) ? mysqli_real_escape_string($db, $_POST['pagina']) : 0;

if(!$pagina){
    $inicio = 0;
    $pagina = 1;
}else{
    $inicio = ($pagina - 1 ) * $limite;
}

$sLimit = "LIMIT $inicio,$limite";

$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT " . implode(", ", $columnas) ." FROM " . $tabla ." WHERE supervisor NOT IN ('OTRO') AND status NOT IN ('BAJA', 'CAMBIO') " . $where ." ORDER BY nombre ASC $sLimit;";
//echo $sql;
$resultado = mysqli_query($db, $sql);
$num_filas = $resultado->num_rows;


/*Consulta para conocer el total de registros filtrados*/
$sqlFiltro = "SELECT FOUND_ROWS()";
$resultado_filtro = mysqli_query($db, $sqlFiltro);
$fila_Filtro = $resultado_filtro->fetch_array();
$total_filtro = $fila_Filtro[0];

$sqlTotal = "SELECT count(distinct $id) FROM $tabla WHERE supervisor NOT IN ('OTRO') AND status NOT IN ('BAJA', 'CAMBIO');";
$resultado_total = mysqli_query($db, $sqlTotal);
$fila_total = $resultado_total->fetch_array();
$total_registros = $fila_total[0];

$output = [];
$output['total_registros'] = $total_registros;
$output['total_filtro'] = $total_filtro;
$output['data'] = "";
$output['paginacion'] = "";

if($num_filas > 0){
    while($row = $resultado->fetch_assoc()){
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['nombre'] . '</td>';
        $output['data'] .= '<td class="txt-center">' . $row['usuario'] . '</td>';
        $output['data'] .= '<td>' . $row['supervisor'] . '</td>';
        $output['data'] .= '<td class="txt-center">3</td>';
        $output['data'] .= '<td class="txt-center">Low</td>';
        $output['data'] .= '<td class="txt-center"><img class="icono_pdf" src="img/pdf_icon.png" width="15px" alt="PDF"></td>';
        $output['data'] .= '<td class="txt-center"><button onclick="abrirModal()">Ver más</button></td>';
        $output['data'] .= '</tr>';
    }
}else{
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="8">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['total_registros'] > 0) {
    $totalPaginas = ceil($output['total_registros'] / $limite);

    $output['paginacion'] .= '<nav class="paginacion">';
    $output['paginacion'] .= '<ul>';

    $numeroInicio = 1;

    if (($pagina - 4) > 1) {
        $numeroInicio = $pagina -4;
    }

    $numeroFin = $numeroInicio + 7;

    if ($numeroFin > $totalPaginas) {
        $numeroFin = $totalPaginas;
    }

    for($i = $numeroInicio; $i <= $numeroFin; $i++){
        if ($pagina == $i) {
            $output['paginacion'] .= '<li><a class="activo" href="#resumen__agentes">'. $i .'</a></li>';
        } else {
            $output['paginacion'] .= '<li><a href="#resumen__agentes" onclick="obtenerSupervisores('. $i .')">'. $i .'</a></li>';
        }
    }
    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);