<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de Estudios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require('conexion.php');
    ?>
    <style>
        table{
            border:1px solid black;
            text-align:center;
            border-collapse: collapse;
        }
        td{
            border:1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tabla de Estudios</h1>
        <?php
            $sql = "SELECT * FROM estudios";
            $resultado = $_conexion -> query($sql);
            /**
             * Aplicamos la funcion QUERY a la conexion , donde se ejecuta la 
             * sentencia SQL hecha
             * 
             * El resultado se almacena en $resultado , que es un objeto con
             * la estructura parecida a los arrays
             */

        ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre de estudio</th>
                    <th>Ciudad</th>
                    <th>Anno de fundación</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()){//trata el resultado como array asociativo
                        echo "<tr>";
                        echo "<td>". $fila["nombre_estudio"] ."</td>";
                        echo "<td>". $fila["ciudad"] ."</td>";
                        echo "<td>". $fila["anno_fundacion"] ."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>