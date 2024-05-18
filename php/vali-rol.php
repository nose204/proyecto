<?php
session_start();
require('../conexion/conexion.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Realizar la consulta
$result = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'");

if (mysqli_num_rows($result) == 1) {
    $usuario = mysqli_fetch_assoc($result);

    // Verificar si el usuario es administrador
    if ($usuario['id_cargo'] == 1) {
        // Administrador
        $_SESSION['isLogin'] = true;
        $_SESSION['info'] = $usuario;
        header("location: index.html");
        exit;
    } else {
        // No es administrador
        $_SESSION['error_msg'] = "No tienes permiso para acceder a esta página.";
        header('location: login.php');
        exit;
    }
} else {
    // Credenciales incorrectas
    $_SESSION['error_msg'] = "Correo o contraseña incorrectos";
    header('location: login.php');
    exit;
}

// Cerrar la conexión
mysqli_close($conn);
?>
