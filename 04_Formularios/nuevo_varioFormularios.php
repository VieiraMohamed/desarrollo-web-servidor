<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios (4 formularios)</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        
        require('../05_funciones/exponente.php');//esto es para importar
        require('../05_funciones/irpf.php');//esto es para importar
        require('../05_funciones/primos.php');//esto es para importar
        require('../05_funciones/tablaDeMultiplicar.php');//esto es para importar
    ?>
</head>
<body>
    <h1>Exponente</h1>
    <form action="" method="post">
        <label for="base">Base</label>
        <input type="text" name="base" id="base" placeholder="Introduzca la base">
        <br>
        <label for="exponente">Exponente</label>
        <input type="text" name="exponente" id="exponente" placeholder="Introduzca el exponente">
        <input type="hidden" name="action" value="formulario_exponente">
        <input type="submit" value="calcular">
    </form>
    <br>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["action"] == "formulario_exponente"){
                $tmp_base = $_POST["base"];
                $tmp_exponente = $_POST["exponente"];

                /* if($tmp_base !=""){
                    if(filter_var($tmp_base,FILTER_VALIDATE_INT) !== FALSE){
                        $base = $tmp_base;
                    }else{
                        echo "<p>La base debe ser un número</p>";
                    }
                }else{
                    echo "<p>La base es obligatoria</p>";
                } */

                //version alternativa
                if($tmp_base == ""){
                    echo "<p>La base es obligatoria</p>";
                }else{
                    if(filter_var($tmp_base,FILTER_VALIDATE_INT) === FALSE){
                        echo "<p>La base debe ser un número</p>";
                    }else{
                        $base = $tmp_base;
                    }
                }

                /* if($tmp_exponente !=""){
                    if(filter_var($tmp_exponente,FILTER_VALIDATE_INT) !== FALSE){
                        if($tmp_exponente >= 0){
                            $exponente = $tmp_exponente;
                        }else{
                            echo "<p>El exponente debe ser igual o mayor a cero</p>";
                        }
                    }else{
                        echo "<p>La exponente debe ser un número</p>";
                    }
                }else{
                    echo "<p>La exponente es obligatoria</p>";
                }
 */

                //version alternativa
                if($tmp_exponente == ""){
                    echo "<p>El exponente es obligatorio</p>";
                }else{
                    if(filter_var($tmp_exponente,FILTER_VALIDATE_INT) === FALSE){
                        echo "<p>El exponente debe ser un número</p>";
                    }else{
                        if($tmp_exponente < 0){
                            echo "<p>El exponente debe ser mayor o igual a cero</p>";
                        }else{
                            $exponente = $tmp_exponente;
                        }
                    }
                }


                if(isset($base) && isset($exponente)){
                    $resultado = calcularExponente($base,$exponente);
                    echo "<h1>El resultado es $resultado</h1>";
                }
            }
        }
    ?>
    <br>
    <h1>IRPF</h1>
    <form action="" method="post">
    <label for="sueldo" >Sueldo</label>
    <input type="text" name="sueldo" id="sueldo">
    <input type="hidden" name="action" value="formulario_irpf">
    <input type="submit" value="Calcular">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["action"] == "formulario_irpf"){
                $tmp_sueldo = $_POST["sueldo"];
                $resultado = "";

                if($tmp_sueldo ==""){
                    echo "<p>El sueldo es obligatorio</p>";
                }else{
                    if(filter_var($tmp_sueldo,FILTER_VALIDATE_FLOAT) === FALSE){
                        echo "<p>El sueldo debe ser un número</p>";
                    }else{
                        if($tmp_sueldo < 0){
                            echo "<p>El sueldo debe ser mayor o igual a cero</p>";
                        }else{
                            $sueldo = $tmp_sueldo;
                        }
                    }
                }
                if(isset($sueldo)){
                    $resultado = calcularIrpf($sueldo);
                    echo "<h1>Tu sueldo es: $sueldo y después de robarte hacienda te queda $resultado </h1>";
                }
                
            }
        }
    ?>
    <br>
    <h1>Números primos</h1>
    <form action="" method="post">
        <label for="num">Primer numero</label>
        <input type="text" name="num">
        <br>
        <label for="num2">Segundo numero</label>
        <input type="text" name="num2">
        <br>
        <input type="hidden" name="action" value="formulario_primos">
        <input type="submit" value="Calcular">
        <br>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["action"] == "formulario_primos"){
                $num = $_POST["num"];
                $num2 = $_POST["num2"];
                
                if($num !="" && $num2 !=""){
                    calcularPrimos($num,$num2);
                }else{
                    echo "<p>Faltan datos</p>";
                }
            }
        }
    ?>
    <br>
    <h1>Tabla de multiplicar</h1>
    <form action="" method="post">
        <label for="numero">Número</label>
        <input type="text" name="numero" id="numero" placeholder="Introduzca un numero">
        <input type="hidden" name="action" value="formulario_tabla">
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
                    if($_POST["action"] == "formulario_tabla"){
                        $numero = $_POST["numero"];
                        if($numero !=""){
                            calcularTabla($numero);
                        }else{
                            echo "<p>Faltan datos</p>";
                        }
                    }
                    
                }
            ?>
        </tbody>
</body>
</html>