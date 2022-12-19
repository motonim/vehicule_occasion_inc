<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    //use HasFactory;
    protected $fillable = ['nom','marque_id'];

    //Récuperer le modele et marque d'une voiture
    public function selectModele($id)
    {
        return $this::select('modeles.nom as modele_nom','marques.nom as marque_nom')
            ->join('voitures', 'modele_id', '=', 'modeles.id')
            ->join('marques', 'modeles.marque_id', '=', 'marques.id')
            ->where('modele_id', '=', $id)
            ->get();
    }

    public function voitures() {
        return $this->hasMany(Voiture::class);
    }

    public function marqueModele() {
        return $this->belongsTo(Marque::class);
    }


    public function scopeWithModelFilters($query, $marques)
    {
        return $query->whereIn('marque_id', $marques);

    }

}
