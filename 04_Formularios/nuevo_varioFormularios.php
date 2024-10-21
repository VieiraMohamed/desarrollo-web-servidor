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
                $base = $_POST["base"];
                $exponente = $_POST["exponente"];
                calcularExponente($base,$exponente);
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
                $sueldo = $_POST["sueldo"];
                $resultado = 0;
                calcularIrpf($sueldo);
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
                calcularPrimos($num,$num2);
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
                        calcularTabla($numero);
                    }
                }
            ?>
        </tbody>
</body>
</html>