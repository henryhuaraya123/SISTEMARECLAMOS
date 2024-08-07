<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Informe;


class InformeController extends Controller
{
    public function store(Request $request, $id)
    {
       
        $rutaRed = '\\servidor\carpeta_compartida';
        //$nombreArchivo = $request->file('pagina_escaneada')->getClientOriginalName();
        $rutaCompleta = $rutaRed . '\\' . $nombreArchivo;

        //ruta de la carpeta compartida
        $request->file('pagina_escaneada')->move($rutaRed, $nombreArchivo);

        // Guarda los datos
        $informe = new Informe();
        $informe->fecha_informe = now();
        $informe->ruta = $rutaCompleta;
        $informe->verificacion_id = $id;
        $informe->save();
        
        return redirect()->back();
    }
}
