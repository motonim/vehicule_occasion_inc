<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Voiture;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use PDF;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesCommandes = Commande::select()->where('user_id', Auth::user()->id)->get();

        // Boucler dans les commande du client
        foreach($mesCommandes as $maCommande) {

            // récupérer les données des voitures
            $voitures = Voiture::select()->where('commande_id', $maCommande->id )->get();

            // Prix sous-total
            $prixSousTotal = 0;

            // Boucler dans les voitures d'une commande
            foreach ($voitures as $voiture) {

                // Calcul du prix de vente de la voiture
                $prix = $voiture->prixAchat * $voiture->marge;

                // Ajout au prix sous-total à chaque tour de boucle
                $prixSousTotal = $prixSousTotal + $prix;

            }

            // Récupérer le nombre de voitures pour chaque commande
            $nbVoitures = $voitures->count();
            $maCommande->nbVoitures = $nbVoitures;

            // Récupérer le prix total pour chaque commande
            $maCommande->prixTotal = $prixSousTotal * 1.15;

        }

        $user = Auth::user();

        return view('client/commande.index', compact('mesCommandes', 'user'));
    }

    public function reserver()
    {
        return view('client/commande.caisse-reserver');
    }


    //Méthoode pour récuperer la liste des commandes les afficher coté admin
    public function liste()
    {
        //Sécuriser le lien vers le formulaire de modification, le mettre accessible que par les privilége 1,2 et  3(proprétaire, géstionaire, employé )
        if (Auth::user()->privilege_id ==  4) {

            return redirect('/');
        }
        //Récuperer toute les commandes et les envoyer à page commande paneau admin
        $commandes = Commande::all();
       
        // dd($commandes);
        // Suppression de commande réservé aprés 24h de création
        $dateActuel = Carbon::now()->timestamp; 
        
       foreach($commandes as $commande){

            $statut =  $commande->selectStatut;
            $dateCreation = $commande->created_at ;

            //Déterminer le temps de réservation à 24h 
            $dateCreation = $dateCreation->timestamp + 86400;                 
            //Si la commande réservée à dépasser 24h elle sera supprimée automatiquement
            if( $statut->id == 1 && ( $dateCreation < $dateActuel) ){
                
                $commande->delete();
            }
    }  
         return view('admin/commande.index', compact('commandes'));
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
        $request->validate([
            'courriel' => 'required|email',
            'prenom' => 'required|min:2|max:191',
            'nom' => 'required|min:2|max:191',
            'adresse' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'infoSupp' => 'regex:/([- ,\/0-9a-zA-Z]+)/',
            'ville' => 'required|string',
            'province' => 'required|integer',
            'code_postal' => 'required|regex:/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12'
        ]);

        $user = Auth::user()->id;
       
        // générer le numeroDeCommande aléatoire
        do {
            $numeroDeCommande = random_int(100000000, 199999999);
        } while (Commande::where("numeroDeCommande", "=", $numeroDeCommande)->first());

        $commande = new Commande;
        $commande->expedition_id = $request->expedition_id;
        $commande->statut_id = $request->statut_id;
        $commande->paiement_id = $request->paiement_id;
        $commande->numeroDeCommande = $numeroDeCommande;
        $commande->user_id = $user;
        $commande->courriel = $request->courriel;
        $commande->prenom = $request->prenom;
        $commande->nom = $request->nom;
        $commande->adresse = $request->adresse;
        $commande->ville = $request->ville;
        $commande->province = $request->province;
        $commande->code_postal = $request->code_postal;
        $commande->telephone = $request->telephone;
        
        $commande->save();

        $commandeId = $commande->id;

        // metter à jour la table voiture avec commande_id
        $voitureIds = $request->metadata;
        for($i = 0; $i < count($voitureIds); $i++) {
            DB::table('voitures')
                ->where('id', '=', $voitureIds[$i])
                ->update([
                    'commande_id' => $commandeId
                ]);
           
        }

        if($commande->expedition_id == 3) {
            $clientNom = $commande->nom;
            $email = $commande->courriel;

            $prixSousTotal = 0;
            //Récuperer le prix d'achat
            foreach($commande->VoitureCommandes as $voitureInfos){

                //Calculer la marge
                $prix = $voitureInfos->prixAchat * $voitureInfos->marge;

                //Calculer le sous total des voitures dans la commande
                $prixSousTotal = $prixSousTotal + $prix;

            }
            //Calculer le prix total (avec tax)
            $prixTotal = $prixSousTotal * 1.15;

            //Récuperer les information des voiture qui sont dans la commandes
            $voiture = new Voiture;
            $voituresCommandes = $voiture->voitureCommande($commande->id);
            
            //Chercher province
            $province = Province::select('nom')
            ->where('id', '=', $commande->province)
            ->get();

            $province = $province[0]['nom'];

            Mail::send(
                'client/commande.confirmationCommande',
                $data = [
                    'nom' => $commande->nom,
                    'prenom' => $commande->prenom,
                    'commande' => $commande,
                    'prixSousTotal'=> $prixSousTotal,
                    'prixTotal'=> $prixTotal,
                    'voituresCommandes'=> $voituresCommandes,
                    'province' => $province
                ],
    
                function ($message) use ($clientNom, $email) {
                    $message->to($email, $clientNom)->subject('Confirmation de commande');
                }
            );
        }


        // supprimer tous les items dans le panier
        Cart::destroy();

        return redirect(route('commande.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)

    {
        //Chercher province
         $province = Province::select('nom')
         ->where('id', '=', $commande->province)
         ->get();

         $province = $province[0]['nom'];

        $prixSousTotal = 0;
        //Récuperer le prix d'achat
        foreach($commande->VoitureCommandes as $voitureInfos){

            //Calculer la marge
            $prix = $voitureInfos->prixAchat * $voitureInfos->marge;

            //Calculer le sous total des voitures dans la commande
            $prixSousTotal = $prixSousTotal + $prix;

        }

        //Calculer le prix total (avec tax)
        $prixTotal = $prixSousTotal * 1.15;


        $voiture = new Voiture;
        $voituresCommandes = $voiture->voitureCommande($commande->id);
        
        return view('client/commande.detailCommande', compact('province', 'commande', 'prixSousTotal', 'prixTotal', 'voituresCommandes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {

         //Sécuriser le lien vers le formulaire de modification, le mettre accessible que par les privilége 1,2 et  3(proprétaire, géstionaire, employé )
         if (Auth::user()->privilege_id ==  4) {

            return redirect('/');
        }

        //Chercher province
        $province = Province::select('nom')
        ->where('id', '=', $commande->province)
        ->get();
        $province = $province[0]['nom'];
        // dd($province);

        $prixSousTotal = 0;
        //Récuperer le prix d'achat
        foreach($commande->VoitureCommandes as $voitureInfos){

            //Calculer la marge
            $prix = $voitureInfos->prixAchat * $voitureInfos->marge;

            //Calculer le sous total des voitures dans la commande
            $prixSousTotal = $prixSousTotal + $prix;

        }
        //Calculer le prix total (avec tax)
        $prixTotal = $prixSousTotal * 1.15;

        //Récuperer les information des voiture qui sont dans la commandes
        $voiture = new Voiture;
        $voituresCommandes = $voiture->voitureCommande($commande->id);

        //Récupperer les modes paiement

        $paiement = new Paiement;
        $paiements = $paiement->selectPaiement();

        return view('admin/commande.detailCommande', compact('province', 'commande', 'prixSousTotal', 'prixTotal', 'voituresCommandes','paiements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        //Sécuriser le lien vers le formulaire de modification, le mettre accessible que par les privilége 1,2 et  3(proprétaire, géstionaire, employé )
        if (Auth::user()->privilege_id ==  4) {

            return redirect('/');
        }

        $commande->update([
            'statut_id' => 2,
            'paiement_id'=> $request->paiement_id

        ]);


        //Envoie de la confirmation commande par émail
        $clientNom = $commande->nom;
        $clientPrenom = $commande->prenom;
        $email = $commande->courriel;

        $prixSousTotal = 0;
        //Récuperer le prix d'achat
        foreach($commande->VoitureCommandes as $voitureInfos){

            //Calculer la marge
            $prix = $voitureInfos->prixAchat * $voitureInfos->marge;

            //Calculer le sous total des voitures dans la commande
            $prixSousTotal = $prixSousTotal + $prix;

        }
        //Calculer le prix total (avec tax)
        $prixTotal = $prixSousTotal * 1.15;

        //Récuperer les information des voiture qui sont dans la commandes
        $voiture = new Voiture;
        $voituresCommandes = $voiture->voitureCommande($commande->id);


        Mail::send(
            'client/commande.confirmationCommande',
            $data = [
                'nom' => $clientNom,
                'prenom' => $clientPrenom,
                'commande' => $commande,
                'prixSousTotal'=> $prixSousTotal,
                'prixTotal'=> $prixTotal,
                'voituresCommandes'=> $voituresCommandes,
            ],

            function ($message) use ($clientNom, $email) {
                $message->to($email, $clientNom)->subject('Confirmation de commande');
            }
        );
        return redirect()->back();
    }

    public function facturePdf( $commande ){

        $commande = Commande::find($commande);

        //Chercher province
        $province = Province::select('nom')
        ->where('id', '=', $commande->province)
        ->get();
        $province = $province[0]['nom'];

       //Récuperer le prix d'achat
       $prixSousTotal = 0;
       foreach($commande->VoitureCommandes as $voitureInfos){

        //Calculer la marge
        $prix = $voitureInfos->prixAchat * $voitureInfos->marge;

        //Calculer le sous total des voitures dans la commande
        $prixSousTotal = $prixSousTotal + $prix;

        }
    //Calculer le prix total (avec tax)
    $prixTotal = $prixSousTotal * 1.15;

    //Récuperer les information des voiture qui sont dans la commandes
    $voiture = new Voiture;
    $voituresCommandes = $voiture->voitureCommande($commande->id);


    $pdfFacture = PDF::loadView('client/commande.facture',['province' => $province, 'commande' => $commande, 'prixSousTotal' => $prixSousTotal, 'prixTotal'=>$prixTotal ,'voituresCommandes'=>$voituresCommandes]);

    return $pdfFacture->download('Facture-'.$commande->numeroDeCommande .'.pdf');
    //return $pdfFacture->stream('Facture-'.$commande->numeroDeCommande .'.pdf');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        
        $commande->delete();
        return redirect('/mes-commandes');
    }

}
