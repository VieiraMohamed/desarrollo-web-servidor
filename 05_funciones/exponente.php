<?php
    function calcularExponente($base,$exponente){
        
        $total = 1;
        for($i = 0;$i < $exponente; $i++){
            $total *= $base;
        }            
        return $total;   
    }
    
?>