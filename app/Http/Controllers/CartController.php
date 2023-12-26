<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\produits;

class CartController extends Controller
{
    public function addCart($id ){

        $produit=produits::find($id);
       
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($produit->id, $produit->nomProduit, $produit->prixProduit, $produit->imageProduit);
        Session::put('cart', $cart);
        Session::put('topCart',$cart->items);
        
        return  back();
    }
    public function updateqty(Request $resquest ,$id){
         $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->updateQty($id,$resquest->qty);
         Session::put('cart', $cart);
         Session::put('topCart',$cart->items);
         return  back();
     }

     public function removeitem($id){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        Session::put('topCart',$cart->items);
        return  back();
    }

    public function panier(){
        return view('produit.panier_vente');
    }    
}
