<?php
    function calcularPrimos($num,$num2){
        if($num !="" && $num2 != ""){

            
            echo "<p>Los números primos entre $num y $num2 son :</p>";
            echo "<ul>";

            $count = 0;
            for($i = $num; $i <= $num2; $i++){
                for($j = 1; $j <= $i; $j++){
                    if($i % $j == 0){
                     $count++;
                
                    }
                }
                if($count == 2){
                    echo "<p>$i</p>";
                }
                $count = 0;  
            }
            echo "</ul>";
        }else{
            echo "<h3>Faltan datos</h3>";
        }
    }
?>