<?php

namespace App\Http\Controllers;

use App\Models\cmd_produits;
use App\Models\commandes;
use App\Models\produits;
use App\Models\stations;
use Illuminate\Http\Request;

class stationControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allStations()
    {
        $station=stations::all();
        $produit = produits::all();
        return view('stations.allStations', compact(['station','produit']));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function registerStation(Request $request)
    {
        $station=new stations();
            $station-> nomStation = $request-> nom;
            $station-> emailStation = $request-> email;
            $station-> contactStation = $request-> number;

        $station-> save();

        return redirect()->route('allStations');
    }

    /**
     * Display the specified resource.
     */
    public function detailProduit(int $id)
    {
        $station=stations::find($id);
        $produit = produits::all();
        return view('stations.detailStations', compact(['station','produit']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
