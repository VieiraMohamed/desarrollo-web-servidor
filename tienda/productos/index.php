<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<?php
require_once('../util/conexion.php');

// Obtener todos los productos
$sql = "SELECT * FROM productos";
$result = $_conexion->query($sql);
?>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            while ($producto = $result->fetch_assoc()): 
            ?>
                <tr>
                    <td>
                        <?php echo $producto['nombre']; ?>
                    </td>
                    <td>
                        <?php echo $producto['precio']; ?>
                    </td>
                    <td>
                        <?php echo $producto['stock']; ?>
                    </td>
                    <td>
                        <img src="<?php echo $producto['imagen']; ?>" alt="Imagen del producto" width="50">
                    </td>
                    <td>
                        <a class="btn btn-primary" href="editar_producto.php?id=<?php echo $producto['id']; ?>">Editar</a>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                            <input type="submit" value="Borrar">
                        </form>
                    </td>
                </tr>
        <?php 
            endwhile; 
        ?>
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>