<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\entrepots;

class EntrepotsController extends Controller
{
    public function lister()
    {
        $entrepots = entrepots::all();
        return view('entrepots.entrepots', compact('entrepots'));
    }

    public function registerEntrepot(Request $request)
    {
        $request->validate([
            'nomEntrepot' => 'required',
            'adress' => 'required',
            'contact' => 'required'
        ]);
        $entrepot = new entrepots();
        $entrepot->nomEntrepot = $request->input('nomEntrepot');
        $entrepot->emailEntrepot = $request->input('adress');
        $entrepot->contactEntrepot = $request->input('contact');
        $entrepot->save();

        return back()->with('status', 'Entrepot enrégistré avec succès');
    }
}
