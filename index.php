<?php 
require 'includes/funciones.php';

$fechas_resultado = obtenerFechas();
$fechas = null;

if ($fechas_resultado && mysqli_num_rows($fechas_resultado) > 0) {
    $fechas = mysqli_fetch_assoc($fechas_resultado);
} else {
    $fechas = [
        'minimo' => '2025-01-01',
        'maximo' => date('Y-m-d')
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <title>Centro de control operacional</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@0;1&display=swap" rel="stylesheet">
</head>
<body>

<header class="cabecera">
    <h2>Centro de control operacional</h2>
</header>

<div class="nav-bg">
    <nav class="menu-navegacion">
        <a href="index.php">Inicio</a>
        <a href="equipos.php">Equipos</a>
        <a href="kpis.php">KPIs</a>
        <a href="plan-accion.php">Plan de acción</a>
    </nav>
</div>

<main class="contenido"> 
    <section class="titulo">
        <h1>Vista General</h1>
        <div class="titulo__fecha">
            <label for="">Filtro:</label>
            <input id="fecha_minima" type="date" min="<?php echo $fechas['minimo']; ?>" max="<?php echo $fechas['maximo']; ?>">
            <p>al</p>
            <input id="fecha_maxima" type="date" min="<?php echo $fechas['minimo']; ?>" max="<?php echo $fechas['maximo']; ?>">
            <button id="aplicar_fecha" class="boton">Aplicar</button>
        </div>
    </section>

    <section id="tarjetas_index" class="tarjetas_index"></section>
</main>

<script src="js/index.js"></script>
</body>
</html>
