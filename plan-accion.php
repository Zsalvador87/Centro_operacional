<?php
    require __DIR__. '/includes/funciones.php';    
    $consulta_supervisores = obtener_supervisores();
    $consulta_coordinadores = obtener_coordinadores();
    $consulta_gerentes = obtener_gerentes();
?>

<!DOCTYPE html>
<html lang="es">
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
            <h1>Plan de Acción</h1>
        </section>

        <section class="resumen__agentes">
            <ul class="contenedor__tabs">
              <li class="tab activo-p">Supervisión</li>
              <li class="tab">Coordinación</li>
              <li class="tab">Gerencia</li>
            </ul>

            <div class="subcontenedor-p">
              <div class="bloque activo-p"> <!--Inicio de primer bloque 1/3-->
                <div class="bloque__filtro"><!--Inicio del filtro-->
                  <div class="filtro-usuario__pestaña">
                    <label for="">Supervisor: </label>
                    <select name="" id="campoS">
                        <option value="" disable>--GENERAL--</option>
                    <?php
                        while($supervisor = mysqli_fetch_assoc($consulta_supervisores)) { ?>
                            <option><?php echo $supervisor['supervisor']; ?></option>
                    <?php } ?>
                    </select>
                    </div>
                </div> <!--Fin filtro -->

                <!-- Tabla de agentes -->
                <table class="p_tbAccion">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Supervisor</th>
                            <th>Alertas</th>
                            <th>Rank</th>
                            <th>Acuerdos</th>
                            <th>Acciones</th>
                            <th>Monitoreos</th>
                        </tr>
                    </thead>
                    <tbody  id="tb_supervisor">
                    </tbody>
                </table>

                <div class="nav-paginacion">
                <div>
                    <label for="" id="lbl-total"></label>
                </div>

                <div id="paginacion">

                </div>
                </div>

              </div><!--Fin de primer bloque 1/3-->

              <div class="bloque"> <!--Inicio de primer bloque 1/3-->
                <div class="bloque__filtro"><!--Inicio del filtro-->
                  <div class="filtro-usuario__pestaña">
                    <label for="">Supervisor: </label>
                    <select name="" id="">
                    <?php
                        while($coordinador = mysqli_fetch_assoc($consulta_coordinadores)) { ?>
                            <option><?php echo $coordinador['coordinador']; ?></p>
                    <?php } ?>
                    </select>
                  </div>
                </div> <!--Fin filtro -->

                <!-- Tabla de agentes -->
                <table id="actionPlanTable" class="p_tbAccion">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Supervisor</th>
                            <th>Alertas</th>
                            <th>Rank</th>
                            <th>Acuerdos</th>
                            <th>Acciones</th>
                            <th>Monitoreos</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td>GARDUÑO VILLEGAS MARIA DEL CARMEN CONCEPCION</td>
                            <td class="txt-center">guadalupe.mendoza</td>
                            <td>GARDUÑO VILLEGAS MARIA DEL CARMEN CONCEPCION</td>
                            <td class="txt-center">3</td>
                            <td class="txt-center">Low</td>
                            <td class="txt-center"><img class="icono_pdf" src="img/pdf_icon.png" width="15px" alt="PDF"></td>
                            <td class="txt-center"><button onclick="abrirModal()">Ver más</button></td>
                        </tr>
                        <tr class="">
                            <td>Ana López</td>
                            <td class="txt-center">analo</td>
                            <td>Pedro Ruiz</td>
                            <td class="txt-center">2</td>
                            <td class="txt-center">Low</td>
                            <td class="txt-center"><img class="icono_pdf" src="img/pdf_icon.png" alt="PDF" width="15px"></td>
                            <td class="txt-center"><button onclick="abrirModal()">Ver más</button></td>
                        </tr>
                        <tr class="">
                            <td>Carlos Martínez</td>
                            <td class="txt-center">carlosm</td>
                            <td>Luisa García</td>
                            <td class="txt-center">5</td>
                            <td class="txt-center">Medium</td>
                            <td class="txt-center"><img class="icono_pdf" src="img/pdf_icon.png" alt="PDF" width="15px"></td>
                            <td class="txt-center"><button onclick="abrirModal()">Ver más</button></td>
                        </tr>
                    </tbody>
                </table>

              </div><!--Fin de primer bloque 2/3-->

              <div class="bloque"> <!--Inicio de primer bloque 1/3-->
                <div class="bloque__filtro"><!--Inicio del filtro-->
                  <div class="filtro-usuario__pestaña">
                    <label for="">Supervisor: </label>
                    <select name="" id="">
                    <?php
                        while($gerente = mysqli_fetch_assoc($consulta_gerentes)) { ?>
                            <option><?php echo $gerente['gerente']; ?></p>
                    <?php } ?>
                    </select>
                  </div>
                </div> <!--Fin filtro -->

                <!-- Tabla de agentes -->
                <table class="p_tbAccion">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Supervisor</th>
                            <th>Alertas</th>
                            <th>Rank</th>
                            <th>Acuerdos</th>
                            <th>Acciones</th>
                            <th>Monitoreos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td>GARDUÑO VILLEGAS MARIA DEL CARMEN CONCEPCION</td>
                            <td class="txt-center">guadalupe.mendoza</td>
                            <td>GARDUÑO VILLEGAS MARIA DEL CARMEN CONCEPCION</td>
                            <td class="txt-center">3</td>
                            <td class="txt-center">Low</td>
                            <td class="txt-center"><img class="icono_pdf" src="img/pdf_icon.png" width="15px" alt="PDF"></td>
                            <td class="txt-center"><button onclick="abrirModal()">Ver más</button></td>
                        </tr>
                        <tr class="">
                            <td>Ana López</td>
                            <td class="txt-center">analo</td>
                            <td>Pedro Ruiz</td>
                            <td class="txt-center">2</td>
                            <td class="txt-center">Low</td>
                            <td class="txt-center"><img class="icono_pdf" src="img/pdf_icon.png" alt="PDF" width="15px"></td>
                            <td class="txt-center"><button onclick="abrirModal()">Ver más</button></td>
                        </tr>
                    </tbody>
                </table>

              </div><!--Fin de primer bloque 3/3-->
            </div>
        </section>
    </main>

    <dialog id="modal">
        <h2>Detalle</h2>
        <!--Información de agente-->
        <section class="info_agente">
            <h3>Información del agente</h3>
            <div class="informacion">
                <p><span>Nombre: </span>GARDUÑO VILLEGAS MARIA DEL CARMEN CONCEPCION</p>
                <p><span>Usuario: </span>guadalupe.mendoza</p>
                <p><span>Supervisor: </span>GARDUÑO VILLEGAS MARIA DEL CARMEN CONCEPCION</p>
            </div>

            <div class="estatus">
                <h3>Estatus</h3><p class="estatus--desicion">Sin riesgo</p>
            </div>
        </section>

        <!--4 rubros de evaluación-->
        <section class="evaluacion_agente">
            <h3>Evaluación</h3>
            <table>
                <thead>
                    <th>Higiénicos</th>
                    <th>Funnel</th>
                    <th>Calidad</th>
                    <th>Formación</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    <tr>
                        <td>45%</td>
                        <td>45%</td>
                        <td>5%</td>
                        <td>5%</td>
                        <td>100%</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!--Alertas del agente-->
        <section class="alertas_agente">
            <h3>Alertas</h3>
            <table>
                <thead>
                    <th>Fecha</th>
                    <th>Rubro</th>
                    <th>Motivo</th>
                    <th>Plan de acción</th>
                </thead>
                <tbody>
                    <tr>
                        <td>17/05/2025</td>
                        <td>Higiénicos</td>
                        <td>Retardos</td>
                        <td><button onclick="mostrarZona('archivo')">Subir Documento</button></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!--Zona para cargar documentos-->
        <section class="zona_carga">
            <h3>Sube tu documento</h3>
            <div>
            <input type="file" id="archivoPDF" accept="application/pdf">
            <small id="error"></small>
            <input class="boton" type="submit" value="Subir">
            </div>
        </section>

        <section class="zona_enlace">
            <h3>Coloca el enlace del Feedback</h3>
            <div>
                <input type="text">
                <input class="boton" type="submit" value="Enviar">
            </div>
        </section>
        <button class="boton" onclick="cerrarModal()">Cerrar</button>
    </dialog>

     <script src="js/planAccion.js"></script>

</body>
</html>
