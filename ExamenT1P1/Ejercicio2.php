<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <?php

        $array_principal = [];
        $array1 = [];
        $array2 = [];

        for($i = 0; $i < 5; $i++){
            $array1 [$i] = rand(1,10);
            $array2 [$i] = rand(10,100);
        }

        array_push($array_principal, $array1, $array2);

        print_r($array_principal);
        echo "<br>";
        foreach($array1 as $array){
            echo "$array. ";
        }
        

    ?>
</body>
</html>