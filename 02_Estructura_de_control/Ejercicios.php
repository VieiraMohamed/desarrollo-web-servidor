<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
    <!-- estas lineas de abajo son para que salgan en el navegeador los fallos -->
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <!-- EJERCICIO 1: CALCULA LA SUMA DE TODOS LOS NÚMEROS PARES DEL 1 A 20 -->
     


    <!-- EJERCICIO 2:MOSTRAR LA FECHA ACTUAL CON EL SIGUIENTE FORMATO:
     Viernes 27 de Septiembre 2024
     UTILIZAR LAS ESTRUCTURAS DE CONTROL NECESARIAS -->
     <?php
        /* $dia_semana = date("l");

        $dia_semana = match ($dia_semana) {
            "Monday" => "Lunes",
            "Tuesday" => "Martes",
            "Wednesday" => "Miércoles",
            "Thursday" => "Jueves",
            "Friday" => "Viernes",
            "Saturday" => "Sabado",
            "Sunday" => "Domingo"
        };

        $mes = date("F");
        $mes = match ($mes) {
            "January" => "Lunes",
            "February" => "Martes",
            "March" => "Miércoles",
            "April" => "Jueves",
            "Mayo" => "Viernes",
            "Junio" => "Sabado",
            "Julio" => "Domingo",
            "August" => "Agosto",
            "September" => "Septiembre",
            "October" => "Octubre",
            "November" => "Noviembre",
            "December" => "Diciembre"
        };
        
        $dia = date("j");
        
        $ano = date("Y");

        
        echo "<p>$dia_semana $dia de $mes de $ano</p>";
         */
          /* EJERCICIO 2: MOSTRAR EN UNA LISTA LOS NUMEROS MULTIPLOS
        DE 3 USANDO WHILE E IF */

        echo "EJERCICIO 2";
        $i = 1;
        echo "<ul>";
        while($i <= 100){
            if($i % 3 == 0){
                echo "<li>$i</li>";
            }
            $i++;
        }
        echo "</ul>";
        /* EJERCICIO 3: CALCULAR LA SUMA DE LOS NUMEROS PARES ENTRE 1 Y 20 */
        echo "EJERCICIO 3 <br>";
        $count = 1;
        $suma = null;
        echo "La suma de los numeros pares entre 1 y 20 es: ";
        while($count <= 20){
            if($count % 2 == 0){
                $suma =$suma+$count;
            }
            $count++;
        }
        echo "$suma<br>";
    
     ?>
     
     <?php
      

       /*  EJERCICIO 4: CALCULAR EL FACTORIAL DE 6 CON WHILE  */
       echo "<br>Ejercicio 4";

       $contador = 1;
        $total = 1;
       while($contador <= 6){
        $total *= $contador;
        $contador++;
       }
       echo "<br>El factorial de 6 es: $total<br>"

     ?>

     <?php 
        echo "<br> RECURSIVO";
        function factorial($numero){
            if($numero <= 1){
                return 1;
            }
            return $numero * factorial($numero-1);
        }
        echo "<br>El factorial de 6 es:".factorial(6);
     ?>
     
     
</body>
</html>