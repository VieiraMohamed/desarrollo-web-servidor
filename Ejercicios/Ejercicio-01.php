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
    
    <form action="" method="post">
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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $numero1 = $_POST["numero1"];
            $numero2 = $_POST["numero2"];
            $numero3 = $_POST["numero3"];

            $mayor = max($numero1,$numero2,$numero3);
            echo "<p>El numero mayor es $mayor </p>";
        }
    ?>
</body>
</html>