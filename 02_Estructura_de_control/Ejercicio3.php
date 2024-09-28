<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
<?php
        /* EJERCICIO 3: CALCULAR LA SUMA DE LOS NUMEROS PARES ENTRE 1 Y 20 */

        $i = 1;
        $suma = null;

        while($i <= 20){
            if ($i % 2 == 0){
                
                echo "La suma de los numeros pares entre 1 y 20 es: $suma";
            }
        }
     ?>
</body>
</html>