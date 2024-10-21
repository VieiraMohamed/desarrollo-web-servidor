<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <!-- EJERCICIO 1: Realiza un formulario que reciba 3 números y devuelva el mayor de ellos. -->
    
    <form action="" method="get">
        <label for="numero1">Número 1</label>
        <input type="text" name="numero1">
        <br>
        <label for="numero2">Número 2</label>
        <input type="ntext" name="numero2">
        <br>
        <label for="numero3">Número 3</label>
        <input type="text" name="numero3">
        <br>
        <input type="submit" value="Calcular">
    </form>

    <?php
        if(isset($_GET["numero1"]) and isset($_GET["numero2"]) and isset($_GET["numero3"])){
            $numero1 = $_GET["numero1"];
            $numero2 = $_GET["numero2"];
            $numero3 = $_GET["numero3"];

            if($numero1 != "" && $numero2 !="" && $numero3 !=""){

            
                $mayor = $numero1;
                if($numero2 > $mayor){
                    $mayor = $numero2;
                }
                if($numero3 > $mayor){
                    $mayor = $numero3;
                }
                echo "<p>El numero mayor es $mayor </p>";
            }else{
                echo "<h3>Faltan datos</h3>";
            }
        }
    ?>
</body>
</html>