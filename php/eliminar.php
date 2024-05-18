
<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container py-4">
            <h2 class="text-center">Confirmar Eliminación</h2>
            <p class="p_1 text-center align-items-center">¿Está seguro de que desea eliminar este producto?</p>

            <form action="eliminar_datos.php" method="post" class="text-center">
                <input type="hidden" name="producto_id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>



