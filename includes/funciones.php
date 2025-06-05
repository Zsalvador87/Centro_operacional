<?php

// function obtener_supervisores() {
//     try {
//         // Importar las credenciales
//         require 'database.php';

//         // Consulta SQL
//         $sql = "SELECT DISTINCT supervisor, coordinador, gerente, director FROM plantilla WHERE supervisor NOT IN ('OTRO') AND status NOT IN ('BAJA', 'CAMBIO') ORDER BY supervisor ASC;";

//         // Realizar la consulta
//         $consulta = mysqli_query($db, $sql);

//         return $consulta;
//     } catch (\Throwable $th) {
//         var_dump($th);
//     }
// }

// function vacia(){
//     try {
//         // Importar las credenciales

//         // Consulta SQL

//         // Realizar la consulta

//     } catch (\Throwable $th) {
//         var_dump($th);
//     }
// }

//Esta funcion consige la fecha mínima y máxima registrada dentro de la base de datos
function obtenerFechas() {
    try {
        require 'database.php';

        $sql = "SELECT MIN(date) AS minimo, MAX(date) AS maximo FROM higienicos;";
        $consulta = mysqli_query($db, $sql);

        if (!$consulta) {
            throw new Exception("Error en consulta: " . mysqli_error($db));
        }

        return $consulta;

    } catch (\Throwable $th) {
        var_dump($th);
        return false;
    }
}

function obtener_supervisores() {
    try {
        // Importar las credenciales
        require 'database.php';

        // Consulta SQL
        $sql = "SELECT DISTINCT supervisor, coordinador, gerente, director FROM plantilla WHERE supervisor NOT IN ('OTRO') AND status NOT IN ('BAJA', 'CAMBIO') ORDER BY supervisor ASC;";

        // Realizar la consulta
        $consulta = mysqli_query($db, $sql);

        return $consulta;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}


function obtener_coordinadores(){
    try {
        // Importar las credenciales
        require 'database.php';

        // Consulta SQL
        $sql = "SELECT DISTINCT coordinador FROM plantilla ORDER BY coordinador ASC;";

        // Realizar la consulta
        $consulta = mysqli_query($db, $sql);

        return $consulta;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

function obtener_gerentes(){
    try {
        // Importar las credenciales
        require 'database.php';

        // Consulta SQL
        $sql = "SELECT DISTINCT gerente FROM plantilla ORDER BY gerente ASC;";

        // Realizar la consulta
        $consulta = mysqli_query($db, $sql);

        return $consulta;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}





