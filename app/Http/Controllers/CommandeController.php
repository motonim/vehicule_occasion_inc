<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
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

        return view('client/commande.index', compact('mesCommandes'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)

    {
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

        return view('client/commande.detailCommande', compact('commande', 'prixSousTotal', 'prixTotal', 'voituresCommandes'));
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

        return view('admin/commande.detailCommande', compact('commande', 'prixSousTotal', 'prixTotal', 'voituresCommandes','paiements'));
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
        $clientNom = $commande->selectClient->nom;
        $clientPrenom = $commande->selectClient->prenom;
        $email = $commande->selectClient->courriel;

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


    $pdfFacture = PDF::loadView('client/commande.facture',['commande' => $commande, 'prixSousTotal' => $prixSousTotal, 'prixTotal'=>$prixTotal ,'voituresCommandes'=>$voituresCommandes]);

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


    public function jaeriPanier() {
        if(Auth::check()) {
            $userId = Auth::user()->id;

            $commande = Commande::select('id')
            ->where('user_id', '=', $userId)
            ->orderby('id', 'ASC')
            ->get();

            if ($commande) {
                $commandeId = $commande[0]['id'];

                $voitures = Voiture::select()
                ->where('commande_id', '=', $commandeId)
                ->orderby('id', 'ASC')
                ->get();
                // var_dump($voiture);

                // var_dump($voitures[0]['user_id']);
                // die();

                // $modele_marque = new Modele;
                // $modele_marque = $modele_marque->selectModele($voiture->modele_id);

                // $modele = $modele_marque[0]['modele_nom'];
                // $marque = $modele_marque[0]['marque_nom'];

                return view('client/commande.index', ['voitures' => $voitures]);
            }
            else {

                return view('client/commande.index');

            }
        }

        else {

            return view('auth.connexion');

        }
    }
}
