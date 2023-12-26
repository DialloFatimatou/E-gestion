<?php

namespace App\Models;

use App\Models\produits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approvisionnements extends Model
{
    use HasFactory;

    public function produits()
    {
        return $this->belongsTo(produits::class, 'produit_id');
    }
}
