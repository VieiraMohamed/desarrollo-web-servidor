<?php
    function calcularExponente(int $base,int $exponente) : int{
        
        $total = 1;
        for($i = 0;$i < $exponente; $i++){
            $total *= $base;
        }            
        return $total;   
    }
    
?>