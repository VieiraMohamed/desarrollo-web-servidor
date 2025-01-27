<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
</head>
<body>
<div class="container">
    <h1>Top Anime</h1>
    <?php
        $apiURL = "https://api.jikan.moe/v4/top/anime";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $animes = $datos["data"];
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Puntuación</th>
                <th scope="col">Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($animes as $anime) { ?>
                <tr>
                    <td>
                        <a href="animes.php?id=<?php echo $anime["mal_id"] ?>">
                        <?php echo $anime["title"] ?>
                        </a>
                    </td>
                    <td><?php echo $anime["score"] ?></td>
                    <td><img src="<?php echo $anime["images"]["jpg"]["image_url"] ?>" alt="<?php echo $anime["title"] ?>" style="width: 100px;"></td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<!-- en top_anime.php
  mostrar en una tabla :
  -titulo del anime
  -nota
  -imagen-->