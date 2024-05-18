<?php
include 'conexion.php   ';

// Validar y limpiar los datos de entrada
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
$precio = isset($_POST['precio']) ? $_POST['precio'] : '';
$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';

// Insertar nuevo producto
$query = "INSERT INTO productos (nombre, descripcion, precio, cantidad) 
          VALUES ('$nombre', '$descripcion', '$precio', '$cantidad')";

if (mysqli_query($conn, $query)) {
    echo '
    <script>
        alert("Producto guardado exitosamente");
        window.location.href = "index.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al guardar el producto. Por favor, inténtalo de nuevo.");
        window.location.href = "insertar.php";
    </script>';
}
?>
