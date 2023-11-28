<?php

namespace App\Http\Controllers;

use App\Models\cmd_produits;
use App\Models\commandes;
use App\Models\livraisons;
use App\Models\produits;
use App\Models\stations;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class commandeControllers extends Controller
{
    public function editCmdProduit(Request $request, string $station, string $nom, int $id)
    {
        $produits=produits::find($id);

        return view('commande.editCmdProduit', compact(['id','produits']));
    }
    public function cmdProduit(Request $request, string $station, string $nom, int $id)
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
        return redirect()->route('panier_cmd', ['station'=>$station, 'nom'=>$nom]);
    }

    public function panier_cmd(string $station, string $nom){
        $produits=produits::all();
        $panier_cmd=Cart::content();
        return view('display.panier_cmd_prod', compact(['panier_cmd','produits']));
    }
    public function valide_panier_cmd(string $station, string $nom){
        $panier_cmd=Cart::content();
        return view('display.panier_cmd_prod', compact(['panier_cmd']));
    }

    public function registerCmdProduit(Request $request, string $station, string $nom){

        $cart = Cart::content();

        $cmd=new commandes();
            $cmd-> statutCmd ="En attente";
        $cmd->save();

        foreach($cart as $i){
            $produit=new cmd_produits();
                $produit-> statutCmdProd = "En attente";
                $produit-> quantiteCmdProd = $request-> qtite[$i->id];
                $produit-> produit_id = $request-> id[$i->id];
                $produit-> commande_id = $cmd->id;
            $produit->save();
            
        };
        Cart::destroy($cart);

        return redirect()->route('displayCmdProduit',['station'=>$station,'nom'=>$nom]);
    }

    public function displayCmdProduit(string $station, string $nom){
        $stat=stations::all();
        $produit=produits::all();
        $cmd = commandes::all();
        $cmd_prod = cmd_produits::all();

        foreach($stat as $var){
            if($var->nomStation == $station) $station_id = $var->id;
        }
        return view('commande.attenteCmd', compact(['station_id','cmd','produit','stat','cmd_prod']));
    }

    public function CmdValideProduit(string $station, string $nom){
        $stat=stations::all();
        $produit=produits::all();
        $cmd = commandes::all();
        $cmd_prod = cmd_produits::all();

        foreach($stat as $var){
            if($var->nomStation == $station) $station_id = $var->id;
        }
        return view('commande.cmdValide', compact(['station_id','cmd','produit','stat','cmd_prod']));
    }

    public function detailCmdProduit(string $station, string $nom, int $id){
        $cmd = cmd_produits::where('commande_id', $id )->get();
        return view('commande.detailCmd', compact(['station','cmd']));
    }

    public function detailCommande(int $id)
    {
        $cmd_prod = cmd_produits::where('commande_id', $id )->get();
        return view('commande.detailCommande', compact(['cmd_prod']));
    }

    public function cmdEffectuer()
    {
        $en_attente_orders = cmd_produits::whereHas('commandes', function ($query) {
            $query->where('statutCmd', 'Valider');
        })
        ->with(['commandes', 'produits.stations'])
        ->get();

        // Group orders by station and eliminate duplicate orders
        $orders_by_station = [];
        foreach ($en_attente_orders as $cmd_produits) {
            $station = $cmd_produits->produits->stations->nomStation;
            $orders_by_station[$station][$cmd_produits->commande_id] = $cmd_produits->commandes;
        }

        $cmd_prod = cmd_produits::all();
        return view('commande.cmdEffectuer', compact(['orders_by_station','cmd_prod']));
    }

    public function cmdEnAttente()
    {
        $en_attente_orders = cmd_produits::whereHas('commandes', function ($query) {
            $query->where('statutCmd', 'En attente');
        })
        ->with(['commandes', 'produits.stations'])
        ->get();

        // Group orders by station and eliminate duplicate orders
        $orders_by_station = [];
        foreach ($en_attente_orders as $cmd_produits) {
            $station = $cmd_produits->produits->stations->nomStation;
            $orders_by_station[$station][$cmd_produits->commande_id] = $cmd_produits->commandes;
        }
        $cmd_prod = cmd_produits::all();
        // dd($orders_by_station);die();
        return view('commande.cmdEnAttente', compact(['orders_by_station','cmd_prod']));
    }   
    
    // validation des commandes pour le super_admin
    public function adminValideCmd(Request $request, int $id){

        $prod = cmd_produits::where('commande_id', $id )->get();

        foreach($prod as $i){
            $produit=new cmd_produits();
                $produit-> statutCmdProd = "Valider";
                $produit-> quantiteCmdProd = $request-> qtite[$i->id];
                $produit-> produit_id = $request-> id[$i->id];
            $produit->update();
        };

        $cmd=commandes::find($id);
            $cmd-> statutCmd ="Valider";
        $cmd->update();

        return redirect()->route('cmdEffectuer');
    }
}
