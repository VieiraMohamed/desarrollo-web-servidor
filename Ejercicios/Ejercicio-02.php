<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h1>Ejercicio 2</h1>
    <!-- EJERCICIO 2: Realiza un formulario que reciba 3 números: a, b y c. Se mostrarán en una lista los múltiplos de c que se encuentren entre a y b. -->
     <!-- 
    Por ejemplo, si a = 3, b = 10, c = 2
    Los múltiplos de 2 entre 3 y 10 son: 4, 6, 8 y 10 -->
    <form action="" method="post">
        <label for="num_A">Número A</label>
        <input type="text" name="num_A">
        <br>
        <label for="num_B">Número B</label>
        <input type="text" name="num_B">
        <br>
        <label for="num_C">Número C</label>
        <input type="text" name="num_C">
        <br>
        <input type="submit" value="Calcular">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $num_A = $_POST["num_A"];
            $num_B = $_POST["num_B"];
            $num_C = $_POST["num_C"];

            for($i = $num_A; $i <= $num_B; $i++){
                if($i % $num_C == 0){
                    $multiplos [] = $i;
                }
            }
            echo "Los multiplos de $num_C entre $num_A y $num_B son ";
            echo "<ul>";
            foreach($multiplos as $multiplo){
                echo "<li>$multiplo</li>";
            }
            echo "</ul>";
        }
    ?>
</body>
</html>