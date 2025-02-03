<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Pokemon API</title>
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
</head>
<body class="text-center">
<div>
    <h1>Pokemon API</h1>
    <form action="" method="GET" class="mb-4">
        <div>
            <label for="pokemon">Selecciona un Pokémon:</label>
            <select name="pokemon" id="pokemon">
                <option value="" selected disabled>-- Selecciona un Pokémon --</option>
                <?php
                $apiURL = "https://pokeapi.co/api/v2/pokemon/?offset=0&limit=1000";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiURL);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $respuesta = curl_exec($curl);
                curl_close($curl);

                $pokemonData = json_decode($respuesta, true);
                foreach ($pokemonData['results'] as $pokemonItem) {
                    $pokemonName = $pokemonItem['name'];
                    echo "<option value=\"$pokemonName\" " . (isset($_GET["pokemon"]) && $_GET["pokemon"] == $pokemonName ? 'selected' : '') . ">$pokemonName</option>";
                }
                ?>
            </select>
            <button type="submit">Mostrar Pokemon</button>
        </div>

        <?php
        if (isset($_GET["pokemon"]) && !empty($_GET["pokemon"])) {
            $pokemonElegido = $_GET["pokemon"];

            $apiURL = "https://pokeapi.co/api/v2/pokemon/$pokemonElegido";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $pokemonData = json_decode($respuesta, true);

            if (isset($pokemonData['id'])) {
                $name = $pokemonData['name'];
                $urlImage = $pokemonData['sprites']['other']['official-artwork']['front_default'] ?? 'https://via.placeholder.com/150';
                $height = ($pokemonData['height'] / 10); // Convertir a metros
                $weight = ($pokemonData['weight'] / 1000); // Convertir a kilogramos

            ?>
            <div class="container text-center">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Altura</th>
                            <th scope="col">Peso</th>
                            <th scope="col">Tipos</th>
                            <th scope="col">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo "<p>$name</p>"; ?></td>
                            <td><?php echo "<p>$height m</p>"; ?></td>
                            <td><?php echo "<p>$weight kg</p>"; ?></td>
                            <td>
                                <ul style="list-style-type: none;"> 
                                        <?php 
                                            // Mostrar tipos
                                                foreach ($pokemonData['types'] as $type) {
                                                    echo "<li>".$type['type']['name']."</li>";
                                                }
                                            } else {
                                                echo "No se pudo obtener la información del Pokémon.";
                                            }
                                        ?>
                                </ul>
                            </td>
                            <td><?php echo "<img src=\"$urlImage\" alt=\"Imagen de $name\" style=\"width: 100px;\">"; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
                
                
                
                

                
        }
        ?>
        
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
