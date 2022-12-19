<template>
    <div class="produit__container">
        <a href="{{route('voiture.show', $voiture.id)}}" class='produit'>
            <img src="{{asset('assets/img/'. $voiture.imagePrincipale )}}" alt="" class='produit__img'>
            <p class='produit__titre'>{{ $voiture.modele_nom }}</p>
            <p class='produit__type'>{{ $voiture.marque_nom }}</p>
            <div class="produit__num d-flex justify-content-between">
                <p class='produit__km'>{{ $voiture.km }} Km</p>
                <p class='produit__prix'> {{ $voiture.prixAchat * $voiture.marge }} $ </p>
            </div>
        </a>
    </div>
</template>

<script>
export default {
    props: [
        'voiture'
    ]
}
</script>


