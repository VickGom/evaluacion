<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Departamento;
use App\Models\Clase;
use App\Models\Familia;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ArticuloController extends Controller
{
    public function buscarSku($sku){

        $articulo = Articulo::where('sku', $sku)->first();

        if ($articulo) {
            return response()->json(['message' => 'Articulo encontrado'], 200);
          } else {
            return response()->json(['message' => 'SKU no encontrado'], 404);
        }
    }

    public function mostrarArticulo($sku){

        $articulo = Articulo::where('sku', $sku)->first();
        $departamento = Departamento::where('id', $articulo->departamento)->first();
        $departamento = Departamento::where('id', $articulo->departamento)->first();
        $departamentos = Departamento::All();
        $clase = Clase::where('id', $articulo->clase)->first();
        $familia = Familia::where('id', $articulo->familia)->first();
        $clases = Clase::where('numeroDepartamento', $articulo->clase)->get();
        $familias = Familia::where('numeroClase', $clase->numeroClase)->get();
        
        
        if ($articulo) {
            return response()->json(['articulo' => $articulo,
                                     'departamento' => $departamento,
                                     'departamentos' => $departamentos,
                                     'clase' => $clase,
                                     'familia' => $familia,
                                     'clases' => $clases,
                                     'familias' => $familias]);
        } else {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }

    }

    public function obtenerClase($departamento){
        $clase = Clase::where('numeroDepartamento', $departamento)->get();

        if ($clase) {
            return response()->json(['clases' => $clase]);
        } else {
            return response()->json(['error' => 'clases no encontradas'], 404);
        }

    }
    public function obtenerFamilia($clase){
        $claseId = Clase::where('id', $clase)->first();
        $familia = Familia::where('numeroClase', $claseId->numeroClase)->get();


        if ($clase) {
            return response()->json(['familias' => $familia]);
        } else {
            return response()->json(['error' => 'familias no encontradas'], 404);
        }

    }

    public function obtenerDepartamento(){
        $departamentos = $departamentos = Departamento::All();

        if ($departamentos) {
            return response()->json(['departamentos' => $departamentos]);
        } else {
            return response()->json(['error' => 'departamentos no encontrados'], 404);
        }

    }

    public function modificar(Request $request){

        $selectedDepartamento = $request->input('selectedDepartamento');
        $selectedFamilia = $request->input('selectedFamilia');
        $selectedClase = $request->input('selectedClase');

        $articulo = Articulo::find($request->id);
        $claseId = Clase::where('id', $selectedClase)->first();
        if (!$articulo) {
            return  response()->json(['error' => 'articulo no encontrado'], 402);
        }

        $articulo->sku = $request->sku;
        $articulo->articulo = $request->articulo;
        $articulo->marca = $request->marca;
        $articulo->modelo = $request->modelo;
        $articulo->departamento = $selectedDepartamento ?? $request->departamento;
        $articulo->clase = $claseId->id;
        $articulo->familia = $selectedFamilia ?? $request->familia;
        $articulo->stock = $request->stock;
        $articulo->cantidad = $request->cantidad;
        $articulo->descontinuado = $request->descontinuado;
        $articulo->fechaDeAlta = $request->fechaDeAlta;

        if ($request->descontinuado == true){
            $articulo->fechaBaja = Carbon::now();
        } else {
            $articulo->fechaBaja =$request->fechaBaja;
        }

        $articulo->save();

        return  response()->json(['success' => 'Articulo actualizado'], 200);

    }

    public function agregar(Request $request){

        $selectedDepartamento = $request->input('selectedDepartamento');
        $selectedFamilia = $request->input('selectedFamilia');
        $selectedClase = $request->input('selectedClase');

        $articulo = new Articulo();

        $articulo->sku = $request->sku;
        $articulo->articulo = $request->articulo;
        $articulo->marca = $request->marca;
        $articulo->modelo = $request->modelo;
        $articulo->departamento = $selectedDepartamento;
        $articulo->clase = $selectedClase;
        $articulo->familia = $selectedFamilia;
        $articulo->stock = $request->stock;
        $articulo->cantidad = $request->cantidad;
        $articulo->descontinuado = 0;
        $articulo->fechaDeAlta = Carbon::now();
        $articulo->fechaBaja = "1900-01-01";

        $articulo->save();

        return  response()->json(['success' => "Articulo agregado"], 200);

    }

    public function eliminar($sku){

        $articulo = Articulo::where('sku', $sku)->first();

        if ($articulo) {
            $articulo->delete();
            return  response()->json(['success' => 'Articulo eliminado'], 200);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el articulo'], 404);
        }

    }

    public function mostrarTodo(){
        $articulo = Articulo::All();
        
        if ($articulo) {
            return response()->json(['articulo' => $articulo]);
        } else {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }

    }
}
