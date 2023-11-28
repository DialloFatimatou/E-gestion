<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\stations;
use Illuminate\Http\Request;
use App\Models\produits;

class produitControllers extends Controller
{
    
    public function createProduit(Request $request, string $station, string $nom)
    {   
        //$code_prod = rand(106890122, 100000000);
        $stations = stations::where('nomStation', $station )->get();
        foreach ($stations as $station) {
            $idSation=$station->id;
        }
        
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/produits/'), $imageName);

        $produit=new produits();
            $produit-> qrProduit = rand(999999999, 100000000);
            $produit-> nomProduit = $request-> nom;
            $produit-> descriptionProduit = $request-> desc;
            $produit-> prixProduit = $request-> prix;
            $produit-> quantiteProduit = $request-> qtite;
            $produit-> categorie_id = $request-> categorie;
            $produit-> station_id = $idSation;
            
            $produit->imageProduit = $imageName;

        $produit-> save();

        return redirect()->route('produitAdmin',['station'=>$produit-> stations-> nomStation, 'nom' =>$nom]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateProduit(Request $request, string $station, string $nom, int $id)
    {
        $stations = stations::where('nomStation', $station )->get();
        foreach ($stations as $station) {
            $idSation=$station->id;
        }
        
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/produits/'), $imageName);


        $produit=produits::find($id);
            $produit-> nomProduit = $request-> nom;
            $produit-> descriptionProduit = $request-> desc;
            $produit-> prixProduit = $request-> prix;
            $produit-> quantiteProduit = $request-> qtite;
            $produit-> categorie_id = $request-> categorie;
            $produit-> station_id = $idSation;
            
            //$produit->imageProduit = $imageName;

        $produit-> update();

        return redirect()->route('produitAdmin',['station'=>$produit-> stations-> nomStation, 'nom' =>$nom]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function editProduit(Request $request, string $station, string $nom, int $id)
    {
        
        $categorie = categories::all();

        return view('update.updateProduit', compact(['categorie','id']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletepProduit(string $station, string $nom, int $id)
    {
        produits::destroy($id);

        return redirect()->route('produitAdmin',['station'=>$station,'nom' =>$nom]);
    }

    // bare de recherche d'un produit d'une station par le nom ou la dessription : au niveau de user
    public function search(Request $request, string $station)
    {
        $categorie = categories::all();
        $q = $request->input('search');
        $produit = produits::where('nomProduit','like',"%$q%")
                ->orWhere('descriptionProduit','like',"%$q%")
                ->paginate(1);
        return view('display.search', compact(['station','categorie','produit']));
    }

    // Affichage des produits de la station de l'utilisateur
    public function homeUser()
    {  
         return view('home.user');
    }
    public function homeAdmin()
    {
        return view('home.admin');
    }

    // Affichage des produits de la station l'admin dans un tableau
    public function produitAdmin(Request $request, string $station)
    {
        $categorie = categories::all();
        $produit=produits::orderByDesc('id')->get();
        return view('display.produits', compact(['station','categorie','produit']));
    }
}
