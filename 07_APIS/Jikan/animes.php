<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
    <title>Anime</title>
</head>
<body>
<div class="container">
    <?php
    if(!isset($_GET["id"])){
        header("location: top_anime.php");
    }
        $id=$_GET["id"];
        $apiURL = "https://api.jikan.moe/v4/anime/$id/full";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $anime = $datos["data"];
        //print_r($animes)
    ?>
   




<table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Puntuación</th>
                <th scope="col">Sipnosis</th>
                <th scope="col">Lista de géneros</th>
                <th scope="col">Trailer</th>
                <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>           
                <tr>
                    <td>
                        <?php echo $anime["title"] ?>                       
                    </td>
                    <td>
                        <?php echo $anime["score"] ?>
                    </td>
                    <td>
                        <?php echo $anime["synopsis"] ?>
                    </td>
                    <td>
                        <ul>
                            <?php foreach($anime["genres"] as $genre) { ?>
                                <li><?php echo $genre["name"]; ?></li>
                            <?php } ?>
                        </ul>
                    </td>
                    
                    <td>                
                        <iframe width="400" height="200" src="<?php echo $anime["trailer"]["embed_url"]; ?>" ></iframe></td>                   
                    <td>
                        <img src="<?php echo $anime["images"]["jpg"]["image_url"] ?>" alt="<?php echo $anime["title"] ?>" style="width: 100px;">
                    </td>
                </tr>       
        </tbody>
    </table>

    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Títulos relacionados</th>               
            </tr>
        </thead>
        <tbody>           
                <tr>                  
                    <td>
                        <ul>
                            <?php foreach($anime["relations"] as $relation ){ ?>
                                <?php foreach($relation["entry"] as $relacion) {
                                    if($relacion["type"] == "anime"){?>
                                <li><a href="animes.php?id=<?php echo $relacion["mal_id"] ?>"><?php echo $relacion["type"].":".$relacion["name"]; ?></a></li>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>

                        </ul>
                    </td>
                </tr>       
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<!-- anime.php
 mostrar
 -titulo
 -nota
 -sipnosis
 -lista generos
 -trailer buscar el video embebido  hecho todo
 lista de animes relacionos.solo el nombre del anime.
 solo se mostrara los relacionas que sean dr type anime   todo hecho
 
 mas cosas
 AHORA VAMOS A:

Añadir a los animes una lista con los productores de la serie.
 Los productores son las empresas encargadas en producir el anime.

Una vez hecha la lista, mostraremos en un archivo productor.php 
el nombre por defecto del productor, su imagen y la información 
sobre el productor que nos provee la api (about)-->