<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Articulo;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'nombreDepartamento',  
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
}
