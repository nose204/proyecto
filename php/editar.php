<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Editar datos en tiempo real con PHP, MySQL y AJAX">
    <meta name="author" content="Marco Robles">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-primary1{
            color: red;
        }
    </style>
</head>
<body>
    <main class="container py-4">
        <h2 class="text-center">Editar Producto</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                require '../conexion/conexion.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad'], $_POST['producto_id'])) {
                        $nombre = $_POST['nombre'];
                        $descripcion = $_POST['descripcion'];
                        $precio = $_POST['precio'];
                        $cantidad = $_POST['cantidad'];
                        $producto_id = $_POST['producto_id'];

                        $stmt = $conn->prepare("UPDATE productos SET Nombre=?, Descripcion=?, Precio=?, Cantidad=? WHERE ProductoID=?");
                        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $cantidad, $producto_id);

                        if ($stmt->execute()) {
                            header("Location: index.php");
                            exit();
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . htmlspecialchars($stmt->error) . '</div>';
                        }
                        $stmt->close();
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos del formulario.</div>';
                    }
                }

                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $producto_id = $_GET['id'];
                    $stmt = $conn->prepare("SELECT * FROM productos WHERE ProductoID = ?");
                    $stmt->bind_param("i", $producto_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="producto_id" value="<?php echo $row['ProductoID']; ?>">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['Nombre']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo $row['Descripcion']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio:</label>
                                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $row['Precio']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $row['Cantidad']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                            <button type="submit" class="btn btn-primary">Cancelar Producto</button>
                        </form>
                        <?php
                    } else {
                        echo '<div class="alert alert-danger" role="alert">No se encontró el producto.</div>';
                    }
                    $stmt->close();
                } else {
                    echo '<div class="alert alert-danger" role="alert">No se especificó el ID del producto.</div>';
                }
                ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
