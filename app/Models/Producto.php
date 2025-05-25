<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "codigo",
        "nombre",
        "descripcion",
        "precio",
        "stock",
        "estado",
        "id_categoria",
        "id_usuario"
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
