<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        require('../util/conexion.php');
    ?>
</head>
<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <?php
        $id_producto = $_GET["id_producto"];
        // Consulta para obtener los datos del producto
        $sql = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
        $resultado = $_conexion -> query($sql);
        
        while($fila = $resultado -> fetch_assoc()){
            $nombre = $fila["nombre"];
            $precio = $fila["precio"];
            $categoria = $fila["categoria"];
            $stock = $fila["stock"];
            $descripcion = $fila["descripcion"];
        }
        
        // Consulta para obtener todas las categorías de la tabla 'categorias'
        $sql_categorias = "SELECT * FROM categorias";
        $resultado_categorias = $_conexion -> query($sql_categorias);
        ?>

        <?php
        // Definir las variables de error
        $err_nombre = $err_precio = $err_categoria = $err_descripcion = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperamos los datos del formulario
            $tmp_nombre = $_POST["nombre"];
            $tmp_precio = $_POST["precio"];
            $tmp_categoria = $_POST["categoria"];
            $stock = $_POST["stock"];
            $tmp_descripcion = $_POST["descripcion"];

            // Validación del nombre
            if ($tmp_nombre == '') {
                $err_nombre = "El nombre es obligatorio";
            } elseif (strlen($tmp_nombre) < 3 || strlen($tmp_nombre) > 50) {
                $err_nombre = "El nombre debe tener entre 3 y 50 caracteres";
            } else {
                $nombre = $tmp_nombre;
            }

            // Validación del precio
            if ($tmp_precio == '') {
                $err_precio = "El precio es obligatorio";
            } elseif (!preg_match("/^[0-9]{1,4}(\.[0-9]{1,2})?$/", $tmp_precio)) {
                $err_precio = "El precio debe ser un número válido con hasta 4 dígitos y 2 decimales";
            } else {
                $precio = $tmp_precio;
            }

            // Validación de la categoría
            if ($tmp_categoria == '') {
                $err_categoria = "Debe seleccionar una categoría";
            } else {
                $categoria = $tmp_categoria;
            }

            // Validación de la descripción
            if ($tmp_descripcion == '') {
                $err_descripcion = "La descripción es obligatoria";
            } else {
                $descripcion = $tmp_descripcion;
            }
            
            // Si no hay errores, actualizamos el producto
            if (isset($nombre,$precio,$categoria,$stock,$descripcion)) {
                $sql_update = "UPDATE productos SET 
                    nombre = '$nombre', 
                    precio = '$precio', 
                    categoria = '$categoria', 
                    stock = '$stock', 
                    descripcion = '$descripcion'
                    WHERE id_producto = '$id_producto'";
                $_conexion -> query($sql_update);
            }
        }
        ?>
        
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" >
                <?php if ($err_nombre) echo "<span class='error' style='color: red;'>$err_nombre</span>"; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="text" name="precio" value="<?php echo htmlspecialchars($precio); ?>" >
                <?php if ($err_precio) echo "<span class='error' style='color: red;'>$err_precio</span>"; ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="categoria">Categoría:</label>
                <select class="form-select" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <?php while ($categoria_db = $resultado_categorias->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($categoria_db['categoria']); ?>" 
                            <?php echo ($categoria == $categoria_db['categoria']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($categoria_db['categoria']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <?php if ($err_categoria) echo "<span class='error' style='color: red;'>$err_categoria</span>"; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" type="text" name="stock" value="<?php echo htmlspecialchars($stock); ?>" >
            </div>
            <div class="mb-3">
                <label class="form-label" for="descripcion">Descripción:</label>
                <textarea class="form-control" name="descripcion" rows="4" cols="50" ><?php echo htmlspecialchars($descripcion); ?></textarea>
                <?php if ($err_descripcion) echo "<span class='error' style='color: red;'>$err_descripcion</span>"; ?>
            </div>
            <div class="mb-3">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <input class="btn btn-primary" type="submit" value="Actualizar Producto">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<!--  script para la base de datos 


  CREATE DATABASE tienda_bd;

USE tienda_bd;

CREATE TABLE categorias (
    categoria VARCHAR(30) PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    precio NUMERIC(6,2) NOT NULL,
    categoria VARCHAR(30),
    stock INT DEFAULT 0,
    imagen VARCHAR(60) NOT NULL,
    descripcion VARCHAR(255),
    FOREIGN KEY (categoria) REFERENCES categorias(categoria)
);

-->