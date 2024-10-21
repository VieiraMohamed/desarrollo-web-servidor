<?php
    //vamos a crear una funcion que reciba la temperatura,la unidad
    //inicial y la final, y devuelva la temperatura final


    function convertirTemperatura($temperaturaInicial,$unidadInicial,$unidadFinal){
        $temp = $temperaturaInicial;
        $origen = $unidadInicial;
        $destino = $unidadFinal;
        $resultado = 0;
        if($temp !=""){

            
            // Conversión de Celsius
            if($origen == "celsius"){
                if($destino == "fahrenheit"){
                    $resultado = $temp * 9/5 + 32;
                } elseif($destino == "kelvin"){
                    $resultado = $temp + 273.15;
                }
            }
            // Conversión de Fahrenheit
            elseif($origen == "fahrenheit"){
                if($destino == "celsius"){
                    $resultado = ($temp - 32) * 5/9;
                } elseif($destino == "kelvin"){
                    $resultado = ($temp - 32) * 5/9 + 273.15;
                }
            }
            // Conversión de Kelvin
            elseif($origen == "kelvin"){
                if($destino == "celsius"){
                    $resultado = $temp - 273.15;
                } elseif($destino == "fahrenheit"){
                    $resultado = ($temp - 273.15) * 9/5 + 32;
                }
            }
    
            echo "<p>$temp $origen son $resultado $destino</p>";
        }else{
            echo "<h3>Faltan datos</h3>";
        }
    }
    

    
        
    ?>