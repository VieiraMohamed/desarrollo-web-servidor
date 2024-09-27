<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
</head>
<body>
    <!-- EJERCICIO 1: CALCULA LA SUMA DE TODOS LOS NÚMEROS PARES DEL 1 A 20 -->
     


    <!-- EJERCICIO 2:MOSTRAR LA FECHA ACTUAL CON EL SIGUIENTE FORMATO:
     Viernes 27 de Septiembre 2024
     UTILIZAR LAS ESTRUCTURAS DE CONTROL NECESARIAS -->
     <?php
        $dia_semana = date("l");

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
        
     ?>

     <!-- 
        EJERCICIO 2: MOSTRAR EN UNA LISTA LOS NUMEROS MULTIPLOS
        DE 3 USANDO WHILE E IF

        EJERCICIO 3: CALCULAR LA SUMA DE LOS NUMEROS PARES ENTRE 1 Y 20


        EJERCICIO 4: CALCULAR EL FACTORIAL DE 6 CON WHILE
    -->
</body>
</html>