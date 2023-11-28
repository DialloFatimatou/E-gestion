<?php

namespace App\Models;

use App\Models\produits;
use App\Models\ventes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vente_produits extends Model
{
    use HasFactory;

    public function produits()
    {
        return $this->belongsTo(produits::class, 'produit_id');
    }

    public function ventes()
    {
        return $this->belongsTo(ventes::class, 'vente_id');
    }
}
