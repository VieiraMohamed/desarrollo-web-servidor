<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <?php
        $peliculas= [
            ["Kárate a muerte en Torremolinos", "Acción", 1975],
            ["Sharknado 1-5", "Acción", 2015],
            ["Princesa por sorpresa 2", "Comedia", 2008],
            ["Temblores 4", "Terror", 2018],
            ["Cariño he encogido a los niños", "Aventura", 2001],
            ["Pokemon","Aventura", 2006]
        ];

        /* 
            1.AÑADIR CON UN RAND, LA DURACIÓN DE CADA PELICULA.
            LA DURACIÓN SERÁ UN NÚMERO ENTRE 30 Y 240 SEGUNDOS

            2.AÑADIRCOMO UNA NUEVA COLUMNA , EL TIPODE PELÍCULA
            CORTOMETRAJE,SI LA DURACIÓN ES MENOR QUE 60
            LARGOMETRAJE,SI LA DURACIÓN ES MAYOR O IGUAL QUE 60

            3.MOSTRAR EN OTRA TABLA, TODAS LAS COLUMNAS , Y ORDENAR 
            ADEMÁS EN ESTE ORDEN:
            -1. GÉNERO
            -2. AÑO
            -3. TÍTULO(TODO ALFABÉTICAMENTE, Y EL AÑO DE MÁS RECIENTE A MÁS ANTIGUO)
        */

        
    ?>
    <table>
        <thead>
            <tr>
                <th>Película</th>
                <th>Género</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($peliculas as $pelicula){
                list($titulo,$genero,$año) = $pelicula;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$genero</td>";
                echo "<td>$año</td>";
                echo"</tr>";
            };
        ?>
    </tbody>
    </table>
    
    
</body>
</html>