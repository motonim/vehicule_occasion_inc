<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierItem extends Model
{
    // use HasFactory;
    protected $fillable = ['user_id', 'voiture_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function voiture() {
        return $this->belongsTo(Voiture::class, 'voiture_id', 'id');
    }

}
