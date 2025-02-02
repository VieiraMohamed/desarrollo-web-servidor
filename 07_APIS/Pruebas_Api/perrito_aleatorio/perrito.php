<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
    <title>Perros de Dog API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        select, button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h1>Perros de Dog API</h1>

<!-- Formulario para seleccionar una raza -->
<form method="GET" action="">
    <label for="raza">Selecciona una raza:</label><br/>
    <select name="raza" id="razaSelect">
        <option value="" disabled selected>-- Selecciona una raza --</option>
        <?php
            $apiURL = "https://dog.ceo/api/breeds/list/all";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Ejecutar la solicitud y obtener el resultado
            $respuesta = curl_exec($curl);

            if ($respuesta === false) {
                echo "Error en la solicitud a la API.";
                die();
            }

            $razasData = json_decode($respuesta, true);

            // Verificar si es un array y no una cadena de texto
            if (is_array($razasData['message'])) {
                foreach ($razasData['message'] as $raza => $subRazas) {
                    // Mostrar la raza principal si no hay subrazas
                    if (empty($subRazas)) {
                        echo "<option value=\"$raza\">$raza</option>";
                    } else {
                        foreach ($subRazas as $sRaza => $imagen) {
                            echo "<option value=\"$raza-$sRaza\">$raza - $sRaza</option>";
                        }
                    }
                }
            }

            curl_close($curl);
        ?>
    </select>
    <button type="submit">Mostrar Fotos</button>
</form>

<?php
if (!empty($_GET["raza"])) {
    $razaElegida = $_GET["raza"];

    // URL base para obtener imágenes de la raza elegida
    if (strpos($razaElegida, "-")) {
        list($categoria, $subRaza) = explode('-', $razaElegida);
        
        // URL de la API para obtener imágenes específicas de la sub-raza
        $apiURL = "https://dog.ceo/api/breed/{$categoria}/$subRaza/images";
    } else {
        // Si no hay sub-raza, seleccionamos la raza principal
        $categoria = $razaElegida;
        
        // URL de la API para obtener imágenes generales de la categoría
        $apiURL = "https://dog.ceo/api/breed/{$categoria}/images";
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($curl);

    if ($respuesta === false) {
        echo "Error en la solicitud a la API.";
    } else {
        $imagenesData = json_decode($respuesta, true);
        
        if ($imagenesData['status'] === 'success' && isset($imagenesData['message'])) {
            $fotosDisponibles = $imagenesData['message'];

            // Mostrar todas las fotos disponibles para esa raza/sub-raza
            echo '<form method="GET" action="">';
            echo '<label for="imagenElegida">Selecciona una foto:</label><br/>';
            echo '<select name="imagenElegida" id="imagenSelect">';
            
            foreach ($fotosDisponibles as $indice => $imagen) {
                // Verificar si la URL de la imagen es válida
                if (filter_var($imagen, FILTER_VALIDATE_URL)) {
                    echo "<option value=\"$imagen\">[$indice] <img src='$imagen' alt='Miniatura' style='width: 50px;' /></option>";
                }
            }
            
            echo '</select>';
            echo '<button type="submit">Mostrar Foto</button>';
            echo '</form>';

            // Mostrar la imagen elegida
            if (!empty($_GET["imagenElegida"])) {
                $imagenElegida = $_GET["imagenElegida"];
                
                if (filter_var($imagenElegida, FILTER_VALIDATE_URL)) {
                    echo '<img src="' . htmlspecialchars($imagenElegida, ENT_QUOTES, 'UTF-8') . '" style="width: 300px;" />';
                } else {
                    echo "URL de la imagen no válida.";
                }
            } else {
                echo "<p>No hay fotos disponibles.</p>";
            }
        } else {
            echo "<p>No hay fotos disponibles.</p>";
        }

        curl_close($curl);
    }
}
?>
</body>
</html>
