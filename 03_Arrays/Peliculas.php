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
        $nuevo_pelicula=["Blow","Drama",2004,];//crear un nuevo registro para meter en el array
        array_push($peliculas,$nuevo_pelicula);

        for($i =0;$i< count($peliculas);$i++){
            $peliculas[$i][3] = rand(30,240);
            if($peliculas[$i][3]< 60){
                $peliculas[$i][4]= "Cortometraje";
            }else{
                $peliculas[$i][4]= "Largometraje";
            }
        }

        /* 
            1.AÑADIR CON UN RAND, LA DURACIÓN DE CADA PELICULA.
            LA DURACIÓN SERÁ UN NÚMERO ENTRE 30 Y 240 SEGUNDOS

            2.AÑADIRCOMO UNA NUEVA COLUMNA , EL TIPO DE PELÍCULA
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
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($peliculas as $pelicula){
                list($titulo,$genero,$año,$duracion) = $pelicula;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$genero</td>";
                echo "<td>$año</td>";
                echo "<td>$duracion</td>";
                echo"</tr>";
            };
        ?>
    </tbody>
    </table>
        
            <br><br>
    <table>
        <thead>
            <tr>
                <th>Película</th>
                <th>Género</th>
                <th>Año</th>
                <th>Duración</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $_genero = array_column($peliculas, 1);
            $_anno = array_column($peliculas,2);
            $_titulo= array_column($peliculas,0);

            array_multisort($_genero,SORT_ASC,$_anno, SORT_DESC,$_titulo,SORT_ASC,$peliculas);

            foreach($peliculas as $pelicula){
                list($titulo,$genero,$año,$duracion,$tipo) = $pelicula;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$genero</td>";
                echo "<td>$año</td>";
                echo "<td>$duracion</td>";
                echo "<td>$tipo</td>";
                echo"</tr>";
            };
        ?>
        </tbody>
    </table>
    
    
</body>
</html>