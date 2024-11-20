<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de multiplicar</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>
    <!-- CREA UN FORMULARIO QUE RECIBA UN NÚMERO
         SE MOSTRARÁ LA TABLA DE MULTIPLICAR DE ESE NÚMERO EN UNA TABLA HTML
         2 X 1 = 2
         2 X 2 = 4 -->
    <form action="" method="post">
        <label for="numero">Número</label>
        <input type="text" name="numero" id="numero" placeholder="Introduzca un numero">
        <input type="submit" value="Enviar">
    </form>
    <table>
        <thead>
            <tr>
                <th>numero</th>
                <th></th>
                <th>multiplicado</th>
                <th></th>
                <th>resultado</th>
            </tr>
        </thead>
        <tbody>
            
             <?php
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                     $numero = $_POST["numero"];
                     $count = 1;
                     $resultado="";
             
                    for($i = 1; $i <= 10; $i++){
                        $resultado=($numero*$count);
                        $count++;
                        echo "<tr>";
                         echo "<td>$numero</td>";
                         echo "<td>x</td>";
                         echo "<td>$count</td>";
                         echo "<td>=</td>";
                         echo "<td>$resultado</td>";
                         echo "</tr>";
                    }
                 }
             ?>
            
        </tbody>
    </table>
    
       
            
 
            
     
    
</body>
</html>