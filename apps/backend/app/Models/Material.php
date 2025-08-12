<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = "material";
    public $resourceType = 'materials';

    protected $guarded = [];

    protected $fillable = [
        "codigo",
        "nombre",
        "descripcion",
        "estado",
        "stock",
        "unidad"
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}
