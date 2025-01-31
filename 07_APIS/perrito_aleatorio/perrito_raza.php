<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perrito por Raza</title>
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
</head>
<body>
<div>
    <h1>Perrito por Raza</h1>
    <form action="" method="GET" class="mb-4">
        <div>
            <label for="breed">Selecciona una raza:</label>
            <select name="breed" id="breed" onchange="this.form.submit()">
                <option value="" selected disabled>-- Selecciona una raza --</option>
                <?php
                // URL para obtener todas las razas
                $apiURL = "https://dog.ceo/api/breeds/list/all";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiURL);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $respuesta = curl_exec($curl);
                curl_close($curl);

                $datos = json_decode($respuesta, true);
                $razas = $datos["message"];

                // Mostrar las razas en el campo select
                foreach($razas as $raza => $subrazas) {
                    if (empty($subrazas)) {
                        echo "<option value=\"$raza\" " . (isset($_GET["breed"]) && $_GET["breed"] == $raza ? 'selected' : '') . ">$raza</option>";
                    } else {
                        foreach($subrazas as $subraza) {
                            echo "<option value=\"$raza/$subraza\" " . (isset($_GET["breed"]) && $_GET["breed"] == "$raza/$subraza" ? 'selected' : '') . ">$subraza $raza</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>

        <?php
        // Si se ha seleccionado una raza, mostrar las imágenes
        if (isset($_GET["breed"]) && !empty($_GET["breed"])) {
            $razaSeleccionada = $_GET["breed"];

            // URL para obtener todas las imágenes de la raza seleccionada
            $apiURL = "https://dog.ceo/api/breed/$razaSeleccionada/images";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $datos = json_decode($respuesta, true);
            $imagenes = $datos["message"];
            $cantidadImagenes = count($imagenes);

            if ($cantidadImagenes > 0) {
                echo "<p>La raza tiene $cantidadImagenes fotos disponible";
                echo "<div>";
                echo "<label for='imagenes'>Selecciona una foto:</label>";
                echo "<select name='imagenes' id='imagenes'>";
                
                // Mostrar el nombre de la imagen (extraído de la URL) en lugar de solo "Foto 1", "Foto 2", etc.
                foreach ($imagenes as $index => $imagen) {
                    // Extraemos el nombre de la imagen desde la URL (última parte de la URL)
                    $nombreImagen = basename($imagen);
                    echo "<option value='$imagen'>$nombreImagen</option>";
                }

                echo "</select>";
                echo "</div>";
            } else {
                echo "<p>No se encontraron fotos para la raza seleccionada.</p>";
            }
        }
        ?>

        <button type="submit">Mostrar Perrito</button>
    </form>

    <?php
    // Si se ha seleccionado una imagen, mostrarla
    if (isset($_GET["imagenes"])) {
        $imagenSeleccionada = $_GET["imagenes"];
        echo "<h3>Foto seleccionada:</h3>";
        echo "<img src='$imagenSeleccionada' alt='Perrito'>";
    }
    ?>
</div>
</body>
</html>
