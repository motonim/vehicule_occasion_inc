<?php

namespace App\Http\Controllers;

use App\Models\PanierItem;
use App\Models\Voiture;
use App\Models\User;
use App\Models\Modele;
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

        // $panierItems = Cart::with('voiture')->get();
        // $items = Cart::content();
        // ->map(function (Cart $items) {
        //     return (object) [
        //         'id' => $items->voiture_id,
        //         'nom' => $items->voiture_nom,
        //         'quantite' => $items->quantite,
        //         'prix' => $items->voiture_prix,
        //     ];
        // });
        // dd($items);

        if(Auth::check()) {
            $userId = Auth::user()->id;

            $items = Cart::content();
            // ->map(function (Cart $items) {
            //     return (object) [
            //         'id' => $items->voiture_id,
            //         'nom' => $items->voiture_nom,
            //         'quantite' => $items->quantite,
            //         'prix' => $items->voiture_prix,
            //     ];
            // });
            // dd($items);
            if($items){
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
                    // print_r($voiture);
                    // echo "<br>";
                    array_push($voitures, $voiture);
                }
                return view('client/panier.index', ['voitures' => $voitures]);

            }

            else {
                return view('client/panier.index');
            }
            // foreach ($items as $item) {
            //     // $voiture->prixAchat = $voiture->price;
            //     // dd($voiture);
            //     print_r($item->id);
            //     echo"<br>";
            //     $voitureDB = new Voiture;
            //     $voitureDB = $voitureDB->select()
            //                 ->where('id', '=', $voiture->id)
            //                 ->get();

            //     $voiture = $voitureDB[0];
                
            //                 // dd($voitureDB[0]['marge']);
            //     // $voiture->marge = $voitureDB[0]['marge'];
            //     // dd($voitureDB[0]['modele_id']);
            //     // print_r($voiture->imagePrincipale);
            //     // die();
            //     $modele_marque = new Modele;
            //     $modele_marque = $modele_marque->selectModele($voitureDB[0]['modele_id']);

            //     // $panier_id = new PanierItem;
            //     // $panier_id = $panier_id->select('id')
            //     //             ->where('panier_items.voiture_id', '=', $voiture->id)
            //     //             ->where('panier_items.user_id', '=', $userId)
            //     //             ->get();
                           
            //     // $voiture->panier_id = $panier_id[0]['id'];
                
            //     // print_r($voitureDB);
            //     // echo "<br>";
            //     $voiture->modele = $modele_marque[0]['modele_nom'];
            //     $voiture->marque = $modele_marque[0]['marque_nom'];
            //     // print_r($voiture->imagePrincipale);
            //     // echo "<br>";
                
            // }

            // die();
            // return view('client/panier.index', ['voitures' => $voitures]);

            // ---------------------------------- previous version using panier_item table in DB 
            // $voitures = DB::table('panier_items')
            //             ->join('voitures', 'panier_items.voiture_id', '=', 'voitures.id')
            //             ->where('panier_items.user_id', '=', $userId)
            //             ->get();

            //     foreach ($voitures as $voiture) {
            //         $modele_marque = new Modele;
            //         $modele_marque = $modele_marque->selectModele($voiture->modele_id);
    
            //         $panier_id = new PanierItem;
            //         $panier_id = $panier_id->select('id')
            //                     ->where('panier_items.voiture_id', '=', $voiture->id)
            //                     ->where('panier_items.user_id', '=', $userId)
            //                     ->get();
                               
            //         $voiture->panier_id = $panier_id[0]['id'];
            //         $voiture->modele = $modele_marque[0]['modele_nom'];
            //         $voiture->marque = $modele_marque[0]['marque_nom'];
            //     }

            //     return view('client/panier.index', ['voitures' => $voitures]);
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
        // print_r($voiture);
        // echo "<br>";
        // echo "<br>";

        $modele_marque = new Modele;
        $modele_marque = $modele_marque->selectModele($voiture->modele_id);

        $modele = $modele_marque[0]['modele_nom'];
        $marque = $modele_marque[0]['marque_nom'];
        // print_r($modele);
        // print_r($marque);
        $voiture_nom = $marque . ' ' . $modele;
        // print_r($voiture->prixAchat);
        $voiture_prix = (float)$voiture->prixAchat;
        // print_r(is_numeric($voiture_prix) ? 'yes' : 'no');
        // die();
        Cart::add(
            $voiture->id, 
            $voiture_nom, 
            $request->input('quantite'),
            $voiture_prix
        );
        return redirect()->back()->with('message', 'Ajouté');



        
        // if(Auth::check()) {
        //     $userId = Auth::user()->id;

        //     $panierItem = new PanierItem();
        //     $panierItem->user_id = $userId;
        //     $panierItem->voiture_id = $request->voiture_id;

        //     // if panierItem is already stored in the database, then don't push it to the database
        //     $check = PanierItem::where('user_id', '=', $userId)
        //                         ->where('voiture_id', '=', $request->voiture_id);

        //     if($check->count() > 0) {
        //         return redirect()->route('panier.index');
        //     }
        //     else {

        //         $panierItem->save();

        //         return redirect()->route('panier.index');
        //     }
        // }
        // else {
        //     return view('auth.connexion');
        // }
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
        // echo "yes";
        // die();
        // dd($voiture);

        foreach(Cart::content() as $row){
            // print_r($voiture->id);
            // echo"<br>";
            // print_r($row->id);
            // echo"<br>";

            if ($voiture->id == $row->id) {
                $rowId = $row->rowId;
                Cart::remove($rowId);
            }

        }
        // die();
        // Cart::remove($voiture->id);
        // $panierItem->delete();
        return redirect(route('panier.index'));
    }
}
