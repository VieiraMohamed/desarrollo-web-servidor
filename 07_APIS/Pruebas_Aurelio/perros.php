<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perro Aleatorio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        #perroImagen {
            max-width: 300px;
        }
    </style>
</head>
<body>
    <h1>Perro Aleatorio</h1>

    <!-- Botón para obtener una foto aleatoria -->
    <button onclick="mostrarFotoAleatoria()">Mostrar Perro Aleatorio</button>

    <!-- Div donde se mostrará la imagen de perro -->
    <div id="imagenDiv">
        <img id="perroImagen" alt="Perro aleatorio">
    </div>

    
</body>
</html>

<?php
// URL base de la API Dog.ceo para obtener una foto aleatoria
$apiURL = "https://dog.ceo/api/random/image";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Solicitar la imagen aleatoria desde la API
    $response = file_get_contents($apiURL);
    
    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    
}
?>
