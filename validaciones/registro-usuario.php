<?php
include '../conexion/conexion.php';

// Validar y limpiar los datos de entrada
$nombre_completo = isset($_POST['nombre_completo']) ? trim($_POST['nombre_completo']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';



// Verificar si el correo ya está registrado (insensible a mayúsculas y minúsculas)
$query = "SELECT * FROM usuarios WHERE LOWER(correo) = LOWER('$correo')";
$verificar = mysqli_query($conn, $query);

if (mysqli_num_rows($verificar) > 0) {
    echo '
    <script>
        alert("Correo ya registrado, intenta con otro diferente");
        window.location.href = "../php/registro.php";
    </script>';
    exit();
    
}

// Hash de la contraseña
$contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

// Insertar nuevo usuario
$query = "INSERT INTO usuarios (nombre_completo, correo, contrasena) 
          VALUES ('$nombre_completo', '$correo', '$contrasena_hash')";

if (mysqli_query($conn, $query)) {
    echo '
    <script>
        alert("Usuario guardado exitosamente");
        window.location.href = "../php/login.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al guardar el usuario. Por favor, inténtalo de nuevo.");
        window.location.href = "../php/registro.php";
    </script>';
}
?>
