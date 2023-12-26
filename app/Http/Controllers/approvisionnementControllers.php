<?php

namespace App\Http\Controllers;

use App\Models\approvisionnements;
use App\Models\app_produits;
use App\Models\produits;
use App\Models\entrepots;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class approvisionnementControllers extends Controller
{
    public function createAppro(Request $request, string $station, string $nom, int $id)
    {
        $produits=produits::find($id);
        return view('approvisionnement.createApprovi', compact(['station', 'nom','produits']));
    }

    public function panierAppro(Request $request, string $station, string $nom, int $id)
    {
        $produit=produits::find($id);
        Cart::add(array(
            'id' => $produit->id,
            'name' => $produit->nomProduit,
            'price' => $produit->prixProduit,
            'qty' => $request->qtite,
            'attributes'=>array()
        ));
        session_start();
        return redirect()->route('detailAppro', ['station'=>$station, 'nom'=>$nom]);
    }

    public function detailAppro(string $station, string $nom){
        $produits=produits::all();
        $panier_cmd=Cart::content();
        return view('approvisionnement.detailAppro', compact(['panier_cmd','produits']));
    }

    public function saveAppro(Request $request, string $station, string $nom)
    {
        $cart = Cart::content();

        $vente=new approvisionnements();
        $vente->save();

        foreach($cart as $i){
            $app_Produit=new app_produits();
                $app_Produit-> quantiteCmdProd = $request-> qtite[$i->id];
                $app_Produit-> produit_id = $request-> id[$i->id];
                $app_Produit-> app_id = $vente->id;
            $app_Produit->save();
            
        };
        Cart::destroy($cart);

        return redirect()->route('allApprovi', ['station'=>$station,'nom'=>$nom]);
    }
    public function displayAppro(Request $request, string $station, string $nom)
    {
        $stat = entrepots::all();
        $produit = produits::all();
        $app = approvisionnements::all();
        $app_prod = app_produits::all();

        foreach($stat as $var){
            if($var->nomStation == $station) $station_id = $var->id;
        }
        return view('approvisionnement.displayApprovi', compact(['station_id','stat','app','produit','app_prod']));
    }

    public function allApprovi(Request $request)
    {
        $approvi=app_produits::all();
        return view('approvisionnement.allAppro', compact(['approvi']));
    }
}
