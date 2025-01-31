<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chistes de Chuck Norris</title>
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
</head>
<body>
<div>
    <h1>Chistes de Chuck Norris</h1>
    
    <!-- Formulario para seleccionar la categoría -->
    <form action="" method="GET">
        <div>
            <label for="category">Selecciona una categoría:</label>
            <select name="category" id="category">
                <option value="" selected disabled>-- Selecciona una categoría --</option>
                <?php
                // URL para obtener las categorías
                $apiURL = "https://api.chucknorris.io/jokes/categories";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiURL);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $respuesta = curl_exec($curl);
                curl_close($curl);

                $categorias = json_decode($respuesta, true);

                // Mostrar las categorías en el campo select
                foreach ($categorias as $categoria) {
                    echo "<option value=\"$categoria\" " . (isset($_GET["category"]) && $_GET["category"] == $categoria ? 'selected' : '') . ">$categoria</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit">Cuentame el chiste</button>
    </form>

    <?php
    // Si se ha seleccionado una categoría, mostrar un chiste aleatorio de esa categoría
    if (isset($_GET["category"]) && !empty($_GET["category"])) {
        $categoriaSeleccionada = $_GET["category"];

        // URL para obtener un chiste aleatorio de la categoría seleccionada
        $apiURL = "https://api.chucknorris.io/jokes/random?category=$categoriaSeleccionada";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $chiste = json_decode($respuesta, true);

        // Mostrar el chiste
        echo "<div>";
        echo "<h3>Chiste de la categoría '$categoriaSeleccionada':</h3>";
        echo "<p>" . $chiste["value"] . "</p>";
        echo "</div>";
    }
    ?>

</div>
</body>
</html>
