<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays bidimencionales</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <?php

        $array =[1,2,3,4];//Array normal

        $videoJuegos=[//Array bidimensional
            ["Disco Elysium", "RPG", 9.99],
            ["Drabos Ball Z Kakarot","Acción", 59.99],
            ["Persona 3", "RPG", 24.99],
            ["Commando 2", "Estrategia", 4.99],
            ["Hollow Knight", "Metroidvania", 9.99],
            ["Stardew Valley", "Gestión de reccursos", 7.99 ]

        ];
        $nuevo_videojuego=["Octopath Traveler","RPG",29.95];//crear un nuevo registro para meter en el array
        array_push($videoJuegos,$nuevo_videojuego);//manera de añadir otro juego al array

        array_push($videoJuegos,["Ender Lilies","Metroidvania",9.95]);//Otra manera de añadir al array
        //unset($videoJuegos[3]);//borra ese registro,pero desaparece ese indice
        //print_r($videoJuegos);//para mostrar el array
        $videoJuegos = array_values($videoJuegos);//reorganiza los indices del array
        //print_r($videoJuegos);
        array_push($videoJuegos,["Dota 2","MOBA",0]);
        array_push($videoJuegos,["Fall Guys","Plataforma",0]);
        array_push($videoJuegos,["Rocket League","MOBA",0]);
        array_push($videoJuegos,["Lego Fornite","Acción",0]);

        //añadir otra columna a la tabla y otro campo al array
        //RECUERDA AÑADIR LOS <TH></TH> Y <TD></TD> A LA  TABLA
        for($i =0;$i< count($videoJuegos);$i++){
            if($videoJuegos[$i][2]<=0){
                $videoJuegos[$i][3]= "Gratis";
            }else{
                $videoJuegos[$i][3]= "De pago";
            }
        }
        /* Esto de abajo es para ordenar las arrays bidimensionales */
        $_titulo = array_column($videoJuegos, 0);
        $_categoria = array_column($videoJuegos,1);
        $_precio = array_column($videoJuegos,2);

        array_multisort($_categoria,SORT_ASC,$_precio, SORT_DESC,$videoJuegos);// SORT_DESC si fuera descendiente
        /* ------------------------------------------------- */
    ?>
    <!-- vamos a recorrer el array bidimensional -->
     <table>
        <thead>
            <tr>
                <th>Videojuego</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($videoJuegos as $videojuego){
                    //print_r($videojuego);
                    //echo $videojuego[0]; asi tambien podemos sacar las columnas
                    //echo "<br><br>";
                    list($titulo,$categoria, $precio,$f2p)= $videojuego;
                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$categoria</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$f2p</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
     </table>

    
</body>
</html>