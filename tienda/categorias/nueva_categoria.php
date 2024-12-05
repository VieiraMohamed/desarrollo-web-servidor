<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error{
            color:red;
        }
    </style>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        require('../util/conexion.php');
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
    
    <h1>Crear Categoría</h1>
    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tmp_categoria = depurar($_POST["categoria"]);
        $tmp_descripcion = depurar($_POST["descripcion"]);

        if ($tmp_categoria == '') {
            $err_categoria = "La categoría es obligatoria";
        } else {
            $patron = "/^[a-zA-Z ]+$/";
            if (!preg_match($patron, $tmp_categoria)) {
                $err_categoria = "La categoría solo puede contener letras y espacios en blanco";
            } else {
                if (strlen($tmp_categoria) < 2 || strlen($tmp_categoria) > 30) {
                    $err_categoria = "La categoría no puede ser menor a 4 ni mayor a 30 caracteres";
                } else {
                    //verifico si la categoria ya existe
                    $sql = "SELECT * FROM categorias WHERE categoria = '$tmp_categoria'";
                    $resultado= $_conexion->query($sql);
                    if ($resultado->num_rows > 0) {
                        $err_categoria = "La categoría ya existe,elige otro nombre.";
                    } else {
                        $categoria = $tmp_categoria;
                    }
                }
            }
        }

        if ($tmp_descripcion == '') {
            $err_descripcion = "La descripción es obligatoria";          
        } else {
            if(strlen($tmp_descripcion) > 255){
                $err_descripcion = "No puede tener más de 255 carácteres";
            }else{
                $descripcion = $tmp_descripcion;
            }           
        }

        if (isset($categoria) && isset($descripcion)) {
            $sql = "INSERT INTO categorias (categoria, descripcion) 
            VALUES ('$categoria', '$descripcion')";

            if ($_conexion->query($sql)) {
                echo "<p class='text-success'>Categoría creada correctamente.</p>";
            } else {
                echo "<p class='text-danger'>Error al crear la categoría: " . $_conexion->error . "</p>";
            }
        }
    }
    ?>

    <form class="col-3" action="nueva_categoria.php" method="post">
        <div class="mb-3">
            <label class="form-label" for="categoria">Categoría:</label>
            <input class="form-control" type="text" name="categoria">  
            <?php if (isset($err_categoria)) echo "<span class='error'>$err_categoria</span>"; ?>     
        </div>

        <div class="mb-3">
            <label class="form-label" for="descripcion">Descripción:</label>
            <textarea class="form-control" name="descripcion" rows="4" cols="50"></textarea>
            <?php if (isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>"; ?>
        </div>

        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Insertar">
            <a class="btn btn-secondary" href="index.php">Volver</a>
        </div>
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
