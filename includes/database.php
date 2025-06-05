<?php
$db = new mysqli('localhost', 'root', 'root', 'control_operacional');

if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}
?>
