<?php
session_start();

$conn = new mysqli('localhost', 'root', 'root', 'control_operacional');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_usuario = $_POST['nombre_usuario'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM usuarioslog WHERE nombre_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $hash = $row['contraseña'];

    if ($hash && password_verify($password, $hash)) {
        // Login exitoso: guardar datos en sesión
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
        $_SESSION['rol'] = $row['rol'];

        header("Location: index.php");
        exit;
    } else {
        echo "❌ Contraseña incorrecta.";
    }
} else {
    echo "❌ Usuario no encontrado.";
}

$conn->close();
?>