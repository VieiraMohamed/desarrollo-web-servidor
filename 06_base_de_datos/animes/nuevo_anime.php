<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require('conexion.php');
    ?>
</head>
<body>
    <div class="container">
        <h1>Nuevo anime</h1>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["titulo"];
            $nombre_estudio = $_POST["nombre_estudio"];
            $anno_estreno = $_POST["anno_estreno"];
            $num_temporadas = $_POST["num_temporadas"];

            /* 
                $_FILE -> que es un array BIDIMENSIONAL
            */
            //var_dump($_FILES["imagen"]);
            $nombre_imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "./imagenes/$nombre_imagen";

            move_uploaded_file($ubicacion_temporal,$ubicacion_final);
            
            /*
            $sql = "INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas,imagen) 
                VALUES ('$titulo', '$nombre_estudio', $anno_estreno, $num_temporadas,'$ubicacion_final')";

            $_conexion -> query($sql);
            */




            /* Las 3 etapas de la prepared statements
            1. Preparacion
            2. Enlazado (binding)
            3. Ejecucion */
            $sql = $_conexion -> prepare("INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas,imagen) 
                VALUES(?,?,?,?,?)");
            //2. Enlazado
            $sql -> bind_param("ssiis",
            $titulo,
            $nombre_estudio, 
            $anno_estreno, 
            $num_temporadas,
            $ubicacion_final
            );

            //3. Ejecución
            $sql -> execute();

            
        }

/* La diferencia clave es cómo se manejan los datos en la consulta SELECT: primero ejecutas 
la declaración y luego enlazas el resultado para obtener los datos. En contraste, para una 
consulta INSERT, necesitas enlazar los parámetros primero y luego ejecutar la declaración. 


pero en una utilizo bind_param y en la otra se usa bind_result, no seria mas apropiado seguir
 la manera del bind_param?

Entiendo tu preocupación. Sin embargo, bind_param y bind_result tienen propósitos diferentes
 y se utilizan en contextos distintos:

    bind_param: Se utiliza para enlazar variables a parámetros en una consulta preparada antes
     de ejecutar la consulta. Es útil cuando necesitas enviar datos a la base de datos, 
     como en una inserción (INSERT), actualización (UPDATE) o eliminación (DELETE).

    php
    // Ejemplo de bind_param en una consulta de inserción
$sql = $_conexion -> prepare("INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen) VALUES(?,?,?,?,?)");
$sql -> bind_param("ssiis", $titulo, $nombre_estudio, $anno_estreno, $num_temporadas, $ubicacion_final);
$sql -> execute();


bind_result: Se utiliza para enlazar variables a columnas de resultados después de ejecutar 
una consulta preparada. Es útil cuando necesitas recuperar datos de la base de datos, como 
en una selección (SELECT).
php
// Ejemplo de bind_result en una consulta de selección
$sql = $_conexion -> prepare("SELECT nombre_estudio FROM estudios ORDER BY nombre_estudio");
$sql -> execute();
$sql -> bind_result($nombre_estudio);
$estudios = [];
while($sql -> fetch()) {
    array_push($estudios, $nombre_estudio);
}


Utilizar bind_param en una consulta SELECT no sería apropiado porque bind_param está diseñado 
para enlazar datos de entrada, no para manejar los resultados de una consulta. Por otro lado,
 bind_result está específicamente diseñado para enlazar y manejar los resultados después de 
 ejecutar una consulta de selección.

Cada uno tiene su propio propósito y se usa en diferentes etapas del manejo de consultas 
preparadas. Usar bind_param y bind_result en sus contextos apropiados asegura que las 
consultas sean seguras y eficientes.


*/


/* $sql = $_conexion -> prepare("SELECT nombre_estudio FROM estudios ORDER BY nombre_estudio"); 
// Ejecución 
$sql -> execute(); 
// Enlazar resultados 
$sql -> bind_result($nombre_estudio); 
// Almacenar resultados 
$estudios = []; 
while($sql -> fetch()) { 
    array_push($estudios, $nombre_estudio); 
    } 
// Cierre de la conexión 
$_conexion -> close(); */



         //aqui capturamos todo los estudios y los guardamos 
        $sql = "SELECT * FROM estudios ORDER BY nombre_estudio";
        $resultado = $_conexion -> query($sql);

        $_conexion -> close();

        $estudios = [];

        while($fila = $resultado -> fetch_assoc()){
            array_push($estudios, $fila["nombre_estudio"]);
        }
        //print_r($estudios); 
        
        
        ?>
        
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control" type="text" name="titulo">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre estudio</label>
                <select class="form-select" name="nombre_estudio">
                <option value="" selected disable hidden>...Elige estudio...</option> 
                    <?php                                          
                    foreach($estudios as $estudio) { ?>
                            <option value="<?php echo $estudio?>">
                                <?php echo $estudio ?>
                    <?php } ?>                       
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Año estreno</label>
                <input class="form-control" type="text" name="anno_estreno">
            </div>
            <div class="mb-3">
                <label class="form-label">Número de temporadas</label>
                <input class="form-control" type="text" name="num_temporadas">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Insertar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>