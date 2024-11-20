<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        function formatearNombre($nombre) { 
            return ucwords(strtolower($nombre)); 
        }
        function depurar(string $entrada) : string{
            $salida= htmlspecialchars($entrada);
            $salida = trim($salida);
            $salida = stripslashes($salida);
            //$salida = preg_replace('!\s+', ' ', $salida);
            return $salida;
        }
    ?>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_titulo= depurar($_POST["titulo"]) ;
            $tmp_paginas = depurar($_POST["paginas"]);
            $tmp_genero = depurar(isset($_POST["genero"]) ? $_POST["genero"] : '');
            $tmp_secuela = $_POST["secuela"];
            $tmp_fecha = depurar($_POST["fecha"]);
            $tmp_descripcion = depurar($_POST["descripcion"]);


            if($tmp_titulo == ''){
                $err_titulo = "El título es obligatorio";
            }else{
                $patron= "/^[a-zA-ZáéíóúÁÉÍÓÚñÑÜü]{1}+[a-zA-Z áéíóúÁÉÍÓÚñÑÜü.,;]+$/";
                if(!preg_match($patron,$tmp_titulo)){
                    $err_titulo = "El titulo solo puede tener letras , números,puntos,comas,puntos y comas y espacios en blanco";
                }else{
                    if(strlen($tmp_titulo) < 1 || strlen($tmp_titulo) > 40){
                        $err_titulo = "El título no puede ser menor a 1 caracter ni mayor a 40 caracteres";
                    }else{
                        $titulo = $tmp_titulo;
                    }
                }
            }

            if($tmp_paginas == ''){
                $err_paginas = "Las páginas son obligatorias";
            }else{               
                if($tmp_paginas < 10 || $tmp_paginas > 9999){
                    $err_paginas = "Las páginas no pueden ser menor a 10 ni mayor a 9999";
                }else{
                    $paginas = $tmp_paginas;
                }               
            }


            if($tmp_genero == ''){
                $err_genero = "El género es obligatorio";
            }else{
                $generos_validos = ["Fantasía","Ciencia Ficción","Romance","Drama"];
                if(!in_array($tmp_genero,$generos_validos)){
                    $err_genero= "El género noes valido";
                }else{
                    $genero = $tmp_genero;
                }
            }
            

            if($tmp_secuela == ''){
                $tmp_secuela = 'no';
            }else{
                $secuela = $tmp_secuela;
            }




            if($tmp_fecha == ''){
                $err_fecha = "La fecha no es obligaria";
            }else{
                $patron = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
                if(!preg_match($patron,$tmp_fecha)){
                    $err_fecha = "El formato de la fecha es incorrecto";
                }else{

                    $fecha_min = "1800-01-01";
                    $fecha_max = date('Y-m-d', strtotime('+3 years')); 

                    if ($tmp_fecha < $fecha_min || $tmp_fecha > $fecha_max) {
                        $err_fecha = "La fecha de lanzamiento debe estar entre el 1 de enero de 1800 y 3 años a partir de hoy";
                    } else {
                        $fecha = $tmp_fecha;
                    }
                }
            }


            $patron ="/^[a-zA-ZáéíóúÁÉÍÓÚñÑÜü]$/";
            if(!preg_match($patron,$tmp_descripcion)){
                $err_descipcion= "La sipnosis solo puede contener letras y espacios en blanco";
            }else{
                $descripcion = $tmp_descripcion;
            }
            
        }

        
    ?>
    


<form class="col-4" action="" method="post">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo">
            <?php if(isset($err_titulo)) echo "<span class='error'>$err_titulo</span>" ?>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Páginas</label>
            <input type="text" class="form-control" name="paginas">
            <?php if(isset($err_paginas)) echo "<span class='error'>$err_paginas</span>" ?>
        </div>
        <br>
        <div>
        <label class="form-label">Género</label>
        <br>
        <input  type="radio" name="genero" value="Fantasía"> 
            <label class="form-label">Fantasía</label>
            <br>
            <input type="radio" name="genero" value="Ciencia Ficción"> 
            <label class="form-label">Ciencia Ficción</label>
            <br>
            <input type="radio" name="genero" value="Romance"> 
            <label class="form-label">Romance</label>
            <br>
            <input type="radio" name="genero" value="Drama"> 
            <label class="form-label">Drama</label>
            <?php if(isset($err_genero)) echo "<span class='error'>$err_genero</span>" ?>
        </div>
        <br>
        <div class="mb-3">
        <label for="secuela">Secuela:</label>
        <select name="secuela" id="secuela">
            <option value="si">Si</option>
            <option value="no">No</option>
            <?php if(isset($err_secuela)) echo "<span class='error'>$err_secuela</span>" ?>
        </select>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Fecha de publicación</label>
            <input type="date" class="form-control" name="fecha">
            <?php if(isset($err_fecha)) echo "<span class='error'>$err_fecha</span>" ?>
        </div>
        <br>
        <div>
        <label for="descripcion">Descripción (opcional, máximo 200 caracteres):</label>
        <br>
        <textarea name="descripcion" id="descripcion" rows="4" cols="50" maxlength="200"></textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Enviar">
        </div>
    </form>
    <?php
            if (isset($titulo) && isset($paginas) && isset($genero) && isset($secuela) && isset($fecha) && isset($descripcion)) {
                echo "<h2>Datos del Libro/h2>"; 
                echo "<p>Título: $titulo</p>"; 
                echo "<p>Páginas: $paginas</p>"; 
                echo "<p>Género: $genero</p>"; 
                echo "<p>Secuela: $secuela</p>";
                echo "<p>Fecha de publicación: $fecha</p>"; 
                echo "<p>Sipnosis: $descripcion</p>";               
                
            }
        ?>
</body>
</html>

