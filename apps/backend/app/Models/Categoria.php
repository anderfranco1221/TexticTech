<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "categoria";

    public $resourceType = "categories";

    public $timestamps = false;
    protected $guarded = [];

    protected $fillable = [
        "nombre", "descripcion"
    ];
    
}
