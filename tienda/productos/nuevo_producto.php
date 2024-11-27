<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error {
            color: red;
        }
    </style>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        require('../util/conexion.php');
    ?>
</head>
<body>
    <h1>Crear Nuevo Producto</h1>
    <?php
    
        // Inicialización de variables
        $nombre = $precio = $stock = $categoria = $descripcion = $imagen = "";
        $err_nombre = $err_precio = $err_categoria = $err_descripcion = $err_imagen = "";

        // Obtener las categorías para el select
        $sql = "SELECT * FROM categorias";
        $categorias = $_conexion->query($sql);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validación del nombre
            $tmp_nombre = $_POST['nombre'];
            $tmp_precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $tmp_categoria = $_POST['categoria'];
            $tmp_descripcion = $_POST["descripcion"];
            $tmp_imagen = $_FILES["imagen"]["name"];

            if ($tmp_nombre == '') {
                $err_nombre = "El nombre es obligatorio";
            } elseif (strlen($tmp_nombre) < 2 || strlen($tmp_nombre) > 50) {
                $err_nombre = "El nombre debe tener entre 3 y 50 caracteres";
            } else {
                $nombre = $tmp_nombre;
            }

            // Validación del precio
            if ($tmp_precio == '') {
                $err_precio = "El precio es obligatorio";
            }else{
                $patron = "/^[0-9]{1,4}(\.[0-9]{1,2})?$/";
                if (!preg_match($patron, $tmp_precio)) {
                    $err_precio = "El precio debe ser un número válido con hasta 4 dígitos y 2 decimales";
                } else {
                    $precio = $tmp_precio;
                }
            } 

            // Validación de la categoría
            if ($tmp_categoria == '') {
                $err_categoria = "Debe seleccionar una categoría";
            } else {
                $categoria = $tmp_categoria;
            }

            if($stock == '' || $stock < 0){
                $stock = 0;
            }

            // Validación de la descripción
            if ($tmp_descripcion == '') {
                $err_descripcion = "La descripción es obligatoria";
            } else {
                $descripcion = $tmp_descripcion;
            }

            // Validación de la imagen
            if ($tmp_imagen == '') {
                $err_imagen = "Debes ingresar una imagen";
            } else {
                $tmp_imagen = $_FILES["imagen"]["name"];
                $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
                $ubicacion_final = "./imagen/$tmp_imagen";

                if (!move_uploaded_file($ubicacion_temporal, $ubicacion_final)) {
                    $err_imagen = "Error al subir la imagen";
                }
            }

            // Si todas las validaciones pasan
            if (isset($nombre, $precio, $categoria, $descripcion, $tmp_imagen) && !$err_nombre && !$err_precio && !$err_categoria && !$err_descripcion && !$err_imagen) {
                $sql = "INSERT INTO productos (nombre, precio, stock, categoria, imagen, descripcion) 
                        VALUES ('$nombre', '$precio', '$stock', '$categoria', '$tmp_imagen', '$descripcion')";
                if ($_conexion->query($sql)) {
                    echo "<p class='text-success'>Producto creado correctamente.</p>";
                } else {
                    echo "<p class='text-danger'>Error al crear el producto: " . $_conexion->error . "</p>";
                }
            }
        }
    ?>

    <form class="col-6" action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="nombre">Nombre:</label>
            <input class="form-control" type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            <?php if ($err_nombre) echo "<span class='error'>$err_nombre</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="precio">Precio:</label>
            <input class="form-control" type="text" name="precio" value="<?php echo htmlspecialchars($precio); ?>" pattern="[0-9]{1,4}(\.[0-9]{1,2})?">
            <?php if ($err_precio) echo "<span class='error'>$err_precio</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="stock">Stock:</label>
            <input class="form-control" type="text" name="stock" value="<?php echo htmlspecialchars($stock); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="categoria">Categoría:</label>
            <select class="form-select" name="categoria">
            <option value="">Seleccione una categoría</option>
            <?php while ($categoria = $categorias->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($categoria['categoria']); ?>" 
                    <?php echo (isset($categoria) && $categoria == $categoria['categoria']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($categoria['categoria']); ?>
                </option>
            <?php endwhile; ?>
            </select>
            <?php if ($err_categoria) echo "<span class='error'>$err_categoria</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="imagen">Imagen:</label>
            <input class="form-control" type="file" name="imagen">
            <?php if ($err_imagen) echo "<span class='error'>$err_imagen</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label" for="descripcion">Descripción:</label>
            <textarea class="form-control" name="descripcion" rows="4"><?php echo htmlspecialchars($descripcion); ?></textarea>
            <?php if ($err_descripcion) echo "<span class='error'>$err_descripcion</span>"; ?>
        </div>
        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Insertar">
            <a class="btn btn-secondary" href="index.php">Volver</a>
        </div>
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
