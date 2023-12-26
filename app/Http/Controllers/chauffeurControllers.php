<?php

namespace App\Http\Controllers;

use App\Models\chauffeurs;
use App\Models\livraisons;
use Illuminate\Http\Request;

class chauffeurControllers extends Controller
{
    public function allChauffeur(Request $request){
        $chauffeur = chauffeurs::all();
        $livraison = livraisons::all();

        return view('superAdmin.chauffeur.allChauffeur', compact(['chauffeur','livraison']));
    }

    public function registerChauffeur(Request $request)
    {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/Chauffeurs/'), $imageName);

        $chauffeur=new chauffeurs();
            $chauffeur-> nomC = $request-> nom;
            $chauffeur-> prenomC = $request-> prenom;
            $chauffeur-> photoC = $imageName;
            $chauffeur-> emailC = $request-> email;
            $chauffeur-> contactC = $request-> contact;

        $chauffeur-> save();

        return redirect()->route('allChauffeur');
    }
}
