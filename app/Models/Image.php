<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //use HasFactory;
    protected $fillable = ['url','voiture_id'];

    public function selectImage($id){

        return $this::select('url')
            ->where('voiture_id', '=', $id)
            ->get();

    }

}
