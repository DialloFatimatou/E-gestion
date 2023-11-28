<?php

namespace App\Http\Controllers;

use App\Models\produits;
use App\Models\stations;
use App\Models\ventes;
use App\Models\vente_produits;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class venteControllers extends Controller
{
    public function panierVente(Request $request, string $station, string $nom, int $id)
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
        return redirect()->route('ventePanier', ['station'=>$station, 'nom'=>$nom]);
    }

    public function ventePanier(string $station, string $nom){
        $produits=produits::all();
        $panier_cmd=Cart::content();
        return view('vente.panierVente', compact(['panier_cmd','produits']));
    }

    public function registerVenteProduit(Request $request, string $station, string $nom){

        $cart = Cart::content();

        $vente=new ventes();
        $vente->save();

        foreach($cart as $i){
            $venteProduit=new vente_produits();
                $venteProduit-> quantiteVente = $request-> qtite[$i->id];
                $venteProduit-> produit_id = $request-> id[$i->id];
                $venteProduit-> vente_id = $vente->id;
            $venteProduit->save();
            
        };
        Cart::destroy($cart);

        return redirect()->route('homeUser',['station'=>$station,'nom'=>$nom]);
    }

    public function allVente(string $station, string $nom){
        $stat = stations::all();
        $produit = produits::all();
        $vente = ventes::all();
        $vente_prod = vente_produits::all();

        foreach($stat as $var){
            if($var->nomStation == $station) $station_id = $var->id;
        }
        return view('vente.allVente', compact(['station_id','stat','vente','produit','vente_prod']));
    }
}
