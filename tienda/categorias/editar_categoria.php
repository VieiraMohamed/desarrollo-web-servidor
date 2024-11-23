<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require('../util/conexion.php');
    ?>
</head>
<body>
    <div class="container">
        <h1>Editar Categoría</h1>
        <?php
        //echo "<h1>".$_GET['id']."</h1>";
        
        $id = $_GET["id"];
        $sql = "SELECT * FROM categorias WHERE id = $id";
        $resultado= $_conexion -> query($sql);

        
        while($fila = $resultado -> fetch_assoc()){
            $categoria= $fila["categoria"];
            $descripcion = $fila["descripcion"];
            
        }
        

        $sql = "SELECT * FROM categorias";
        $resultado = $_conexion -> query($sql);
        $categorias = [];

        while($fila = $resultado -> fetch_assoc()){
            array_push($categorias, $fila["categoria"]);
        }
        //print_r($estudios);
        
        if($_SERVER["REQUEST_METHOD"] == "POST" ){
            $id = $_POST["id"];
            $categoria = $_POST["categoria"];
            $descripcion = $_POST["descripcion"];

            $sql= "UPDATE categorias SET
                descripcion = '$descripcion'
                WHERE id = $id
            ";
            $_conexion -> query($sql);
        }
        ?>
        
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input class="form-control" type="text"  value ="<?php echo $categoria?>" disabled>
                <input class="form-control" type="hidden" name="categoria" value ="<?php echo $categoria?>" >

            </div>
            <div class="mb-3">
                <label class="form-label" for="descripcion" >Descripción:</label>
                <textarea  name="descripcion" rows="4" cols="50" required></textarea>
            </div>
            <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input class="btn btn-primary" type="submit" value="Actualizar Categoría">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>