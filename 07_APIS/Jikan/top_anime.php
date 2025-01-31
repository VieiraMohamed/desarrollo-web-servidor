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
        if(!isset($_GET["type"])){
            $type = "";
        }else{
            $type = $_GET["type"];
        }

        if(isset($_GET["page"])){
            $page = $_GET["page"];
            if($page < 1){
                $page = 1;
            }
        }else{
            $page = 1;
        }
        
        $apiURL = "https://api.jikan.moe/v4/top/anime?page=$page&type=$type";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $animes = $datos["data"];

        $paginas = $datos["pagination"];
        $totalPaginas = $paginas["last_visible_page"];
        $paginaActual = $paginas["current_page"];
        $siguientePagina =($paginaActual+1);
        $paginaAnterior = ($paginaActual-1);
    ?>

    <form action="" method="GET">
        <input type="radio" id="radio1" name="type" value="tv" <?php echo $type == 'tv' ? 'checked' : ''; ?>>
        <label for="radio1">Series</label>
        
        <input type="radio" id="radio2" name="type" value="movie" <?php echo $type == 'movie' ? 'checked' : ''; ?>>
        <label for="radio2">Películas</label>
        
        <input type="radio" id="radio3" name="type" value="" <?php echo $type == '' ? 'checked' : ''; ?>>
        <label for="radio3">Todo</label>
        <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
    </form>

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

    <div class="d-flex justify-content-between">
        <?php if($paginaActual > 1){ ?>
            <a href="?page=<?php echo $paginaAnterior ?>&type=<?php echo $type ?>" class="btn btn-primary">Anterior</a>
        <?php } ?>
        <?php if($paginaActual < $totalPaginas){ ?>
            <a href="?page=<?php echo $siguientePagina ?>&type=<?php echo $type ?>" class="btn btn-primary">Siguiente</a>
        <?php } ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


<!-- en top_anime.php
  mostrar en una tabla :
  -titulo del anime
  -nota
  -imagen-->


  <!-- en top_anime.php:
   -radiobutto con tres opciones:
   --serie
   --película
   --todos
   
   por defecto salen todos.si type= (cadena vacia), salen todos
   
   hacerlo todo con el metodo GET
   $tipo = $_GET["tipo"]
   "https://api.jikan.moe/v4/top/anime?type=$tipo"
   -----------------------------------
   abajo de la página dos botones o enlaces
   "Anterior" y "Siguiente"

   -Si se hace con enlaces (a href),añadimos detras de la url ?page=loquesea

   -Al principio del código preguntamos cuál es la página
   que nos da la url, y la añadimos a la url de la api

   $page = $_GET["page"]
   "https://api.jikan.moe/v4/top/anime?page?$page"
   -->