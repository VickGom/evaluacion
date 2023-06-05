<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospecto;
use Illuminate\Support\Facades\Validator;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;

class ProspectoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'primer_apellido' => 'required',
            'calle' => 'required',
            'numero' => 'required',
            'colonia' => 'required',
            'codigo_postal' => 'required',
            'telefono' => 'required',
            'rfc' => 'required',
            'archivos' => 'required|array',
            'archivos.*' => 'required|file',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Crear un nuevo prospecto con los datos recibidos
        $prospecto = new Prospecto();
        $prospecto->nombre = $request->nombre;
        $prospecto->primer_apellido = $request->primer_apellido;
        $prospecto->segundo_apellido = $request->segundo_apellido;
        $prospecto->calle = $request->calle;
        $prospecto->numero = $request->numero;
        $prospecto->colonia = $request->colonia;
        $prospecto->codigo_postal = $request->codigo_postal;
        $prospecto->telefono = $request->telefono;
        $prospecto->rfc = $request->rfc;
        $prospecto->status = "Enviado";
        $prospecto->save();

        $prospectoId = $prospecto->id;
        $archivos = $request->files->get('archivos');

        if ($archivos) {
            foreach ($archivos as $archivo) {
                $nombreArchivo = $archivo->getClientOriginalName();
                $rutaArchivo = Storage::disk('public')->putFileAs('public/storage', $archivo, $nombreArchivo);

                $documento = new Archivo();
                $documento->prospecto_id = $prospectoId;
                $documento->nombre = $nombreArchivo;
                $documento->ruta = $rutaArchivo;
                $documento->save(); 
            }

        }

        return response()->json(['message' => 'Prospecto creado exitosamente'], 201);
    
    }

    public function index(){
        $prospectos = Prospecto::all();

        return response()->json($prospectos);
    }

    public function informacion($id){
        return view('informacion', compact('id'));
    }

    public function evaluar($id){
        return view('evaluacion_prospecto', compact('id'));
    }

    public function obtenerInformacion($id){
        
        $prospecto = Prospecto::with('archivo')->find($id);

        if (!$prospecto) {
            return response()->json(['error' => 'No se encontró el prospecto'], 404);
        }

        return response()->json($prospecto);
        
    }

    public function download($filename){
        $path = "file:///C:/xampp/htdocs/evaluacion/storage/app/public/public/storage/" . $filename;

        if (file_exists($path)) {
            return response()->download($path, $filename);
        } else {
            abort(404);
        }
        
    }

    public function cambiarStatus(Request $request){
        $id = $request->input('id');
        $prospecto = Prospecto::find($id);

        if (!$request->observacion) { 
            $status = $request->input('status');
            $prospecto->status = $status;
            $prospecto->save();
            return response()->json(['message' => 'Status cambiado exitosamente'], 201);
        } else {
            $observacion = $request->input('observacion');
            $prospecto->observacion = $observacion;
            $prospecto->status = "Rechazado";
            $prospecto->save();
            return response()->json(['message' => 'Status cambiado exitosamente'], 201);
        }
    }

}
