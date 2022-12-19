<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paiement extends Model
{
    //use HasFactory;
    protected $fillable = ['nom','nom_en'];

    public function selectPaiement()
    {

        $lang = session()->get('localeDB');

        return  $this::select(
            DB::raw("(case when nom$lang is null then nom else nom$lang end) as nom"),
            'id'
        )           
            ->get();
    }
}
