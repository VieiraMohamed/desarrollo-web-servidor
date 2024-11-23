<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require('../util/conexion.php');
    ?>
</head>
<body>  
    <div class ="container">
        
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $id = $_POST["id"];
                //echo "<h1>$id</h1>";
                //borrar anime
                $sql = "DELETE FROM categorias WHERE id = $id";
                $_conexion -> query($sql);
            }

            $sql = "SELECT * FROM categorias";
            $resultado = $_conexion -> query($sql);
            
        ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()){//trata el resultado como array asociativo
                        echo "<tr>";
                        echo "<td>". $fila["categoria"] ."</td>";
                        echo "<td>". $fila["descripcion"] ."</td>";
                    ?>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $fila["id"]?>">
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="editar_categoria.php?id=<?php echo $fila["id"]?>">Editar</a>
                        </td>   
                                           
                    <?php
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
        <td>
            <a class="btn btn-primary" href="nueva_categoria.php">Crear Categoría</a>
        </td>   
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>