<?php

namespace App\Http\Resources;

use App\Models\Modele;
use App\Models\Voiture;
use Illuminate\Http\Resources\Json\JsonResource;

class ModeleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'marque_id' => $this->marque_id,
            'voitures_count' => $this->voitures_count
        ];
    }
}
