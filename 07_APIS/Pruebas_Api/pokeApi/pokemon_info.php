<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Información del Pokémon</title>
    <?php error_reporting(E_ALL); ini_set("display_errors", 1); ?>
</head>

<body class="text-center">

    <div>
        <h1>Información del Pokémon</h1>

        <?php
        // Obtener el nombre del Pokémon desde el parámetro GET
        if (isset($_GET['pokemon']) && !empty($_GET['pokemon'])) {
            $pokemonName = $_GET['pokemon'];

            // URL de la API para obtener los detalles del Pokémon
            $apiURL = "https://pokeapi.co/api/v2/pokemon/$pokemonName";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            // Decodificar la respuesta JSON
            $pokemonData = json_decode($respuesta, true);

            if (isset($pokemonData['id'])) {
                $name = $pokemonData['name'];
                $urlImage = $pokemonData['sprites']['other']['official-artwork']['front_default'] ?? 'https://via.placeholder.com/150';
                $height = ($pokemonData['height'] / 10); // Convertir a metros
                $weight = ($pokemonData['weight'] / 1000); // Convertir a kilogramos
                $types = array_map(function ($type) {
                    return ucfirst($type['type']['name']);
                }, $pokemonData['types']);
                $typesList = implode(', ', $types);

                // Estadísticas del Pokémon
                $stats = [];
                foreach ($pokemonData['stats'] as $stat) {
                    $stats[] = ucfirst($stat['stat']['name']) . ": " . $stat['base_stat'];
                }
                $statsList = implode('<br>', $stats);

                // Habilidades del Pokémon
                $abilities = array_map(function ($ability) {
                    return ucfirst($ability['ability']['name']);
                }, $pokemonData['abilities']);
                $abilitiesList = implode(', ', $abilities);
            } else {
                echo "<p>No se pudo obtener la información del Pokémon.</p>";
            }
        } else {
            echo "<p>No se ha seleccionado ningún Pokémon.</p>";
        }
        ?>

        <?php if (isset($pokemonData['id'])): ?>
        <div class="container text-center">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Campo</th>
                        <th scope="col">Información</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Nombre</strong></td>
                        <td><?php echo ucfirst($name); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Altura</strong></td>
                        <td><?php echo "$height m"; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Peso</strong></td>
                        <td><?php echo "$weight kg"; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tipos</strong></td>
                        <td><?php echo $typesList; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Habilidades</strong></td>
                        <td><?php echo $abilitiesList; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Estadísticas</strong></td>
                        <td><?php echo $statsList; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Imagen</strong></td>
                        <td><img src="<?php echo $urlImage; ?>" alt="Imagen de <?php echo $name; ?>" style="width: 200px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <a href="pokemon_index.php" class="btn btn-secondary">Volver a la lista</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
