<?php

namespace App\Models;

use App\Models\categories;
use App\Models\stations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produits extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(categories::class, 'categorie_id');
    }

    public function stations()
    {
        return $this->belongsTo(stations::class, 'station_id');
    }
}
