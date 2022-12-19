<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Traction extends Model
{
    //use HasFactory;
    protected $fillable = ['nom','nom_en','statutActive'];

    public function selectTraction($id) {

        $lang = session()->get('localeDB'); 
        
        return $this::select(

        DB::raw("(case when nom$lang is null then nom else nom$lang end) as nom")
        )
            ->where ('id' ,'=',$id )
            ->get();
    }
}
