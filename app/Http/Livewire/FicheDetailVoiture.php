<?php

namespace App\Http\Livewire;

use App\Models\Voiture;
use App\Models\Transmission;
use App\Models\Carrosserie;
use App\Models\Traction;
use App\Models\Carburant;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Image;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class FicheDetailVoiture extends Component
{
    public $voiture;

    public function mount(Voiture $voiture)
    {
        // dd($id);
        // $this->voiture = $voiture;
        // dd($voiture);

        // if ($voiture->commande_id != Null) {
        //     return redirect(route('voiture.index'));
        // }

        //Récuperer les nom de transsmission, carrosserie, traction et carburant
        $transmission =  new Transmission;
        $transmission = $transmission->selectTransmission($voiture->transmission_id);

        $carrosserie =  new Carrosserie;
        $carrosserie = $carrosserie->selectCarrosserie($voiture->carrosserie_id);

        $traction =  new Traction;
        $traction = $traction->selectTraction($voiture->traction_id);

        $carburant =  new Carburant;
        $carburant = $carburant->selectCarburant($voiture->carburant_id);

        //Récuperer le nom de la marque et modele
        $modele_marque = new Modele;
        $modele_marque = $modele_marque->selectModele($voiture->modele_id);

        $modele = $modele_marque[0]['modele_nom'];
        $marque = $modele_marque[0]['marque_nom'];

        // dd($marque);

        //Récuperer les images de la voiture

        $image = new Image;
        $image = $image->selectImage($voiture->id);

        $cart = Cart::content();

        // dd($cart);

        // return view('livewire.fiche-detail-voiture', ['cart' => $cart]);
        return view('livewire.fiche-detail-voiture', compact('transmission', 'carrosserie', 'traction', 'carburant', 'modele', 'marque', 'voiture', 'image', 'cart'));
    }
}
