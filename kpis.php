<?php
    require __DIR__. '/includes/funciones.php';    
    $consulta_supervisores = obtener_supervisores();
    $consulta_coordinadores = obtener_coordinadores();
    $consulta_gerentes = obtener_gerentes();
    $fechas = mysqli_fetch_assoc(obtenerFechas());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <title>Centro de control operacional</title>
    <!--Enlace a hojas de calculo-->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <!--Enlace a fuente roboto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@0;1&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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
            <!--<a href="#">Métricas</a>
            <a href="#">Monitoreo</a>
            <a href="#">Ventas</a>-->
            <a href="plan-accion.php">Plan de acción</a>
            <!--<a href="#">Decisión de salida</a>-->
        </nav>
    </div>
    
    <main class="contenido">
            <section class="titulo">
                <h1>Resumen de indicadores</h1>
            </section>

        <section class="resumen__indicadores">
            <ul class="contenedor__tabs">
              <li class="tab activo-i">Supervisión</li>
              <li class="tab">Coordinación</li>
              <li class="tab">Gerencia</li>
            </ul>

            <div class="subcontenedor-i">
              <div class="bloque activo-i"> <!--Inicio de primer bloque 1/3-->

                <div class="bloque__filtro"><!--Inicio del filtro-->
                  <div class="filtro-usuario__pestaña">
                    <label for="">Supervisor: </label>
                    <select id="campoS" name="">
                    <?php
                        while($supervisor = mysqli_fetch_assoc($consulta_supervisores)) { ?>
                            <option><?php echo $supervisor['supervisor']; ?></p>
                    <?php } ?>
                      </select>
                    </div>

                    <div class="filtro-fecha__pestaña">
                      <label for="">Filtro:</label>
                      <input id="fecha_minimaS" type="date" min=<?php echo $fechas['minimo'];?> max=<?php echo $fechas['maximo'];?>>
                      <p>al</p>
                      <input id="fecha_maximaS" type="date" min=<?php echo $fechas['minimo'];?> max=<?php echo $fechas['maximo'];?>>
                      <button id="aplicar_fechaS" class="boton">Aplicar</button>
                    </div>
                  </div> <!--Fin filtro -->


                <div id="tarjetas_supervisor" class="bloque__tarjetas"><!--Inicio de las tarjetas-->
                </div><!--Fin de las tarjetas-->

                <div class="bloque__grafica"><!--Inicio de gráfica-->
                  <h3>Distribución de tiempo</h3>
                  <canvas id="grafica-pastel__supervision"></canvas>
                </div><!--Fin de las gráfica-->
              </div><!--Fin de primer bloque 1/3-->

              <div class="bloque"><!--Inicio de primer bloque 2/3-->
                <div class="bloque__filtro"><!--Inicio del filtro-->
                  <div class="filtro-usuario__pestaña">
                    <label for="">Coordinador: </label>
                    <select id="campoC" name="">
                    <?php
                        while($coordinador = mysqli_fetch_assoc($consulta_coordinadores)) { ?>
                            <option><?php echo $coordinador['coordinador']; ?></p>
                    <?php } ?>
                    </select>
                  </div>

                    <div class="filtro-fecha__pestaña">
                      <label for="">Filtro:</label>
                      <input id="fecha_minimaC" type="date" min=<?php echo $fechas['minimo'];?> max=<?php echo $fechas['maximo'];?>>
                      <p>al</p>
                      <input id="fecha_maximaC" type="date" min=<?php echo $fechas['minimo'];?> max=<?php echo $fechas['maximo'];?>>
                      <button id="aplicar_fechaC" class="boton">Aplicar</button>
                    </div>
                </div> <!--Fin filtro -->
                
                <div id="tarjetas_coordinador" class="bloque__tarjetas"><!--Inicio de las tarjetas-->
                </div><!--Fin de las tarjetas-->

                <div class="bloque__grafica"><!--Inicio de gráfica-->
                  <h3>Distribución de tiempo</h3>
                  <canvas id="grafica-pastel__coordinacion"></canvas>
                </div><!--Fin de las gráfica-->
              </div><!--Fin de primer bloque 2/3-->

              <div class="bloque"><!--Inicio de primer bloque 3/3-->
                <div class="bloque__filtro"><!--Inicio del filtro-->
                  <div class="filtro-usuario__pestaña">
                    <label for="">Gerente: </label>
                    <select id="campoG" name="">
                    <?php
                        while($gerente = mysqli_fetch_assoc($consulta_gerentes)) { ?>
                            <option><?php echo $gerente['gerente']; ?></p>
                    <?php } ?>
                    </select>
                  </div>

                    <div class="filtro-fecha__pestaña">
                    <label for="">Filtro:</label>
                      <input id="fecha_minimaG" type="date" min=<?php echo $fechas['minimo'];?> max=<?php echo $fechas['maximo'];?>>
                      <p>al</p>
                      <input id="fecha_maximaG" type="date" min=<?php echo $fechas['minimo'];?> max=<?php echo $fechas['maximo'];?>>
                      <button id="aplicar_fechaG" class="boton">Aplicar</button>
                    </div>
                  </div> <!--Fin filtro -->

                <div id="tarjetas_gerente" class="bloque__tarjetas"><!--Inicio de las tarjetas-->
                </div><!--Fin de las tarjetas-->

                <div class="bloque__grafica"><!--Inicio de gráfica-->
                  <h3>Distribución de tiempo</h3>
                  <canvas id="grafica-pastel__gerencia"></canvas>
                </div><!--Fin de las gráfica-->
              </div><!--Fin de primer bloque 3/3-->
            </div>
        </section>
    </main>

    <script src="js/kpis.js"></script>
</body>
</html>