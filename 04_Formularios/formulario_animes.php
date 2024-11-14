<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Anime</title>
</head>
<body>
    <h1>Registrar Nuevo Anime</h1>
    <?php
// Array de estudios de anime (puedes obtener estos valores de la base de datos si es necesario)
$estudios = [
    'Madhouse',
    'Toei Animation',
    'Bones',
    'Kyoto Animation',
    'Studio Ghibli'
];

// Año actual
$anio_actual = date("Y");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $nombre_estudio = $_POST['nombre_estudio'];
    $anno_estreno = $_POST['anno_estreno'];
    $num_temporadas = $_POST['num_temporadas'];

    // Validar los datos
    if (strlen($titulo) > 80) {
        echo "El título no puede tener más de 80 caracteres.";
        exit;
    }

    if (!in_array($nombre_estudio, ['Madhouse', 'Toei Animation', 'Bones', 'Kyoto Animation', 'Studio Ghibli'])) {
        echo "Estudio no válido.";
        exit;
    }

    if ($anno_estreno && ($anno_estreno < 1960 || $anno_estreno > (date("Y") + 5))) {
        echo "Año de estreno no válido.";
        exit;
    }

    if ($num_temporadas < 1 || $num_temporadas > 99) {
        echo "Número de temporadas no válido.";
        exit;
    }

    // Aquí se puede agregar la lógica para guardar los datos en la base de datos

    echo "Anime registrado correctamente.";
}
?>
    
    <form action="procesar_anime.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" maxlength="80" required>
        <br><br>
        
        <label for="nombre_estudio">Nombre del Estudio:</label>
        <select id="nombre_estudio" name="nombre_estudio" required>
            <option value="">Seleccione un Estudio</option>
            <?php
            // Crear las opciones dinámicamente
            foreach ($estudios as $estudio) {
                echo "<option value=\"$estudio\">$estudio</option>";
            }
            ?>
        </select>
        <br><br>
        
        <label for="anno_estreno">Año de Estreno:</label>
        <input type="number" id="anno_estreno" name="anno_estreno" min="1960" max="<?= $anio_actual + 5 ?>" placeholder="Opcional">
        <br><br>
        
        <label for="num_temporadas">Número de Temporadas:</label>
        <input type="number" id="num_temporadas" name="num_temporadas" min="1" max="99" required>
        <br><br>
        
        <button type="submit">Registrar Anime</button>
    </form>
</body>
</html>
