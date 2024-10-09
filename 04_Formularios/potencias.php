<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <form action="" method="post">
        <label for="base">Base</label>
        <input type="text" name="base" id="base" placeholder="Introduzca la base">
        <br>
        <label for="exponente">Exponente</label>
        <input type="text" name="exponente" id="exponente" placeholder="Introduzca el exponente">
        <input type="submit" value="calcular">
    </form>
    <?php
        /* 
        crear un formulario que reciba dos parametros: base y exponente
        cuando se envíe el formulario,se calculará el resultado de elevar
        la base al exponente

        EJEMPLO:
        2 elevado a 3 = 8 =>2x2x2 = 8
        3 elevado a 2 = 9 => 3x3 = 9
        3 elevando a 0 = 1
        2 elevado a 1 = 2
        */
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $base = $_POST["base"];
            $exponente = $_POST["exponente"];
            $total= 1;
            for($i = 0;$i < $exponente; $i++){
                $total *= $base;
            }            
            echo "<h1>$total</h1>";
        }

    ?>
</body>
</html>