<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_produits extends Model
{
    use HasFactory;

    public function produits()
    {
        return $this->belongsTo(produits::class, 'produit_id');
    }

    public function appro()
    {
        return $this->belongsTo(approvisionnements::class, 'app_id');
    }
}
