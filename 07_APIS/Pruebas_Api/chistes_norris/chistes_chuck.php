<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
    <title>Chistes de ChuckNorris</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        select {
            padding: 10px;
            width: 200px;
            display: inline-block;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h1>Chistes de ChuckNorris</h1>
<form method="GET" action="">
    <select name="categoria">
        <option value="" disabled selected>-- Selecciona una categoría --</option>
        <?php
            $apiURL = "https://api.chucknorris.io/jokes/categories";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            if (curl_errno($curl)) {
                echo "<p>Error: " . curl_error($curl) . "</p>";
            } else {
                $categorias = json_decode($respuesta, true);
                foreach ($categorias as $categoria) {
                    echo "<option value=\"$categoria\">$categoria</option>";
                }
            }
            curl_close($curl);
        ?>
    </select>
    <button type="submit">Cuéntame el chiste</button>
</form>

<?php
$categoriaElegida = "";
if (isset($_GET["categoria"])) {
    $categoriaElegida = $_GET["categoria"];
    
    if (!empty($categoriaElegida)) {
        $apiURL = "https://api.chucknorris.io/jokes/random?category=$categoriaElegida";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        if (curl_errno($curl)) {
            echo "<p>Error: " . curl_error($curl) . "</p>";
        } else {
            $chisteData = json_decode($respuesta, true);
            
            if (isset($chisteData["value"])) {
                echo "<h2>¡Aquí tienes tu chiste!</h2><p>" . htmlspecialchars($chisteData["value"]) . "</p>";
            } else {
                echo "<p>No se pudo obtener el chiste en este momento.</p>";
            }
        }
        
        curl_close($curl);
    } else {
        echo "<p>Elige una categoría</p>";
    }
} else {
    echo "<p>Elige una categoría</p>";
}
?>

</body>
</html>