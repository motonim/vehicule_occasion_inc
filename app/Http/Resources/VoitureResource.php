<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoitureResource extends JsonResource
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
            'annee' => $this->annee,
            'couleur' => $this->couleur,
            'km' => number_format($this->km)."\n",
            'prix' =>number_format($this->prixAchat * $this->marge)."\n",
            'imagePrincipale' => $this->imagePrincipale,
            'commande_id' => $this->commande_id,
            'modele_nom' => $this->modeleMarqueVoiture->modele_nom,
            'marque_nom' => $this->modeleMarqueVoiture->marque_nom,
            'modele_id' => $this->modele_id,

        ];
    }
}
