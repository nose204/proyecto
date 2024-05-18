<?php
session_start();
require('../conexion/conexion.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Validación de correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $correoerror = "El correo no es valido!";
    $_SESSION['error_msg'] = $correoerror;
    header('location: ../php/login.php');
    exit;
}

// Realizar la consulta
$result = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo'");

if (mysqli_num_rows($result) == 1) {
    $usuario = mysqli_fetch_assoc($result);
    $password_encriptada = $usuario['contrasena'];

    if (password_verify($contrasena, $password_encriptada)) {
        $_SESSION['isLogin'] = true;
        $_SESSION['info'] = $usuario;
        header('location: ../php/index.php');
    } else {
        $contrasenaError = "La contraseña es incorrecta!!";
        $_SESSION['error_msg'] = $contrasenaError;
        header('location: ../php/login.php');
    }
} else {
    $correoerror = "El email no existe!";
    $_SESSION['error_msg'] = $correoerror;
    header('location: ../php/login.php');
}
exit;
?>

