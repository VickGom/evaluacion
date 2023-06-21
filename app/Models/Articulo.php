<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamento;

class Articulo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id', 
        'sku', 
        'articulo', 
        'marca', 
        'modelo', 
        'departamento', 
        'clase', 
        'familia', 
        'stock', 
        'cantidad', 
        'descontinuado', 
        'fechaDeAlta', 
        'fechaBaja',
    ];

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class);
    }
}
