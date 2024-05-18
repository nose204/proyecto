<?php
require '../conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    
    $producto_id = intval($producto_id);


    
    $query = "DELETE FROM productos WHERE ProductoID=?";

    // Preparar la declaración
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $producto_id);

    if ($stmt->execute()) {
        // Éxito: redirigir al usuario a la página index.php
        header("Location: index.php");
        exit();
    } else {
        // Error: mostrar mensaje de error
        echo '<div class="alert alert-danger" role="alert">Error al eliminar el producto: ' . $conn->error . '</div>';
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
   
}
?>