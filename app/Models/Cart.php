<?php

namespace App\Models;
use Illuminate\Support\Facades\Session;


class Cart
{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add(int $id, $libelle_produit, $prix, $image)
    {
        $storedItem = [
            'qty' => 0,
            'produit_id' => $id,
            'produit_name' => $libelle_produit,
            'produit_price' => $prix,
            'produit_image' => $image
        ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['produit_id'] = $id;
        $storedItem['produit_name'] = $libelle_produit;
        $storedItem['produit_price'] = $prix;
        $storedItem['produit_image'] = $image;
        $this->totalQty++;
        $this->totalPrice += $prix;
        $this->items[$id] = $storedItem;
    }
    public function updateQty($id, $qty)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['produit_price'] * $this->items[$id]['qty'];
        $this->items[$id]['qty'] = $qty;
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['produit_price'] * $qty;
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['produit_price'] * $this->items[$id]['qty'];
        unset($this->items[$id]);
    }

}
