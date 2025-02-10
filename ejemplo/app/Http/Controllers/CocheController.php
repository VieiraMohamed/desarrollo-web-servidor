<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index () {
        $coches = [
            "Mazda RX7",
            "Mercedes CLA",
            "Ford Mustang",
            "Peugeot 307 MS",
            "Fiat Multipla",
            "Citroen C15",
            "Mitsubichi Pajero"
        ];
        return view('coches', ['coches' => $coches]);
    }
    /* 
    CREAR UN CONTROLADOR MarcaController que contenga una lista 
    de marcas y mostrarlas en la vista marcas.blade.php

MODIFICAR EL CONTROLADOR CocheController para que en 
vez de tener una lista de coches, sea una tabla con el 
modelo del coche, su marca y su precio
    */

}
