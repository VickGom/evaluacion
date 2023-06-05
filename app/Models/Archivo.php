<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    //Aqui el modelo tiene acceso a la estructura de la tabla
    protected $fillable = ['nombre_documento', 'ruta_archivo'];

    //Aqui se encuentra la relacion con la tabla prospecto
    public function prospecto()
    {
        return $this->belongsTo(Prospecto::class);
    }
}
