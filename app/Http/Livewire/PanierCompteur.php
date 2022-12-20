<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;


class PanierCompteur extends Component
{
    public function render()
    {
        $compter_panier_items = Cart::content()->count(); 
        return view('livewire.panier-compteur', ['compter_panier_items' => $compter_panier_items]);
    }

}
