<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    //use HasFactory;
    protected $fillable = ['nom'];

    public function modeles() {
        // $modeles = $this->hasMany(Modele::class);
        return $this->hasMany(Modele::class);
    }
}
