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
    <!-- Málafa C.F
     Equipos de la liga
     -Nombre (letras con tilde,ñ,espacios en blanco y punto), entre 3 y 20 caracteres
     -Inicial (3 letras)
     -Liga ("select" con opciones: LIga EA Sports, Liga Hypermotion,
     Liga Primera RFEF)
     -Equipo femenino ("select" si o no)
     -Ciudad (letras con tilde, ñ, ç y con espacios en blanco)
     -Fecha de fundación (entre hoy y el 18 de diciembre de 1889) 
     -Numero de jugadore entre (19 y 32)-->

    <?php
        if($_SERVER ["REQUEST_METHOD"] == "POST"){
            $tmp_nombre = $_POST["nombre"];
            $tmp_inicial = $POST["inicial"];
            $tmp_liga = (isser($_POST["liga"]) ? $_POST["liga"] : '');//(isset($_POST["consola"]) ? $_POST["consola"] : '');
            $tmp_fem = (isset($_POST["fem"]) ? $_POST["liga"] : '');
            $tmp_ciudad= $_POST["ciudad"];
            $tmp_fecha = $_POST["fecha"];
            $tmp_numero = $_POST["numero"];


            if($tmp_nombre == ''){
                $err_nombre = "El nombre es obligatorio";
            }else{
                if(strlen($tmp_nombre) < 3 || strlen($tmp_nombre) > 40){
                    $err_nombre= "El nombre no puede ser menor a 3 caracteres ni mayor a 40 caracteres";
                }else{
                    $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.]+$/";
                    if (!preg_match($patron, $tmp_nombre)){
                        $err_nombre= "El nombre no puede tener caracteres extraños";
                    }else{
                        if(!isset($err_nombre)){
                            $nombre = $tmp_nombre;
                        }
                    }
                }
            }

            if($tmp_inicial == ''){
                $err_inicial = "Las iniciales son obligatorias";
            }else{
                if(strlen($tmp_inicial) != 3){
                    $err_inicial = "Las iniciales no puede tener mas de 3 caracteres";
                }else{
                    $patron = "/^[a-zA-Z]+$/";
                    if (!preg_match($patron, $tmp_inicial)){
                        $err_inicial= "Las iniciales solo puede contener letras";
                    }else{
                        if(!isset($err_inicial)){
                        $inicial = $tmp_inicial;
                        }
                    }
                }
            }

            if($tmp_liga == ''){
                $err_liga = "La liga es obligatoria";
            }else{
                $ligas_validas = ["EA","hyper","RFEF"];
                if(!in_array($tmp_liga,$ligas_validas)){
                    $err_liga = "La liga no es valida";
                }else{
                    $liga = $tmp_liga;
                }
            }

            if($tmp_fem == ''){
                $err_fem= "Es obligatio poner si es femenina o masculina";
            }else{
                $respuestas_validas = ["Si","No"];
                if(!in_array($tmp_fem,$respuestas_validas)){
                    $err_fem = "La respuesta no es correcta";
                }else{
                    $fem = $tmp_fem;
                }
            }

            if($tmp_ciudad == ''){
                $err_ciudad = "La ciudad es obligatoria";
            }else{
                if(strlen($tmp_ciudad) < 3 || strlen($tmp_ciudad) > 40){
                    $err_ciudad = "La ciudad no puede ser menor de 3 caracteres  ni mayor a 40 caracteres";
                }else{
                    $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑçÇ\s]+$/";
                    if (!preg_match($patron, $tmp_ciudad)){
                        $err_ciudad = "La ciudad no puede contener caracteres extraños";
                    }else{
                        if(!isset($err_ciudad)){
                            $ciudad = $tmp_ciudad;
                        }
                    }
                }
            }

            $min_date = '1889-12-18'; 
            $max_date = date('Y-m-d');
            if ($tmp_fecha == '') {
                $err_fecha = "<p>La fecha de fundación es obligatoria</p>";
            }else{
                $patron = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
                    if (!preg_match($patron, $tmp_fecha)) {
                        $err_fecha = "<p>Formato de fecha incorrecta</p>";
                    }else{
                        if ($tmp_fecha < $min_date || $tmp_fecha > $max_date) {
                            $err_fecha = "<p>La fecha de lanzamiento debe estar entre el 18 de diciembre de 1889 y el dia de hoy</p>";
                        } else {
                            $fecha = $tmp_fecha;
                        }
                    }
            } 


            if($tmp_numero == ''){
                $err_numero = "El número de jugadores es obligatorio";
            }else{
                if($tmp_numero < 19 || $tmp_numero > 32){
                    $err_numero = "El número de jugadores no puede ser menor a 19 ni mayor a 32";
                }
            }

        }
    ?>

     


     <form class="col-2" action="" method="post">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre">
            <?php if(isset($err_nombre)) echo "<span class='error'>$err_nombre</span>" ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Iniciales</label>
            <input type="text" class="form-control" name="inicial">
            <?php if(isset($err_inicial)) echo "<span class='error'>$err_inicial</span>" ?>
        </div>
        <br>
        <div>
            <label for="">Liga</label>
                <select name="liga">
                    <option value="EA">Liga EA Sports</option>
                    <option value="hyper">Liga Hypermotion</option>
                    <option value="RFEF">Liga Primera RFEF</option>
                    <?php if(isset($err_liga)) echo "<span class='error'>$err_liga</span>" ?>
                </select>
            </div>
        <br>
        <label for="fem">Equipo femenino: </label>
        <select name="fem" id="fem">
            <option value="si">Si</option>
            <option value="no">No</option>
            <?php if(isset($err_fem)) echo "<span class='error'>$err_fem</span>" ?>
        </select>
        <br>
        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <input type="text" class="form-control" name="ciudad">
            <?php if(isset($err_ciudad)) echo "<span class='error'>$err_ciudad</span>" ?>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Fecha de fundación</label>
            <input type="date" class="form-control" name="fecha">
            <?php if(isset($err_fecha)) echo "<span class='error'>$err_fecha</span>" ?>
        </div>
        <br>
        <div>
            <label for="numero">Número de jugadores</label>
            <input type="text" name="numero" >
            <?php if(isset($err_numero)) echo "<span class='error'>$err_numero</span>" ?>
        </div>
        <input class="btn btn-primary" type="submit" value="Enviar">
     </form>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>