<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <link rel="stylesheet" href="estilo.css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
<?php
     $animes = [
        ["One Piece","Aventura"],
        ["Bleach","Accion"],
        ["Dragon Ball","Aventura"],
    ];
    
    $anime_nuevo = ["Marco","Drama"];
    $anime_nuevo1 = ["Frieren","Fantasía"];
    
    array_push($animes,$anime_nuevo);
    array_push($animes,$anime_nuevo1);
    
    for($i = 0; $i < count($animes); $i++){
        $animes[$i][2] = rand(1990,2030);
        $animes[$i][3] = rand(1,99);
        if($animes[$i][2] <= 2024){
            $animes[$i][4] = "Ya disponible";
        }
        else{
            $animes[$i][4] = "Próximamente";
        }
    }
    unset($animes[0]);
    $_genero = array_column($animes, 1);
    $_anno = array_column($animes,2);
    $_titulo= array_column($animes,0);

    array_multisort($_genero,SORT_ASC,$_anno, SORT_ASC,$_titulo,SORT_ASC,$animes);
?>
 <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Género</th>
                <th>Año</th>
                <th>Episodios</th>
                <th>Disponibilidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($animes as $anime){
                    list($titulo,$genero,$anno,$episodio,$disponible) = $anime;
                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$genero</td>";
                    echo "<td>$anno</td>";
                    echo "<td>$episodio</td>";
                    echo "<td>$disponible</td>";
                    echo"</tr>";
                };
            ?>
        </tbody>
</table>
</body>
</html>