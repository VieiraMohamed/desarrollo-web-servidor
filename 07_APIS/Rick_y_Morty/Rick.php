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
    <title>Api Rick y Morty</title>
</head>
<body>
    <!-- api --   https://rickandmortyapi.com/documentation/  -->
    <?php
        $cantidad = isset($_GET["cantidad"]) ? (int)$_GET["cantidad"] : 10; // Valor predeterminado de 10
        $genero = isset($_GET["genero"]) ? $_GET["genero"] : '';
        $especie = isset($_GET["especie"]) ? $_GET["especie"] : '';

        $apiURL = "https://rickandmortyapi.com/api/character";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $personajes = $datos["results"];

        // Filtrar personajes por género y especie si se han especificado
        $personajesFiltrados = array_filter($personajes, function($personaje) use ($genero, $especie) {
            $filtraGenero = $genero ? $personaje["gender"] == $genero : true;
            $filtraEspecie = $especie ? $personaje["species"] == $especie : true;
            return $filtraGenero && $filtraEspecie;
        });

        // Limitar la cantidad de personajes mostrados
        $personajesFiltrados = array_slice($personajesFiltrados, 0, $cantidad);
    ?>

    <form action="" method="GET">
        <label for="cantidad">Cantidad: </label>
        <input type="number" name="cantidad" placeholder="Escribe un número">
        <br>
        <label for="genero">Género: </label>
        <select name="genero" id="genero">
            <option value="" disabled selected>--Elige una opción--</option>
            <option value="Female">Female</option>
            <option value="Male">Male</option>
        </select>
        <br>
        <label for="especie">Especie: </label>
        <select name="especie" id="especie">
            <option value="" disabled selected>--Elige una opción--</option>
            <option value="Human">Human</option>
            <option value="Alien">Alien</option>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
    </form>

    <h1>Personajes de Rick y Morty</h1>
    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Género</th>
                <th scope="col">Especie</th>
                <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personajesFiltrados as $personaje) { ?>
                <tr>
                    <td><?php echo $personaje["name"]; ?></td>
                    <td><?php echo $personaje["gender"]; ?></td>
                    <td><?php echo $personaje["species"]; ?></td>
                    <td><img src="<?php echo $personaje["image"]; ?>" alt="<?php echo $personaje["name"]; ?>" style="width: 100px;"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
