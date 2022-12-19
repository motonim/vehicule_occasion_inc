<?php

namespace App\Http\Controllers;

use App\Models\PanierItem;
use App\Models\Voiture;
use App\Models\User;
use App\Models\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $voitures = DB::table('panier_items')
                        ->join('voitures', 'panier_items.voiture_id', '=', 'voitures.id')
                        ->where('panier_items.user_id', '=', $userId)
                        ->get();

                foreach ($voitures as $voiture) {
                    $modele_marque = new Modele;
                    $modele_marque = $modele_marque->selectModele($voiture->modele_id);
    
                    $panier_id = new PanierItem;
                    $panier_id = $panier_id->select('id')
                                ->where('panier_items.voiture_id', '=', $voiture->id)
                                ->where('panier_items.user_id', '=', $userId)
                                ->get();
                               
                    $voiture->panier_id = $panier_id[0]['id'];
                    $voiture->modele = $modele_marque[0]['modele_nom'];
                    $voiture->marque = $modele_marque[0]['marque_nom'];
                }

                return view('client/panier.index', ['voitures' => $voitures]);
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
        if(Auth::check()) {
            $userId = Auth::user()->id;

            $panierItem = new PanierItem();
            $panierItem->user_id = $userId;
            $panierItem->voiture_id = $request->voiture_id;

            // if panierItem is already stored in the database, then don't push it to the database
            $check = PanierItem::where('user_id', '=', $userId)
                                ->where('voiture_id', '=', $request->voiture_id);

            if($check->count() > 0) {
                return redirect()->route('panier.index');
            }
            else {

                $panierItem->save();

                return redirect()->route('panier.index');
            }
        }
        else {
            return view('auth.connexion');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PanierItem  $panierItem
     * @return \Illuminate\Http\Response
     */
    public function show(PanierItem $panierItem)
    {
        //
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
    public function destroy(PanierItem $panierItem)
    {
        $panierItem->delete();
        return redirect(route('panier.index'));
    }
}
