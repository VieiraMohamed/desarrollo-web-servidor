<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <!-- EJERCICIO 3: Realiza un formulario que reciba dos números y devuelva todos los números primos dentro de ese rango (incluidos los extremos). -->
    <h1>Ejercicio 3 números primos</h1>
    <form action="" method="post">
        <label for="num">Primer numero</label>
        <input type="text" name="num">
        <br>
        <label for="num2">Segundo numero</label>
        <input type="text" name="num2">
        <br>
        <input type="submit" value="Calcular">
        <br>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $num = $_POST["num"];
            $num2 = $_POST["num2"];
            
            if($num !="" && $num2 != ""){

            
                echo "<p>Los números primos entre $num y $num2 son :</p>";
                echo "<ul>";

                $count = 0;
                for($i = $num; $i <= $num2; $i++){
                    for($j = 1; $j <= $i; $j++){
                        if($i % $j == 0){
                            $count++;
                        
                        }
                    }
                    if($count == 2){
                        echo "<p>$i</p>";
                    }
                    $count = 0;  
                }
                echo "</ul>";
            }else{
                echo "<h3>Faltan datos</h3>";
            }
        }
    ?>
</body>
</html>