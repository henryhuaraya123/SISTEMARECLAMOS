<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Auth;
use \App\Models\Verificacion;
use Carbon\Carbon;

class VerificacionController extends Controller
{
    public function index()
    {
        $verificaciones = Verificacion::orderBy('id', 'DESC')->paginate(10);
        $filtro = 'none';
        return view('verificaciones', compact('verificaciones','filtro'));
    }

    public function store(Request $request)
    {
        $nueva_verificacion = new Verificacion;

        $nueva_verificacion->nombre_completo = $request->input('nombre_completo');
        $nueva_verificacion->dni = $request->input('dni');
        $nueva_verificacion->suministro = $request->input('suministro');
        $nueva_verificacion->celular = $request->input('celular');
        $nueva_verificacion->direccion = $request->input('direccion');
        $nueva_verificacion->ruta = $request->input('ruta');
        $nueva_verificacion->latitud = $request->input('latitud');
        $nueva_verificacion->longitud = $request->input('longitud');

        // Obtener la fecha actual
        $fechaActual = Carbon::now();

        // Sumar 10 días a la fecha actual
        $fechaFutura = $fechaActual->addDays(10);

        $nueva_verificacion->fecha_fin = $fechaFutura;
        $nueva_verificacion->tipo = $request->input('tipo');
        $nueva_verificacion->estado = "PENDIENTE DE ENTREGA";

        $nueva_verificacion->save();

        return redirect()->back();
    }

    public function generardocumento($id)
    {
        // Buscar el elemento en la base de datos usando el ID
        $item = Verificacion::find($id);

        if ($item) {

            $templatePath = public_path('verificacionplantilla.docx');
            $templateProcessor = new TemplateProcessor($templatePath);

            $templateProcessor->setValue('tipo', $item->tipo);
            
            $templateProcessor->setValue('nombre',$item->nombre_completo);
            $templateProcessor->setValue('dni', $item->dni);
            $templateProcessor->setValue('celular', $item->celular);
            $templateProcessor->setValue('direccion', $item->direccion);
            $templateProcessor->setValue('suministro',$item->suministro);
            $templateProcessor->setValue('ruta', $item->ruta);
            $templateProcessor->setValue('latitud',$item->latitud);
            $templateProcessor->setValue('longitud',$item->longitud);
            $templateProcessor->setValue('fecha',$item->created_at->format('Y-m-d'));
            $templateProcessor->setValue('user', Auth::user()->name);

            $tempFile = tempnam(sys_get_temp_dir(), 'word');
            $templateProcessor->saveAs($tempFile);

            $content = file_get_contents($tempFile);

            unlink($tempFile);

            return response($content)
            ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
            ->header('Content-Disposition', 'attachment; filename="' . $item->nombre_completo . '.docx"')
            ->header('Content-Transfer-Encoding', 'binary')
            ->header('Content-Length', strlen($content));

        } else {
            return response()->json(['mensaje' => 'Elemento no encontrado'], 404);
        }
    }

    public function eliminar($id)
    {
        $item = Verificacion::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query'); 

        
        if ($query) {
            $verificaciones = Verificacion::where('nombre_completo', 'like', "%$query%")
                        ->orWhere('suministro', 'like', "%$query%")
                        ->orWhere('dni', 'like', "%$query%")
                        ->orWhere('ruta', 'like', "%$query%")
                        ->orWhere('estado', 'like', "%$query%")
                        ->orWhere('tipo', 'like', "%$query%")
                        ->orderBy('id', 'DESC')->paginate(10);
        } else {
            $verificaciones = Verificacion::all();
        }
        $filtro = '';
        return view('verificaciones', compact('verificaciones','filtro'));
    }


}
