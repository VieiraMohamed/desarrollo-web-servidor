<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numeros</title>
    
</head>
<body>
    <?php
       /* $numero = 2;

        if($numero > 0){
            echo "<p>1 El numero $numero es mayor que cero</p>";
        }
        if($numero > 0) echo "<p>2 El numero $numero es mayor que cero</p>";

        if($numero > 0):
            echo "<p>3 El numero $numero es mayor que cero</p>";
        endif;
        */
        /* $numero = 0;

        if($numero > 0){
            echo "<p>1 El numero $numero es mayor que cero</p>";
        } elseif($numero ==0){
            echo "<p>1 El numero $numero es igual que cero</p>";
        }
         else{
            echo "<p>1 El numero $numero es menor que cero</p>";
        } */
    
        #RANGOS [-10,0),[0,10],(10,20]

        //$num = 21;
        # and o && para la conjuncion
        /* Forma1 */
        /* if($num >= -10 and $num < 0){
            echo "<p>El número $num está en el rango [-10,0)</p>";
        }elseif($num >= 0 && $num <= 10){
            echo "<p>El número $num está en el rango [0,10]</p>";
        }elseif($num  > 10 and $num <= 20){
            echo "<p>El número $num está en el rango (10,20]</p>";
        }else{
            echo "<p>El número $num está fuera de rango</p>";
        } */

        /* Forma 2 */
        /* if($num >= -10 and $num < 0) echo "<p>El número $num está en el rango [-10,0)</p>";
        elseif($num >= 0 && $num <= 10) echo "<p>El número $num está dentro de rango [0,10]</p>";
        elseif($num > 10 and $num <= 20) echo "<p>El número $num está dentro de rango (10,20]";
        else echo "<p>El número está fuera de rango</p>"; */

        /* Forma 3 */
        /* if($num >= -10 and $num < 0):
             echo "<p>El número $num está en el rango [-10,0)</p>";
        elseif($num >= 0 && $num <= 10):
             echo "<p>El número $num está dentro de rango [0,10]</p>";
        elseif($num > 10 and $num <= 20):
             echo "<p>El número $num está dentro de rango (10,20]";
        else:
             echo "<p>El número está fuera de rango</p>";
        endif; */

        /* 
            Comprobar de tres formas diferentes , son la estructura if , si el numero aleatorio tiene 1,2 0 3 digitos
         */
        $numero_aleatorio = rand(1,200);#para numeros enteros
        $digitos = null;
        //$numeros_aleatorio_decimales = rand(10,100)/10;#para numero con decimales

        //FORMA 1
        /* if($numero_aleatorio >= 0 and $numero_aleatorio < 10){
            echo "<p>El numero $numero_aleatorio tiene un digito";
        }
        elseif($numero_aleatorio > 9 and $numero_aleatorio < 100){
            echo "<p>El numero $numero_aleatorio tiene dos digitos</p>";
        }
        else{
            echo "<p>El numero $numero_aleatorio tiene 3 digitos</p>";
        } */

        //FORMA 2
        /* if($numero_aleatorio >= 0 and $numero_aleatorio < 10)
            echo "<p>El numero $numero_aleatorio tiene un digito</p>";
        
        elseif($numero_aleatorio > 9 and $numero_aleatorio < 100)
            echo "<p>El numero $numero_aleatorio tiene dos digitos</p>";
        
        else
            echo "<p>El numero $numero_aleatorio tiene 3 digitos</p>";
         */


         //VERSIÓN CON MATCH
         $digitos = match (true) {
             $numero_aleatorio >= 1 && $numero_aleatorio <= 9 => 3,
             $numero_aleatorio >= 10 && $numero_aleatorio <= 99 => 2,
             $numero_aleatorio >= 100 && $numero_aleatorio <= 999 => 3,
             default => "<p>ERROR</p>"
         };

         echo "</h1>El número tiene $digitos dígitos to way</h1>";

         //FORMA 3

         if($numero_aleatorio >= 0 and $numero_aleatorio < 10):
            $digitos = 1;
        
        elseif($numero_aleatorio > 9 and $numero_aleatorio < 100):
            $digitos = 2;   
        else:
            $digitos = 3;
        endif;
        echo "<p>El numero $numero_aleatorio tiene $digitos digito</p>";

        //como hacer para que salga digito a digito

        $digitos_texto = "digitos";
        if($digitos_texto == 1)$digitos_texto = digito;
        echo "<p>El numero $numero_aleatorio tiene $digitos $digitos_texto</p>";

        $n = rand (1,3);/* "rand" es como el math ramdon que va desde el 1 al 3 */

        switch($n){
            case 1:
                echo "<p>El número es 1</p>";
                break;
            case 2:
                echo "<p>El número es 2</p>";
                break;
        default:
                echo "<p>El número es 3</p>";
        }

        $resultado = match($n){
            1 => "<p>El número es 1</p>",
            2 => "<p>El número es 2</p>",
            3 => "<p>El número es 3</p>"
        };
        echo "<h3>$resultado</h3>";
    ?>
</body>
</html>