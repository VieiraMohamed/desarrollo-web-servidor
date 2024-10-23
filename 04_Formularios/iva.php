<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        
        require('../05_funciones/economia.php');//esto es para importar
    ?>
</head>
<body>
    <!-- 
    general = 21% 
    reducido = 10%
    superreducido = 4%
    10 iva = general pvp 12,1
    10 iva = reducido pvp 11
    -->
    <form action="" method="post">
        <label for="precio">Precio</label>
        <input type="text" name="Precio">
        <br>
        <select name="iva" id="iva">
            <option value="general">General</option>
            <option value="reducido">Reducido</option>
            <option value="superreducido">Superreducido</option>
        </select>
        <br>
        <input type="submit" value="Calcular">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_precio = $_POST["Precio"];
            $tmp_iva = $_POST["iva"];

            if($tmp_precio == ""){
                echo "<p>El precio es obligatorio</p>";
            }else{
                if(filter_var($tmp_precio,FILTER_VALIDATE_FLOAT) === FALSE){
                    echo "<p>El precio debe ser un número</p>";
                }else{
                    if($tmp_precio < 0){
                        echo "<p>El precio debe ser mayor o igual a cero</p>";
                    }else{
                        $precio = $tmp_precio;
                    }
                }
            }

            if($tmp_iva == ""){
                echo "<p>El IVA es obligatorio</p>";
            }else{
                $valores_validos_iva = ["general","reducido","superreducido"];
                if(!in_array($tmp_iva,$valores_validos_iva)){
                    echo "<p>El IVA solo puede ser: GENERAL, REDUCIDO, SUPERREDUCIDO</p>";
                }else{
                    $iva = $tmp_iva;
                }
            }
            if(isset($precio) && isset($iva)){              
                echo calcularPvp($precio,$iva);
            }
        }
    ?>
</body>
</html>