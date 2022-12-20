<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use App\Models\Transmission;
use App\Models\Carrosserie;
use App\Models\Traction;
use App\Models\Carburant;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Image;
use App\Models\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Resources\VoitureResource;
use Illuminate\Validation\Rules\Exists;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $voiture = Voiture::withFilters(
        //     request()->input('marques', []),
        //     request()->input('modeles', []),
        //     request()->input('kms', [])
        // )->get();

        $voiture = Voiture::select()->where('commande_id', '=', Null)->orderBy('id', 'desc')->withFilters(
            request()->input('marques', []),
            request()->input('modeles', []),
            request()->input('kms', [])
        )->get();

        return VoitureResource::collection($voiture);
    }

    public function vedette()
    {

        //Récuperer l'annee modele et la marque prix des voitures
        $voiture = new Voiture;
        $voiture = $voiture->selectinfos();

        // prendre les 5 dernieres voitures ajouter
        $voiture = $voiture->sortBy('count')->take(6);

        //Envoyer les données a la page d'accueil
        return view('static/accueil', ['voitures' =>  $voiture]);
    }

    /**
     * Display a listing of the resource.
     * CÔTÉ ADMIN
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        //Récuperer le modele et la marque
        $voitureModele = new Voiture;
        $voitures = $voitureModele->selectinfos();

        //Sécuriser le lien vers le formulaire de modification, le mettre accessible que par les privilége 1,2 et  3
        if (Auth::user()->privilege_id ==  4) {

            return redirect('/');
        }
        //Envoyer les données a la page catalogue
        return view('admin/voiture.index', compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Sécuriser le lien vers le formulaire d'ajout', le mettre accessible que par les privilége 1,2 et 3(proprétaire, géstionaire, employé )
         if (Auth::user()->privilege_id ==  4) {

            return redirect('/');
        }
        $transmissions = Transmission::all();
        $carrosseries = Carrosserie::all();
        $tractions = Traction::all();
        $carburants = Carburant::all();
        $modeles = Modele::all();
        $marques = Marque::all();
        return view('admin/voiture.ajout', compact('transmissions', 'carrosseries', 'tractions', 'carburants', 'modeles', 'marques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'km' => 'required|integer',
            'couleur' => 'required|regex:/^[a-zA-Z]+$/u',
            'couleur_en' => 'required|regex:/^[a-zA-Z]+$/u',
            'prixAchat' => 'required|integer',
            'marge' => 'required',
            // 'marque_id' => 'required|integer|exists:marques,id',
            'modele_id' => 'required|integer|exists:modeles,id',
            'transmission_id' => 'required|integer|exists:transmissions,id',
            'carrosserie_id' => 'required|integer|exists:carrosseries,id',
            'traction_id' => 'required|integer|exists:tractions,id',
            'carburant_id' => 'required|integer|exists:carburants,id',
            'imagePrincipale' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'images' => 'required',

        ]);


        $voiture = new Voiture();

        $voiture->annee  = $request->annee;
        $voiture->km  = $request->km;
        $voiture->couleur  = $request->couleur;
        $voiture->couleur_en  = $request->couleur_en;
        $voiture->prixAchat  = $request->prixAchat;
        $voiture->marge = $request->marge;
        $voiture->modele_id  = $request->modele_id;
        $voiture->transmission_id  = $request->transmission_id;
        $voiture->carrosserie_id  = $request->carrosserie_id;
        $voiture->traction_id  = $request->traction_id;
        $voiture->carburant_id  = $request->carburant_id;

        if ($request->file('imagePrincipale')) {
            $fileName = time() . '_' . $request->imagePrincipale->getClientOriginalName();
            $filePath = $request->file('imagePrincipale')->move('assets/img/', $fileName);

            $voiture->imagePrincipale = $fileName;
        }

        $voiture->save();
        $voiture_id = $voiture->id;

        if ($request->file('images')) {

            $images = $request->file('images');

            foreach ($images as $image) {

                $fileName = time() . '_' . $image->getClientOriginalName();
                $filePath = $image->move('assets/img/', $fileName);

                $voiture->voitureImages()->create(([
                    'voiture_id' => $voiture_id,
                    'url' => $fileName
                ]));
            }
        }
        return redirect(route('voiture.liste'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function show(Voiture $voiture)
    {
        if ($voiture->commande_id != Null) {
            return redirect(route('voiture.index'));
        }
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

        //Récuperer les images de la voiture

        $image = new Image;
        $image = $image->selectImage($voiture->id);

        $cart = Cart::content();

        return view('client/voiture.ficheDetail', ['transmissions' =>  $transmission, 'carrosseries' => $carrosserie, 'tractions' => $traction, 'carburants' => $carburant, 'modele' => $modele, 'marque' => $marque, 'voiture' => $voiture, 'images' => $image, 'cart' => $cart]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture)
    {

        //Sécuriser le lien vers le formulaire de modification, le mettre accessible que par les privilége 1,2 et  3(proprétaire, géstionaire, employé )
        if (Auth::user()->privilege_id ==  4) {

            return redirect('/');
        }

        // Sécuriser le lien vers le formulaire de modification, par rapport au statu de la voiture
        if($voiture->commande_id != null ) {
            return redirect('/');
        }

         //Récuperer les information généreaux
         $transmissions = Transmission::all();
         $carrosseries = Carrosserie::all();
         $tractions = Traction::all();
         $carburants = Carburant::all();
         $modeles = Modele::all();
         $marques = Marque::all();
         return view('admin/voiture.modification', compact('transmissions' , 'carrosseries' , 'tractions', 'carburants' , 'modeles' , 'marques' , 'voiture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture)
    {

        $request->validate([
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'km' => 'required|integer',
            'couleur' => 'required|regex:/^[a-zA-Z]+$/u',
            'couleur_en' => 'required|regex:/^[a-zA-Z]+$/u',
            'prixAchat' => 'required|integer',
            'marge' => 'required',
            // 'marque_id' => 'required|integer|exists:marques,id',
            'modele_id' => 'required|integer|exists:modeles,id',
            'transmission_id' => 'required|integer|exists:transmissions,id',
            'carrosserie_id' => 'required|integer|exists:carrosseries,id',
            'traction_id' => 'required|integer|exists:tractions,id',
            'carburant_id' => 'required|integer|exists:carburants,id',
            'imagePrincipale' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'images' => 'required',
        ]);

        $voiture->update([
            "annee" => $request->annee,
            "km" => $request->km,
            "couleur" => $request->couleur,
            "prixAchat" => $request->prixAchat,
            "marge" => $request->marge,
            "marque_id" => $request->marque_id,
            "modele_id" => $request->modele_id,
            "transmission_id" => $request->transmission_id,
            "carrosserie_id" => $request->carrosserie_id,
            "traction_id" => $request->traction_id,
            "carburant_id" => $request->carburant_id,
            "imagePrincipale" => $request->imagePrincipale,
            "images" => $request->images,
        ]);

        //image principlae
        if ($request->file('imagePrincipale')) {
            $fileName = time() . '_' . $request->imagePrincipale->getClientOriginalName();
            $filePath = $request->file('imagePrincipale')->move('assets/img/', $fileName);
            $voiture->imagePrincipale = $fileName;
        }

        $voiture->update();
        $voiture_id = $voiture->id;

        if ($request->file('images')) {

            $images = $request->file('images');

            foreach ($images as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $filePath = $image->move('assets/img/', $fileName);

                $voiture->voitureImages()->create(([
                    'voiture_id' => $voiture_id,
                    'url' => $fileName
                ]));
            }
        }
        return redirect('/dashboard');
    }


    //Suppression des images
    public function destroyImage(int $voiture_image_id)
    {
        //Récuperer l'image de la voiture
        $voitureImage = Image::findOrFail($voiture_image_id);

        //Vérffier le dossier des images et supprimmer l'image de dossier
        $path = 'assets/img/' . $voitureImage->url;

        if (File::exists($path)) {
            File::delete($path);
        }

        //Supprimer l'image de la base de donnée
        $voitureImage->delete();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voiture $voiture)
    {

        if($voiture->voitureImages){
            foreach($voiture->voitureImages as $image){

                $path = 'assets/img/'.$image->url;

                if(File::exists($path)){
                    File::delete($path);
                }

            }
        }
        $voiture->delete();
        return redirect()->back();

    }
}
