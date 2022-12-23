<?php

namespace App\Http\Controllers;

use App\Models\PanierItem;
use App\Models\Voiture;
use App\Models\User;
use App\Models\Modele;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class PanierItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            $userId = Auth::user()->id;

            $items = Cart::content();
           
            if($items){
                $provinces = new Province;
                $provinces = $provinces->all();

                $voitures = array();

                foreach($items as $item) {
                    $voiture_id = $item->id;

                    $voitureDB = new Voiture;
                    $voitureDB = $voitureDB->select()
                                ->where('id', '=', $voiture_id)
                                ->get();

                    $voiture = $voitureDB[0];

                    $modele_marque = new Modele;
                    $modele_marque = $modele_marque->selectModele($voitureDB[0]['modele_id']);
                    $voiture->modele = $modele_marque[0]['modele_nom'];
                    $voiture->marque = $modele_marque[0]['marque_nom'];
                    
                    array_push($voitures, $voiture);
                }
                return view('client/panier.index', ['voitures' => $voitures, 'provinces' => $provinces]);

            }

            else {
                return view('client/panier.index');
            }
            
        }

        else {

            return view('auth.connexion');

        }    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $voiture = Voiture::findOrFail($request->input('voiture_id'));

        $modele_marque = new Modele;
        $modele_marque = $modele_marque->selectModele($voiture->modele_id);

        $modele = $modele_marque[0]['modele_nom'];
        $marque = $modele_marque[0]['marque_nom'];

        $voiture_nom = $marque . ' ' . $modele;
        $voiture_prix = (float)$voiture->prixAchat;

        Cart::add(
            $voiture->id, 
            $voiture_nom, 
            $request->input('quantite'),
            $voiture_prix
        );
        return redirect()->back()->with('message', 'Ajouté');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PanierItem  $panierItem
     * @return \Illuminate\Http\Response
     */
    public function show(PanierItem $panierItem)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PanierItem  $panierItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PanierItem $panierItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PanierItem  $panierItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PanierItem $panierItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PanierItem  $panierItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voiture $voiture)
    {

        foreach(Cart::content() as $row){
          
            if ($voiture->id == $row->id) {
                $rowId = $row->rowId;
                Cart::remove($rowId);
            }

        }
      
        return redirect(route('panier.index'));
    }

    public function reserver(){
        if(Auth::check()) {
            $userId = Auth::user()->id;

            $items = Cart::content();
           
            if($items){
                $provinces = new Province;
                $provinces = $provinces->all();

                $voitures = array();

                foreach($items as $item) {
                    $voiture_id = $item->id;

                    $voitureDB = new Voiture;
                    $voitureDB = $voitureDB->select()
                                ->where('id', '=', $voiture_id)
                                ->get();

                    $voiture = $voitureDB[0];

                    $modele_marque = new Modele;
                    $modele_marque = $modele_marque->selectModele($voitureDB[0]['modele_id']);
                    $voiture->modele = $modele_marque[0]['modele_nom'];
                    $voiture->marque = $modele_marque[0]['marque_nom'];
                    
                    array_push($voitures, $voiture);
                }
                return view('client/panier.reserver', ['voitures' => $voitures, 'provinces' => $provinces]);

            }

            else {
                return view('client/panier.index');
            }
            
        }
    }
}
