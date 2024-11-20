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

        
        echo "<p>";
        for($i = 0;$i < 5;$i++){
            echo $array1[$i].",";
        }
        echo "</p>";
        echo "<p>";
        for($i = 0;$i < 5;$i++){
            echo $array2[$i].",";
        }
        echo "</p>";

        //maximo
        $maximo = $array1[0];
        for($i = 0;$i < 5;$i++){
            if($array1[$i] > $maximo){
                $maximo = $array1[$i];
            }
        }
        echo "<p>Maximo del array1: $maximo</p>";
        
        //minimo
        $minimo = $array1[0];
        for($i = 0;$i < 5;$i++){
            if($array1[$i] < $minimo){
                $minimo = $array1[$i];
            }
        }
        echo "<p>Minimo del array1: $minimo</p>";

        //suma
        $suma= 0;
        for($i = 0;$i < 5;$i++){
      
            $suma += $array1[$i];
            
        }
        $media=$suma/count($array1);
        echo "<p>La suma del array1: $suma</p>";
        echo "<p>La media del array1: $media</p>";


        //maximo
        $maximo2 = $array2[0];
        for($i = 0;$i < 5;$i++){
            if($array2[$i] > $maximo2){
                $maximo2 = $array2[$i];
            }
        }
        echo "<p>Maximo del array2: $maximo2</p>";
        
        //minimo
        $minimo2 = $array2[0];
        for($i = 0;$i < 5;$i++){
            if($array2[$i] < $minimo2){
                $minimo2 = $array2[$i];
            }
        }
        echo "<p>Minimo del array2: $minimo2</p>";

        //suma
        $suma2= 0;
        for($i = 0;$i < 5;$i++){
            $suma2 += $array2[$i];
        }
        $media2=$suma2/count($array2);
        echo "<p>La suma del array2: $suma2</p>";
        echo "<p>La media del array2: $media2</p>";

    ?>
</body>
</html>