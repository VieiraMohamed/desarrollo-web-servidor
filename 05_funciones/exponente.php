<?php
    function calcularExponente($base,$exponente){
        if($base !="" && $exponente !=""){
            $total = 1;
            for($i = 0;$i < $exponente; $i++){
                $total *= $base;
            }            
            echo "<h1>$total</h1>";
        }
        else{
            echo "<p>Faltan datos</p>";
        }
        
    }
?>