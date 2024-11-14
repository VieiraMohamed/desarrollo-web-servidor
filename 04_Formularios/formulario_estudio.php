<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Estudio</title>
</head>
<body>
    <h1>Registrar Nuevo Estudio de Animación</h1>
    <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_estudio = $_POST['nombre_estudio'];
    $ciudad = $_POST['ciudad'];

    // Validar los datos
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $nombre_estudio)) {
        echo "El nombre del estudio solo puede contener letras, números y espacios.";
        exit;
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $ciudad)) {
        echo "La ciudad solo puede contener letras y espacios.";
        exit;
    }

    // Aquí se puede agregar la lógica para guardar los datos en la base de datos

    echo "Estudio registrado correctamente.";
}
?>

    
    <form action="procesar_estudio.php" method="POST">
        <label for="nombre_estudio">Nombre del Estudio:</label>
        <input type="text" id="nombre_estudio" name="nombre_estudio" pattern="^[a-zA-Z0-9 ]+$" required>
        <br><br>
        
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" pattern="^[a-zA-Z ]+$" required>
        <br><br>
        
        <button type="submit">Registrar Estudio</button>
    </form>
</body>
</html>
