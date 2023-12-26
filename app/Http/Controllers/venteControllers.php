<?php

namespace App\Http\Controllers;

use App\Models\entrepots;
use App\Models\produits;
use App\Models\stations;
use App\Models\ventes;
use App\Models\vente_produits;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class venteControllers extends Controller
{
    // public function panierVente(Request $request, string $station, string $nom, int $id)
    // {
    //     $produit=produits::find($id);
    //     Cart::add(array(
    //         'id' => $produit->id,
    //         'name' => $produit->nomProduit,
    //         'price' => $produit->prixProduit,
    //         'qty' => $request->qtite,
    //         'attributes'=>array()
    //     ));
    //     session_start();
    //     return redirect()->route('ventePanier', ['station'=>$station, 'nom'=>$nom]);
    // }

    // public function ventePanier(string $station, string $nom){
    //     $produits=produits::all();
    //     $panier_cmd=Cart::content();
    //     return view('vente.panierVente', compact(['panier_cmd','produits']));
    // }
   

    public function registerVenteProduit(Request $request)
    {

        $cart = Session::get('topCart');

        
        // dd($cart);
        $vente = new ventes();
        $vente->save();

        foreach ($cart as $i) {
            if (isset($i['produit_id'])) {
            
                $venteProduit = new vente_produits();

                $produit=produits::find($request->id[$i['produit_id']]);
                $produit=$produit->id;
                $venteProduit->quantiteVente = $request->qty[$produit];
                $venteProduit->produit_id = $request->id[$produit];
                $venteProduit->vente_id = $vente->id;

                $venteProduit->save();
            }
        };
        
        foreach ($cart as $i) {
            $produit = produits::find($request->id[$i['produit_id']]);
            $produit->quantiteProduit = ($produit->quantiteProduit - $request->qty[$i['produit_id']]);
            $produit->update();
        };
        // $oldCart = Session::has('topCart') ? new Cart($cart) : null;

        return redirect()->route('homeUser');
    }


    public function allVente(string $station, string $nom)
    {
        $stat = entrepots::all();
        $produit = produits::all();
        $vente = ventes::all();
        $vente_prod = vente_produits::all();

        foreach ($stat as $var) {
            if ($var->nomStation == $station) $station_id = $var->id;
        }
        return view('vente.allVente', compact(['station_id', 'stat', 'vente', 'produit', 'vente_prod']));
    }
}
