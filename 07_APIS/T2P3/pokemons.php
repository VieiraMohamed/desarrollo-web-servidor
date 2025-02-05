<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pokemon API</title>
    <?php error_reporting(E_ALL); ini_set("display_errors", 1); ?>
</head>

<body class="text-center">

    <div>
        <form action="" name="cantidad" method="GET">
            <label for="">¿Cuántos pokémons quieres mostrar?</label>
            <input type="number" name="cantidad" >
            <button type="submit">Mostrar</button>
        </form>

        <?php
       
        if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["cantidad"])){
            $limit= $_GET["cantidad"];
        }
        else{
            $limit = 5;
        }
        
        if($offset = isset($_GET['offset']) ){
            $offset = intval($_GET['offset']);
        }else{
            $offset = 0;
        }
 
       

        

        $apiURL = "https://pokeapi.co/api/v2/pokemon?offset=$offset&limit=$limit";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);
        $pokemonData = json_decode($respuesta, true);
        $totalPokemon = $pokemonData['count'];
        $pokemonList = $pokemonData['results']; 

    
        $previousOffset = max(0, $offset - $limit);
       
        $nextOffset = min($totalPokemon - $limit, $offset + $limit);
      
        
        
        ?>

        <div class="container text-center">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipos</th>
                        <th scope="col">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pokemonList as $pokemonItem) {
                        $pokemonName = $pokemonItem['name'];
                        $apiURL = "https://pokeapi.co/api/v2/pokemon/$pokemonName";
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, $apiURL);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $respuesta = curl_exec($curl);
                        curl_close($curl);
                        $pokemonDetail = json_decode($respuesta, true);

                        if (isset($pokemonDetail['id'])) {
                            $name = $pokemonDetail['name'];
                            $urlImage = $pokemonDetail['sprites']['other']['official-artwork']['front_default'];
                            ?>

                            <tr>
                                <td><?php echo ucfirst($name); ?></td>
                                <td>
                                        <?php
                                        foreach ($pokemonDetail['types'] as $type) {
                                            echo  ucfirst($type['type']['name']) . " ";
                                        }
                                        ?>
                                </td>
                                <td>
                                        <img src="<?php echo $urlImage; ?>" alt="Imagen de <?php echo $name; ?>" style="width: 100px;">
                                </td>
                            </tr>

                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-6 text-start">
                    <?php if ($offset > 0) { ?>
                        <a href="?offset=<?php echo $previousOffset; ?>" class="btn btn-primary">Anterior</a>
                    <?php } ?>
                </div>
                <div class="col-6 text-end">
                    <?php if ($nextOffset < $totalPokemon) { ?>
                        <a href="?offset=<?php echo $nextOffset; ?>" class="btn btn-primary">Siguiente</a>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
