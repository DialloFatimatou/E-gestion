<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cmd_livres extends Model
{
    use HasFactory;

    public function produits()
    {
        return $this->belongsTo(produits::class, 'produit_id');
    }

    public function livraisons()
    {
        return $this->belongsTo(livraisons::class, 'livraison_id');
    }
}
