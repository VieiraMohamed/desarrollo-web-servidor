<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error{
            color:red;
        }
    </style>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require('../util/conexion.php');
    ?>
</head>
<body>
    <div class ="container">
        <?php

            // Obtener las categorías para el select
            $sql = "SELECT * FROM categorias";
            $categorias = $_conexion->query($sql);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = $_POST['nombre'];
                $precio = $_POST['precio'];
                $stock = $_POST['stock'];
                $categoria_id = $_POST['categoria_id'];
                $imagen = $_POST['imagen'];

                // Validaciones
                if (!isset($nombre) || !isset($precio) || !isset($categoria_id) || !isset($imagen)) {
                    echo "Todos los campos son obligatorios.";
                } else {
                    $sql = "INSERT INTO productos (nombre, precio, stock, imagen, categoria_id) 
                            VALUES ('$nombre', '$precio', '$stock', '$imagen', '$categoria_id')";
                    if ($_conexion->query($sql)) {
                        echo "Producto creado correctamente.";
                    } else {
                        echo "Error al crear el producto.";
                    }
                }
            }
        ?>

            <form class="col-4" action="" method="post">
                <div class="mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" >
                </div>
                <div class="mb-3">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" pattern="[0-9]{1,4}(\.[0-9]{1,2})?" >
                </div>
                <div class="mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" value="0">
                </div>
                <div class="mb-3">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id"  required>
                        <?php while ($categoria = $categorias->fetch_assoc()): ?>
                            <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagen</label>
                    <input class="form-control" type="file" name="imagen">
                </div>
                <input class="btn btn-primary" type="submit" value="Insertar">
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>