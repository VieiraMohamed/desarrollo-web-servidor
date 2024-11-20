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
    <style>
        .error{
            color:red;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- 
    general = 21% 
    reducido = 10%
    superreducido = 4%
    10 iva = general pvp 12,1
    10 iva = reducido pvp 11
    -->
    

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["iva"])){
                $tmp_iva = $_POST["iva"];
            }
            else{
                $tmp_iva ="";
            }
            $tmp_precio = $_POST["Precio"];
            

            if($tmp_precio == ""){
                $err_precio="El precio es obligatorio";
            }else{
                if(filter_var($tmp_precio,FILTER_VALIDATE_FLOAT) === FALSE){
                    $err_precio="El precio debe ser un número";
                }else{
                    if($tmp_precio < 0){
                        $err_precio="El precio debe ser mayor o igual a cero";
                    }else{
                        $precio = $tmp_precio;
                    }
                }
            }

            if($tmp_iva == ""){
                $err_iva= "El IVA es obligatorio";
            }else{
                $valores_validos_iva = ["general","reducido","superreducido"];
                if(!in_array($tmp_iva,$valores_validos_iva)){
                    $err_iva= "El IVA solo puede ser: GENERAL, REDUCIDO, SUPERREDUCIDO";
                }else{
                    $iva = $tmp_iva;
                }
            }
            
        }
    ?>
    <form action="" method="post">
        <label for="precio">Precio</label>
        <input type="text" name="Precio">
        <?php if(isset($err_precio)) echo "<span class='error'>$err_precio</span>"; ?>
        <br>
        <select name="iva" id="iva">
            <option disabled selected hidden>--Seleciona el IVA--</option>
            <option value="general">General</option>
            <option value="reducido">Reducido</option>
            <option value="superreducido">Superreducido</option>
        </select>
        <?php if(isset($err_iva)) echo "<span class='error'>$err_iva</span>"; ?>
        <br>
        <input type="submit" value="Calcular">
    </form>
        
    <?php
        if(isset($precio) && isset($iva)){              
            echo "<h1>El PVP es ".calcularPvp($precio,$iva)."</h1>";
        }
    ?>
</body>
</html>