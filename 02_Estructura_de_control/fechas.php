<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas</title>
</head>
<body>
    <?php
        $numero = "2";
        $numero = (int) $numero;
        if($numero !== 2){
            echo "<p>EXITO</p>";
        }
        else{
            echo "<p>NO EXITO</p>";
        }
        /* 
            "2" == 2  -->"2" es igual a 2           TRUE
            "2" !== 2  -->"2" no es idéntico a 2    TRUE
            2 === 2  -->2 si es idéntico a 2        TRUE
            2 !== 2.0 --> 2 no es idéntico a 2.0    TRUE
        */

        $hora = (int) date("G");
        //var_dump($hora); la instucción var_dump sirve para depurar y obtener información de la variable

        /* 
            SI $hora es entre 6 y 11 ,es mañana
            SI $hora es entre 12 y 14 es medio dia
            SI $hora es entre 15 y 20 es tarde
            SI $hora es entre 20 y 0 es noche
            SI $hora es entre 1 y 5 es madrugada
        */
        if($hora >=6 and $hora <=11) echo "<p>Es de mañana</p>";
        elseif($hora >11 and $hora <= 14) echo "<p>Es medio día</p>";
        elseif($hora >14 and $hora <= 20) echo "<p>Es de tarde</p>";
        elseif($hora >20 and $hora <= 0) echo "<p>Es de noche</p>";
        elseif($hora > 0 and $hora <= 5) echo "<p> Es de madrugada</p>";

        $hora_exacta = date("H:i:s");
        echo "<p>La hora exata es $hora_exacta</p>";

        $dia = date("l");

        //echo "<h2> hoy es $dia</h2>";
        /* 
            TENEM,OS CLASE LUNES,MIERCOLESY VIERNES
            NO TENEMOS CLASE EL RESTO

            HACER UN SWITCH QUE DIGA SI HOY TENEMOS CLASE
        */
       /*  switch($dia){
            case "Monday":
                echo "<p>Hoy lunes tenemos clase";
                break;
            case "Wednesday":
                echo "<p>Hoy es miercoles y tenemos clase</p>";
                break;
            case "Friday":
                echo "<p>Hoy es viernes y tenemos clase</p>";
                break;
            default:
            echo "<p>Hoy es $dia y no tenemos clase</p>";
        } */
        /* version abreviada del SWICH de arriba */
        switch($dia){
            case "Monday":               
            case "Wednesday":               
            case "Friday":
                echo "<p>Hoy es $dia y tenemos clase</p>";
                break;
            default:
            echo "<p>Hoy es $dia y no tenemos clase</p>";
        }/* 
            CON LA ESTRUCTURA SWITCH CAMBIAR LA VARIABLE DIA A ESPAÑOL DENTRO DE CADA CASO
            $dia = lunes, si es lunes $dia = miercoles, si es miercoles y asi con todo
        */
    ?>
</body>
</html>