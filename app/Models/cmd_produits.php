<?php

namespace App\Models;

use App\Models\commandes;
use App\Models\produits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cmd_produits extends Model
{
    use HasFactory;

    public function produits()
    {
        return $this->belongsTo(produits::class, 'produit_id');
    }

    public function commandes()
    {
        return $this->belongsTo(commandes::class, 'commande_id');
    }
}
