<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salario Impuestos</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        
        require('../05_funciones/irpf.php');//esto es para importar
    ?>
</head>
<body>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(isset($_POST["sueldo"])){
                $tmp_sueldo = $_POST["sueldo"];
            }
            else{
                $tmp_sueldo ="";
            }

            
            $tmp_sueldo = $_POST["sueldo"];
            $resultado = "";

            if($tmp_sueldo ==""){
                    $err_sueldo=" El sueldo es obligatorio";
            }else{
                if(filter_var($tmp_sueldo,FILTER_VALIDATE_FLOAT) === FALSE){
                    $err_sueldo= "El sueldo debe ser un número";
                }else{
                    if($tmp_sueldo < 0){
                        $err_sueldo= "El sueldo debe ser mayor o igual a cero";
                    }else{
                        $sueldo = $tmp_sueldo;
                    }
                }
            }
            
                
            
        }
        
    ?>
    <form action="" method="post">
    <label for="sueldo" >Sueldo</label>
    <input type="text" name="sueldo" id="sueldo">
    <?php if(isset($err_sueldo)) echo "<span class='error'>$err_sueldo</span>"; ?>
    <br><br>
    <input type="submit" value="Calcular">
    </form>
    <?php
        if(isset($sueldo)){
            $resultado = calcularIrpf($sueldo);
            echo "<h1>Tu sueldo es: $sueldo y después de robarte hacienda te queda $resultado </h1>";
        }
    ?>

</body>
</html>