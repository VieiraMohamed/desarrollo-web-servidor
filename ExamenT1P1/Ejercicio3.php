<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="numero">
        <select name="opcion" id="opcion">
            <option value="sumatorio">Sumatorio</option>
            <option value="factorial">Factorial</option>
        </select>
        <input type ="submit" value="Calcular">
    </form>
    <?php

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $numero = $_POST["numero"];
            $opcion = $_POST["opcion"];
            $resultado = 1;
            $contador = 1;
            $total = 1;
            if($opcion == "sumatorio"){
                for($i = 1; $i <= $numero;$i++){
                    $resultado += $i;
                }
                echo "<p>El sumatorio de todos los numeros es : $resultado</p>";
            }
            elseif($opcion == "factorial"){
                while($contador <= $numero){
                    $total *= $contador;
                    $contador++;
                }
                echo "<p>El factorial es: $total</p>";
            }
        }

    ?>
</body>
</html>