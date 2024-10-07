<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <!-- estas lineas de abajo son para que salgan en el navegeador los fallos -->
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <?php
        /* 
        todos los arraus en php son asociativos,como los map
        de java
        tienen pares clave-valor
        */

        $numeros = [5,10,9,6,7,4];//forma de declarar un array
        $numeros = array (6,10,9,4,3);//otra forma de hacer ARRAYS
        print_r($numeros);#PRINT RELACIONAL

        echo "<br><br>";

        $animales = ["Perro","Gato","Ornitorrinco","Suricato","Capibara"];
        $animales = [
            "A01" => "Perro",//la ID solo debe llevar o string o entero 
            "A02" => "Gato",
            "A03" => "Ornitorrinco",
            "A04" => "Suricato",
            "A05" => "Capibara",
        ];
        $animales = array(
            "Perro",//la ID solo debe llevar o string o entero 
            "Gato",
            "Ornitorrinco",
            "Suricato",
            "Capibara",
    );
        //print_r($animales);
        echo "<p>" . $animales[0] . "</p>";
        $animales[3] = "Aurelio";
        print_r($animales);
        $animales["A01"] = "elefante";
        print_r($animales);
        array_push($animales,"cabra","foca");//añadir animales al array y sin clave, se asigna automaticamente

        $animales[] = "Ganso";
        $animales [] = "león";


        unset($animales[1]);//asi borro el valor de esa posicion
        print_r($animales);

        $animales=array_values($animales);//resetea las ID de esa array y se le puede asignar a otra variable
        echo "<br>";

        $cantidad_animales = count($animales);
        echo "<h3>Hay $cantidad_animales animales</h3>";

        /* print_r($animales); */

        /* 
        "4312 FDT" => "Audi TT"
        "1122 FFF" => "Mercedes CLR"

        crear el array cpn 3 coches

        añadir 2 coches con sus matriculas
        añadir 1 coche sin matricula
        borrar el coche sin matricula
        reseteara las claves y almacenar el resultado
        */
        $coches =[
            "4312FDT"=> "Audi TT",
            "112FFF"=> "Mercedes CLR",
            ""=> "Ferrari",
        ];
        $coches["6666SWQ"] = "Seat Ibiza";//añadir coches al array con ID manual
        array_push($coches,"Yala Car");//añadir coche al array con ID automatica
        print_r($coches);
        echo "<br>";
        unset($coches[""]);
        echo "<br>";
        $coches2 = array_values($coches);
        print_r($coches2);
        echo "<br><br>";

        //RECORRE EL ARRAY CON UN FOR
        echo "<h3>Lista de animales con FOR</h3>";
        echo "<ol>";
        for ($i = 0;$i< count($animales);$i++){
            echo "<li>" . $animales[$i] . "</li>";
        }
        echo "</ol>";
        echo "<br>";

        //RECORRE EL ARRAY CON UN WHILE
        echo "<h3>Lista de animales con WHILE</h3>";
        echo "<ol>";
        $contar = 0;
        while($contar < count($animales)){
            echo "<li>" . $animales[$contar] . "</li>";
            $contar++;
        }
        echo "</ol>";
        //RECORRER EL ARRAY CON UN FOREACH
        echo "<h3>Lista de coches con FOREACH</h3>";
        echo "<br><ol>";
        foreach($coches as $coche){
            echo "<li>$coche</li>";
        }
        echo "</ol>";
        //RECORRER EL ARRAY CON UN FOREACH con CLAVE
        echo "<h3>Lista de coches con FOREACH con  CLAVE</h3>";
        echo "<ol>";
        foreach($coches as $Matricula => $coche){
            echo "<li>$Matricula $coche</li>";
        }
        echo "</ol>";
    ?>
    <!-- <table>
        <caption>Coches</caption>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Coche</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2133 FSD</td>
                    <td>Ferrari 355</td>
                </tr>
            </tbody>
    </table> -->
    <table>
        <caption>Coches</caption>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Coche</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    echo "<h3>Lista de coches con FOREACH con  CLAVE y con tablas</h3>";
                    foreach($coches as $Matricula => $coche){
                        echo "<tr>";
                        echo "<td>$Matricula</td>";
                        echo "<td>$coche</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
    </table>

    <h3>Uso recomendable para Bases De Datos</h3>
    <table>
        <caption>Coches</caption>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Coche</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($coches as $matricula => $coche) { ?>
                    <tr>
                        <td><?php echo $matricula ?></td>
                        <td><?php echo $coche ?></td>
                    </tr>
                    <?php } ?>
            </tbody>
    </table>

    <!-- 
        Ejercicio 1
        Desarrollo web en entorno servidor => Alejandra
        Desarrollo web en entorno cliente => Jose miguel
        Diseño de interfaces web => Jose miguel
        Despliegue de aplicaciones => Jaime
        Empresa e iniciativa emprendedora => Andrea
        Inglés => Virginia

        Mostrarlo todo en una tabla
    
    -->
    <table>
        <caption>Coches</caption>
            <thead>
                <tr>
                    <th>Profesor</th>
                    <th>Asignatura</th>
                </tr>
            </thead>
            <tbody>
                <h3>Asignatura</h3>
                <?php
                    $asignaturas =[
                         "Desarrollo web en entorno servidor" => "Alejandra",
                        "Desarrollo web en entorno cliente" => "José Miguel",
                        "Diseño de interfaces web" => "José Miguel",
                        "Despliegue de aplicaciones" => "Jaime",
                        "Empresa e iniciativa emprendedora" => "Andrea",
                        "Inglés" => "Virginia",
                    ];
                    foreach($asignaturas as $profesor => $asignatura) { ?>
                    <tr>
                        <td><?php echo $profesor ?></td>
                        <td><?php echo $asignatura ?></td>
                    </tr>
                    <?php } ?>
            </tbody>
    </table> 
    <!--    EJERCICIO 2
            
            Francisco => 3
            Daniel => 5
            Aurora => 10
            Luis => 7
            Samuel => 9

            MOSTRAR EN UNA TABLA CON 3 COLUMNAS
            - COLUMNA 1: ALUMNO
            - COLUMNA 2: NOTA
            - COLUMNA 3: SI NOTA < 5, SUSPENSO, ELSE, APROBADO
    -->
    <table>
        <caption>Notas</caption>
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Nota</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <h3>Asignatura</h3>
                <color class="rojo">
                <?php
                    
                    $notas =[
                        "Francisco"=> "3",
                        "Daniel"=> "5",
                        "Aurora"=> "10",
                        "Luis"=> "7",
                        "Samuel"=> "9",
                    ];
                    foreach($notas as $alumno => $nota) { 
                    
                    if($nota < 5){
                        echo "<tr class='rojo'>";
                    }else{
                        echo "<tr class='verde'>"; 
                    }
                    ?>
                        <td><?php echo $alumno ?></td>
                        <td><?php echo $nota ?></td>
                        <?php if($nota < 5){
                            echo "<td> Suspenso</td>";
                        }else{
                            echo "<td> Aprobado</td>"; 
                        }?>
                    </tr>
                    <?php } ?>
            </tbody>
    </table> 

    <table>
        <thead>
            <tr>
                <th>Asignatura</th>
                <th>Profesor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /* 
                ESTO SOLO VALE PARA ARRAY NORMALES
                
                sort(): Ordena un array en orden ascendente.
                rsort(): Ordena un array en orden descendente.
                asort(): Ordena un array en orden ascendente y mantiene la asociación de índices.
                arsort(): Ordena un array en orden descendente y mantiene la asociación de índices.
                ksort(): Ordena un array por clave en orden ascendente.
                krsort(): Ordena un array por clave en orden descendente.
               
               */
               
            ksort($asignaturas);
                foreach($asignaturas as $asignatura => $profesor){
                    echo "<tr>";
                    echo "<td>$asignatura</td>";
                    echo "<td>$profesor</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
                <!--
                 Insertar dos nuevos estudiantes con notas aleatorias entre 0 y 10 >>     HECHO
                 
                 borrar un estudiante (el peor que nos caiga) por la clave >>      HECHO
                 
                 Mostrar en una nueva tabla todo ordenado por los nombres en orden alfabeticamente inverso  >>     HECHO
                 
                 Mostrar en una nueva tabla todo ordenado por la nota de 10 a 0(orden inverso)    >>    HECHO
                 -->

                 <!-- $e
                $notas=["Paula"]= rand(0,10);  para añadir un estudiante -->
    <table>
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Nota</th>
                <th>Resultado</th>
            </tr>
            </thead>
            <tbody>
                <h3>Asignatura</h3>
                <?php
                    $random= rand(0,10);
                    $random2= rand(0,10);
                    $notas=[
                        "Francisco"=> "3",
                        "Daniel"=> "5",
                        "Aurora"=> "10",
                        "Luis"=> "7",
                        "Samuel"=> "9",
                        "Aurelio" => $random,
                        "Nuria" => $random2,
                    ];
                    unset($notas["Aurora"]);//BORRANDO UNA PERSONA DEL ARRAY
                    foreach($notas as $alumno=>$nota){
                        if($nota<5) echo "<tr class='rojo'>";  
                        else if($notas >= 5) echo "<tr class='verde'>"; 
                                      
                ?>
                <td><?php echo "$alumno"?></td>
                <td><?php echo "$nota"?></td>
                <?php if($nota>=5) echo "<td>Aprobado</td>";
                    else echo "<td>Suspenso</td>";
                ?>
                </tr>
                <?php } ?>
            </tbody>
        
    </table>
    <table>
        <caption>Estudiantes ordenados por el nombre al revés</caption>
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Nota</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <h3>Asignatura</h3>
            <?php
                $random=rand(0,10);
                $random2=rand(0,10);
                $notas=[
                    "Alejo" => "8",
                    "Jose" => "9",
                    "Aurelio" => $random,
                    "Nuria" => $random2,
                ];
                krsort($notas);//ordenar el array de forma descendiente manteniendo la clave
                foreach($notas as $alumno => $nota){  
                    if($nota <5) echo "<tr class='rojo'>";
                    else  echo "<tr class='verde'>";
            ?>
            <td><?php echo "$alumno"?></td>
            <td><?php echo "$nota"?></td>
            <?php if($nota>=5) echo "<td>Aprobado</td>";
                    else echo "<td>Suspenso</td>"
            ?>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <table>
        <caption>Estudiantes ordenados de menor a mayor la nota</caption>
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Nota</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <h3>Asignatura</h3>
            <?php
                $random = rand(0,10);
                $random2 = rand(0,10);
                $notas=[
                    "Alejo" => "8",
                    "Jose" => "9",
                    "Aurelio" => $random,
                    "Nuria" => $random2,
                ];
                arsort($notas);
                foreach($notas as $alumno => $nota){
                    if($nota < 5) echo "<tr class='rojo'>";
                    else echo "<tr class='verde'>";
                
            ?>
            <td><?php echo "$alumno"?></td>
            <td><?php echo "$nota"?></td>
            <?php if($nota <5) echo "<td>Aprobado</td>";
                else echo "<td>Suspenso</td>";
            ?>
            </tr>
            <?php }?>
        </tbody>
    </table>
</body>
</html>