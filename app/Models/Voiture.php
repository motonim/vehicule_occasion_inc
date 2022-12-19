<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Image;

use App\Models\Modele;
use App\Models\Marque;
use App\Models\Commande;


class Voiture extends Model
{
    //use HasFactory;
    protected $fillable = ['annee', 'couleur', 'couleur_en', 'km', 'prixAchat', 'imagePrincipale', 'transmission_id', 'carrosserie_id', 'traction_id', 'carburant_id', 'commande_id', 'modele_id', 'created_at'];

    const KMS = [
        'Less than 25,000',
        'From 25,000 to 50,000',
        'From 50,000 to 100,000',
        'More than 100,000',
    ];

    public function scopeselectinfos()
    {

        //Récuperer toutes les voitures
        return $this::select('modeles.nom as modele_nom', 'marques.nom as marque_nom', 'voitures.id', 'voitures.km', 'prixAchat', 'imagePrincipale', 'marge', 'voitures.created_at', 'voitures.annee', 'voitures.commande_id', 'modeles.marque_id', 'voitures.modele_id')
            ->join('modeles', 'modele_id', '=', 'modeles.id')
            ->join('marques', 'modeles.marque_id', '=', 'marques.id')
            ->orderBy('voitures.created_at', 'DESC')
            ->get();
    }


    public function modeleMarqueVoiture(){
        return $this->belongsTo(Modele::class, 'modele_id', 'id')->select('modeles.nom as modele_nom','marques.nom as marque_nom')->join('marques', 'modeles.marque_id', '=', 'marques.id');
    }

    // public function marqueVoiture(){
    //     return $this->belongsTo(Modele::class, 'modele_id', 'id')->join('marques', 'modeles.marque_id', '=', 'marques.id');
    // }

    public function statuVoiture()
    {
        return $this->belongsTo(Commande::class, 'commande_id', 'id');
    }


    public function voitureImages()
    {
        return $this->hasMany(Image::class, 'voiture_id', 'id');
    }

    public function scopeWithFilters($query, $marques, $modeles, $kms)
    {
        return $query->when(count($modeles), function ($query) use ($modeles) {
            $query->whereIn('modele_id', $modeles);
        })
            ->when(count($marques), function ($query) use ($marques) {
                $query->whereIn('marque_id', $marques);
            })
            ->when(count($kms), function ($query) use ($kms){
                $query->where(function ($query) use ($kms) {
                    $query->when(in_array(0, $kms), function ($query) {
                            $query->orWhere('km', '<', '25000');
                        })
                        ->when(in_array(1, $kms), function ($query) {
                            $query->orWhereBetween('km', ['25000', '50000']);
                        })
                        ->when(in_array(2, $kms), function ($query) {
                            $query->orWhereBetween('km', ['50000', '10000']);
                        })
                        ->when(in_array(3, $kms), function ($query) {
                            $query->orWhere('km', '>', '100000');
                        });
                });
            });
    }
    //Récuperer les information des voiture qui sont dans la commandes 
    public function voitureCommande($id)
    {
        $lang = session()->get('localeDB');
        return $this::select(
            'modeles.nom as modele_nom', 
            'marques.nom as marque_nom', 
            'voitures.imagePrincipale',
            'voitures.annee',
            'voitures.km',
            'transmissions.nom as transmission_nom',
            'carburants.nom as carburant_nom',
            'tractions.nom as traction_nom',
            'carrosseries.nom as carrosserie_nom',
            'prixAchat',
            'marge'
            )
            ->join('commandes', 'commande_id', '=', 'commandes.id')
            ->join('modeles', 'modele_id', '=', 'modeles.id')
            ->join('marques', 'modeles.marque_id', '=', 'marques.id')
            ->join('transmissions','transmission_id','transmissions.id')
            ->join('carburants','carburant_id','carburants.id')
            ->join('tractions','traction_id','tractions.id')
            ->join('carrosseries','carrosserie_id','carrosseries.id')
            ->where('voitures.commande_id', '=', $id)
            ->get();
    }
}
