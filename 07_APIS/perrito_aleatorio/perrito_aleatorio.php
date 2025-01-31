<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
    <title>Perros</title>
</head>
<body>
<?php
    
    $apiURL = "https://dog.ceo/api/breeds/image/random";


   
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$apiURL");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $perros = $datos["message"];

    

        echo '<img src=" '.$perros.' "style="width: 300px;"">'
    ?>
    
    <a href="perrito_aleatorio.php"> FETCH </a>
</body>
</html>