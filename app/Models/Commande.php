<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //use HasFactory;
    protected $fillable = ['numeroDeCommande', 'user_id', 'expedition_id', 'paiement_id','statut_id'];

    public function selectClient(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function selectStatut(){
        return $this->belongsTo(Statut::class, 'statut_id', 'id');
    }
    public function selectModePaiement(){
        return $this->belongsTo(Paiement::class, 'paiement_id', 'id');
    }
   
    public function VoitureCommandes(){
        return $this->hasMany(Voiture::class, 'commande_id', 'id');
    }

    public function provinceVille(){
        return $this->belongsTo(User::class, 'user_id', 'id')->select('villes.nom as ville_nom','provinces.nom as province_nom')
                    ->join('villes', 'users.ville_id', '=', 'villes.id')
                    ->join('provinces','villes.province_id', '=','provinces.id');
    }
   
    
}
