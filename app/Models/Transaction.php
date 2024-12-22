<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['type', 'category_id', 'amount', 'description', 'date'];

    // Relación con Categorías: Una transacción pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
