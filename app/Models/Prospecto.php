<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    use HasFactory;
    //Aqui el modelo tiene acceso a la estructura de la tabla
    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'calle',
        'numero',
        'colonia',
        'codigo_postal',
        'telefono',
        'rfc',
        'status',
        'observacion',
    ];
    
    //Aqui se encuentra la relacion con la tabla archivos
    public function archivo()
    {
        return $this->hasMany(Archivo::class);
    }
}
