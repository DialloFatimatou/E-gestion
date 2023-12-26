<?php

namespace App\Models;

use App\Models\categories;
use App\Models\stations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produits extends Model
{
    use HasFactory;

    public function categorie()
    {
        return $this->belongsTo(categories::class, 'categorie_id');
    }

    public function entrepots()
    {
        return $this->belongsTo(entrepots::class, 'entrepot_id');
    }
}
