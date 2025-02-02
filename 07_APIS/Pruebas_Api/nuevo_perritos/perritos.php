<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
    <title>Nuevos Perritos</title>
</head>
<body>
    <form action="" method="GET">
        <select name="raza" id="raza">
            <option value="" disabled selected>-- Selecciona una raza --</option>
            <?php
                $apiURL = "https://dog.ceo/api/breeds/list/all";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiURL);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                // Ejecutar la solicitud y obtener el resultado
                $respuesta = curl_exec($curl);
                curl_close($curl);
                $razas = json_decode($respuesta, true);
                $razas = $razas['message'];

                foreach($razas as $raza => $subrazas) { 
                    if(empty($subrazas)){ ?>
                        <option value="<?php echo $raza; ?>"><?php echo $raza; ?></option>
                    <?php } else {
                        echo '<optgroup label="' . $raza . '">';
                        foreach($subrazas as $subraza){ ?>
                            <option value="<?php echo $raza . '/'. $subraza; ?>"><?php echo $subraza . ' '. $raza ; ?></option>
                        <?php }
                        echo '</optgroup>';
                    }
                }
            ?>
        </select>
        <button type="submit" name="submit">Mostrar foto</button>
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["submit"])) {
            if (isset($_GET["raza"]) && !empty($_GET["raza"])) {
                $razaElegida = $_GET["raza"];
                $apiURL = "https://dog.ceo/api/breed/$razaElegida/images/random";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiURL);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                // Ejecutar la solicitud y obtener el resultado
                $respuesta = curl_exec($curl);
                curl_close($curl);
                $imagen = json_decode($respuesta, true);
                $imagen = $imagen['message'];

                echo "<img src='$imagen' style='width:200px'>";
            } else {
                echo "Debes seleccionar una raza de perro";
            }
        }
    ?>
</body>
</html>
