<?php

namespace App\Models;

use App\Models\chauffeurs;
use App\Models\commandes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livraisons extends Model
{
    use HasFactory;

    public function chauffeurs()
    {
        return $this->belongsTo(chauffeurs::class, 'chauffeur_id');
    }

    public function commandes()
    {
        return $this->belongsTo(commandes::class, 'commande_id');
    }
}
