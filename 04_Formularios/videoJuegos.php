<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error{
            color:red;
        }
        *{
            margin-left:5px;
        }
    </style>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        function formatearNombre($nombre) { 
            return ucwords(strtolower($nombre)); 
        }
        function depurar(string $entrada) : string{
            $salida= htmlspecialchars($entrada);
            //$salida = trim($salida);
            //$salida = stripslashes($salida);
            //$salida = preg_replace('!\s+', ' ', $salida);
            return $salida;
        }
    ?>
</head>
<body>
    <!--formulario de viedeojuegos validarlo
     titulo= 1-80 caracteres , cualquier caracter
     consola = nintendo Switch,ps5,ps4,xbox series s/x
     con radio button
     fecha de lanzamiento = el juego mas antiguo admisible sera del 1 de 1947,
     y el mas en el futuro no podrá dentro de mas de 5 años(dia actual dinamico)
     -pegi = 3,7,12,16,18 con un (select)
     -descripcion = 255 caracteres,cualquier caracter o nada  (campo opcional)
     
     -Limpiar los datos del formulario y validarlos
     Mostrar todo por pantalla si han pasado la validacion-->
     <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_juego = depurar($_POST["juego"]) ;
            $tmp_consola = depurar(isset($_POST["consola"]) ? $_POST["consola"] : '');//esto es para comprobar que han metido un valor, de no ser asi de le pone el campo vacio
            $tmp_fecha = depurar($_POST["fecha"]);
            $tmp_pegi = depurar($_POST["pegi"]);
            $tmp_descripcion = depurar($_POST["descripcion"]);

            if($tmp_juego == ''){
                $err_juego = "<p>El nombre del juego es obligatorio</p>";
            }else{
                if(strlen($tmp_juego) < 1 || strlen($tmp_juego) > 80){
                    $err_juego = "<p>El nombre del juego no puede ser inferior a 1 caracter ni mayor a 80 caracteres</p>";
                }else{
                    $juego = formatearNombre($tmp_juego);
                }
            }

            if($tmp_consola == ''){
                $err_consola= "<p>Debes elegir una consola</p>";
            }else{
                $consolas_validas = ["PS4","PS5","Nintendo Switch","Xbox Series S/X"];
                if(!in_array($tmp_consola,$consolas_validas)){//para comprobar el $consola esta dentro del array $consolas_validas
                    $err_consola= "<p>La consola no es válida</p>";
                }else{
                    $consola = $tmp_consola;
                }               
            }

            
            $min_date = '1947-01-01'; 
            $max_date = date('Y-m-d', strtotime('+5 years')); 

            // validar la fecha
            if ($tmp_fecha == '') {
                $err_fecha = "<p>La fecha de lanzamiento es obligatoria</p>";
            }else{
                $patron = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
                    if (!preg_match($patron, $tmp_fecha)) {
                        $err_fecha = "<p>Formato de fecha incorrecto</p>";
                    }else{
                        if ($tmp_fecha < $min_date || $tmp_fecha > $max_date) {
                            $err_fecha = "<p>La fecha de lanzamiento debe estar entre el 1 de enero de 1947 y 5 años a partir de hoy</p>";
                        } else {
                            $fecha = $tmp_fecha;
                        }
                    }
            } 

            if($tmp_pegi==''){
                $err_pegi="<p>Debes elegir una calificación de edad</p>";
            }else{
                $pegi = $tmp_pegi;
            }
            $descripcion = $tmp_descripcion;
        }
     ?>
    


     <form class="col-2" action="" method="post">
        <div class="mb-3">
            <label class="form-label">Video Juego</label>
            <input type="text" class="form-control" name="juego">
            <?php if(isset($err_juego)) echo "<span class='error'>$err_juego</span>" ?>
        </div>
        <div>
            <input  type="radio" name="consola" value="Nintendo Switch"> 
            <label class="form-label">Nintendo Switch</label>
            <br>
            <input type="radio" name="consola" value="PS5"> 
            <label class="form-label">PS5</label>
            <br>
            <input type="radio" name="consola" value="PS4"> 
            <label class="form-label">PS4</label>
            <br>
            <input type="radio" name="consola" value="Xbox Series S/X"> 
            <label >PS4</label>
            <label >PS4</label>
            <label class="form-label">Xbox Series S/X</label>
            <?php if(isset($err_consola)) echo "<span class='error'>$err_consola</span>" ?>
        </div>
        <br><br>
        <div class="mb-3">
            <label class="form-label">Fecha de lanzamiento</label>
            <input type="date" class="form-control" name="fecha">
            <?php if(isset($err_fecha)) echo "<span class='error'>$err_fecha</span>" ?>
        </div>
        <br>
        <label for="pegi">Clasificación PEGI:</label>
        <select name="pegi" id="pegi">
            <option value="3">PEGI 3</option>
            <option value="7">PEGI 7</option>
            <option value="12">PEGI 12</option>
            <option value="16">PEGI 16</option>
            <option value="18">PEGI 18</option>
            <?php if(isset($err_pegi)) echo "<span class='error'>$err_pegi</span>" ?>
        </select>
        <br><br>
        <label for="descripcion">Descripción (opcional, máximo 255 caracteres):</label>
        <br><br>
        <textarea name="descripcion" id="descripcion" rows="4" cols="50" maxlength="255"></textarea>
        <br>
        <input class="btn btn-primary" type="submit" value="Enviar">
     </form>
     <?php
            if (isset($juego) && isset($consola) && isset($fecha) && isset($pegi)) {
                echo "<h2>Datos del Usuario</h2>"; 
                echo "<p>Juego: $juego</p>"; 
                echo "<p>Consola: $consola</p>"; 
                echo "<p>Fecha de lanzamiento: $fecha</p>"; 
                echo "<p>PEGI: $pegi</p>"; 
                echo "<p>Descripción: $descripcion</p>";
            }
        ?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>