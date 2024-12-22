<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name']; //Columnas que pueden ser llenadas masivamente

    // Relación con Transacciones: Una categoria tiene muchas transacciones
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
