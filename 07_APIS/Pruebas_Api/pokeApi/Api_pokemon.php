<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon API</title>
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
</head>
<body>
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

                echo "<h2>$name</h2>";
                echo "<img src=\"$urlImage\" alt=\"Imagen de $name\" style=\"width: 300px;\">";
                echo "<p>Altura: $height metros</p>";
                echo "<p>Peso: $weight kilogramos</p>";

                // Mostrar tipos
                echo "<h3>Tipo(s):</h3>";
                foreach ($pokemonData['types'] as $type) {
                    echo "<p>" . $type['type']['name'] . "</p>";
                }
            } else {
                echo "No se pudo obtener la información del Pokémon.";
            }
        }
        ?>
        <button type="submit">Mostrar Pokemon</button>
    </form>
</div>
</body>
</html>
