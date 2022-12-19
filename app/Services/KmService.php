<?php

namespace App\Services;

use App\Models\Voiture;

class KmService
{
    private $kms;
    private $marques;
    private $modeles;

    public function getKms($kms, $marques, $modeles)
    {
        $this->kms = $kms;
        $this->marques = $marques;
        $this->modeles = $modeles;
        $formattedkms = [];

        foreach(Voiture::KMS as $index => $nom) {
            $formattedKms[] = [
                'nom' => $nom,
                'voitures_count' => $this->getVoitureCount($index)
            ];
        }

        return $formattedkms;
    }

    private function getVoitureCount($index)
    {
        return Voiture::withFilters($this->kms, $this->marques, $this->modeles)
            ->when($index == 0, function ($query) {
                $query->where('km', '<', '25000');
            })
            ->when($index == 1, function ($query) {
                $query->whereBetween('km', ['25000', '50000']);
            })
            ->when($index == 2, function ($query) {
                $query->whereBetween('km', ['50000', '100000']);
            })
            ->when($index == 3, function ($query) {
                $query->where('km', '>', '100000');
            })
            ->count();
    }
}
