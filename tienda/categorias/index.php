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
        session_start(); 
        if (!isset($_SESSION["usuario"])) { 
            header("Location: ../usuario/iniciar_sesion.php"); 
            exit();
        }
        function depurar(string $entrada) : string {
            $salida = htmlspecialchars($entrada, ENT_QUOTES, 'UTF-8'); 
            $salida = trim($salida); 
            $salida = stripslashes($salida); 
            $salida = preg_replace('/\s+/', ' ', $salida); 
            return $salida; 
        }
    ?>
</head>
<body>  
    <div class ="container">
        
        <div class="d-flex justify-content-center"> 
            <?php if (isset($_SESSION["usuario"])) {
                echo "<h2>Bienvenid@ ". $_SESSION["usuario"] . "</h2>"; 
                } else { 
                    echo "<h2>Bienvenid@ invitado</h2>"; 
                } ?> 
        </div>


        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $categoria = depurar($_POST["categoria"]);

            // Verificar si hay productos asociados a la categoría
           // $sql = "SELECT COUNT(*) as count FROM productos WHERE categoria = '$categoria'";
            //$resultado = $_conexion->query($sql);

            //1. Preparacion            
            $sql = $_conexion -> prepare("SELECT COUNT(*) as count FROM productos WHERE categoria = ?");
            //2. Enlazado
            $sql -> bind_param("s",$categoria);
            //3. Ejecución
            $sql -> execute();
            //4. Retrieve
            $resultado = $sql -> get_result();

            $count = $resultado->fetch_assoc()["count"];

            if ($count > 0) {
                echo "<p class='text-danger'>No se puede eliminar la categoría '$categoria' porque tiene productos asociados. Primero elimina los productos y luego inténtalo de nuevo.</p>";
            } else {
                //$sql = "DELETE FROM categorias WHERE categoria = '$categoria'";
                //1. Preparacion            
                $sql = $_conexion -> prepare("DELETE FROM categorias WHERE categoria = ?");
                //2. Enlazado
                $sql -> bind_param("s",$categoria);
                //3. Ejecución
                
                if ($sql -> execute()) {
                    echo "<p class='text-success'>Categoría eliminada correctamente.</p>";
                } else {
                    echo "<p class='text-danger'>Error al eliminar la categoría: " . $_conexion->error . "</p>";
                }
            }
        }

        $sql = "SELECT * FROM categorias";
        $resultado = $_conexion->query($sql);
        //5.close
        $_conexion -> close();
        ?>

        <ul class="nav justify-content-end">
            <li>
                <a class="btn btn-warning" href="../usuario/cerrar_sesion.php">Cerrar sesión</a>
            </li>
        </ul> 

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()){ // trata el resultado como array asociativo
                        echo "<tr>";
                        echo "<td>". $fila["categoria"] ."</td>";
                        echo "<td>". $fila["descripcion"] ."</td>";
                    ?>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="categoria" value="<?php echo $fila["categoria"]?>">
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="editar_categoria.php?categoria=<?php echo $fila["categoria"]?>">Editar</a>
                        </td>  

                    <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
 
        <table>
        <thead>
            <th>
                <div>
                    <a class="btn btn-primary" href="nueva_categoria.php">Crear Categoría</a>                    
                </div>
            </th>
            <th>
                <div>
                    <a class="btn btn-primary" href="../productos/index.php">Ir a Productos</a>
                </div>
            </th>
            <th>
                <div>
                    <a class="btn btn-secondary" href="../index.php">Volver a Página Principal</a>
                </div>
            </th>
        </thead>
     </table>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
