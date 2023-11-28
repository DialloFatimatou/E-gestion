<?php

namespace App\Http\Controllers;

use App\Models\cmd_livres;
use App\Models\cmd_produits;
use App\Models\livraisons;
use Illuminate\Http\Request;

class livraisonControllers extends Controller
{
    public function livraisonChauffeur(Request $request, $id){
        $livraison = livraisons::where('chauffeur_id', $id )->get();
        $cmd_livraison = cmd_livres::all();

        return view('chauffeur.livraisonChauffeur', compact(['livraison', 'cmd_livraison']));
    }

    public function toutesLivraison(Request $request){
        $cmd_livraison = cmd_livres::all();
        $produit = cmd_produits::all();

        return view('livraison.adminLivraison', compact(['cmd_livraison','produit']));
    }
}
