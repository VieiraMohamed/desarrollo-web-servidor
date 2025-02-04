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
        <h1>Pokemon API</h1>

        <?php
        // Paginación
        $limit = 5; // Número de Pokémon por página
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Offset para la página actual

        // URL de la API con paginación
        $apiURL = "https://pokeapi.co/api/v2/pokemon?offset=$offset&limit=$limit";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);
        $pokemonData = json_decode($respuesta, true);
        $totalPokemon = $pokemonData['count']; // Total de Pokémon en la API
        $pokemonList = $pokemonData['results']; // Los Pokémon de la página actual

        // Calcular si hay una página anterior y siguiente
        $previousOffset = max(0, $offset - $limit);
        $nextOffset = min($totalPokemon - $limit, $offset + $limit);
        ?>

        <p>Total de Pokémon disponibles: <?php echo $totalPokemon; ?></p>

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
                    <?php
                    // Mostrar los Pokémon de la página actual
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
                            $urlImage = $pokemonDetail['sprites']['other']['official-artwork']['front_default'] ?? 'https://via.placeholder.com/150';
                            $height = ($pokemonDetail['height'] / 10); // Convertir a metros
                            $weight = ($pokemonDetail['weight'] / 1000); // Convertir a kilogramos
                            ?>

                            <tr>
                                <td><?php echo ucfirst($name); ?></td>
                                <td><?php echo "$height m"; ?></td>
                                <td><?php echo "$weight kg"; ?></td>
                                <td>
                                    <ul style="list-style-type: none;">
                                        <?php
                                        // Mostrar tipos
                                        foreach ($pokemonDetail['types'] as $type) {
                                            echo "<li>" . ucfirst($type['type']['name']) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <a href="pokemon_info.php?pokemon=<?php echo $name; ?>">
                                        <img src="<?php echo $urlImage; ?>" alt="Imagen de <?php echo $name; ?>" style="width: 100px;">
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
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
