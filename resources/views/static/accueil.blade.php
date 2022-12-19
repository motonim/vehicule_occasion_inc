@extends('layouts.app')
@section('content')

    <div class="hero">
        <div class="container my-2">
            <div class="row hero__container">
                <p class="hero__text--top">@lang('acceuil.title_en_tete')</p>
                <p class="hero__text--center">@lang('acceuil.title_en_tete2')</p>
                <div class="ligne--yellow"></div>
                <p class="hero__text--description">@lang('acceuil.descrption1')</p>
                <p class="hero__text--description">@lang('acceuil.descrption2')</p>
            </div>
        </div>
    </div>

    <div class="carousel">
        <div class="container">
            <div class="d-flex justify-content-between mb-3">
                <h2>@lang('acceuil.en_vedette')</h2>
                <a href="{{route('voiture.index')}}" class='btn__border'>@lang('acceuil.affiche_voiture')</a>
            </div>
        </div>
        <!-- En vedette -->
        <div class="accueil-slider">

            @foreach($voitures as $voiture)
           
                <div class="produit__container">
                    <div class="produit">
                        <img src="{{asset('assets/img/'. $voiture->imagePrincipale )}}" alt="" class='produit__img'>
                        <p class='produit__titre pt-3'>{{$voiture->annee}} {{$voiture->marque_nom}} {{$voiture->modele_nom}}</p>
                        <div class="produit__num d-flex justify-content-between">
                            <p class='produit__prix'> {{  number_format($voiture->prixAchat * $voiture->marge)}} $</p>
                            <a href="{{route('voiture.show', $voiture->id)}}" class='produit__commander font-color-yellow'>@lang('commande.voir') <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                
            @endforeach
            
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="arrow-prev-accueil">
                <button class="slick-prev-accueil slick-arrow" aria-label="Previous" type="button" style="display: block;"><i class="fa-solid fa-chevron-left"></i></button>
            </div>
            <div class="ligne"></div>
            <div class="arrow-next-accueil">
                <button class="slick-next-accueil slick-arrow" aria-label="Next" type="button" style="display: block;"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <h2 class='py-3'>@lang('acceuil.nos_services')</h2>
        <div class="flex-reverse">
            <div class="row">
                <div class="col-12 col-md-4 my-3">
                    <p><i class="fa-solid fa-screwdriver-wrench font-color-yellow mr-2"></i> @lang('acceuil.paix_esprit')</p>
                    <p class='pt-2'>@lang('acceuil.paix_esprit_text')</p>
                </div>
                <div class="col-12 col-md-4 my-3">
                    <p><i class="fa-solid fa-face-smile font-color-yellow mr-2"></i>@lang('acceuil.prix_intelligents') </p>
                    <p class='pt-2'> @lang('acceuil.prix_intelligents_text')</p>
                </div>
                <div class="col-12 col-md-4 my-3">
                    <p><i class="fa-solid fa-thumbs-up font-color-yellow mr-2"></i> @lang('acceuil.satisfaction') </p>
                    <p class='pt-2'> @lang('acceuil.satisfaction_text')</p>
                </div>
            </div>
            <img src="{{asset('assets/img/accueil-service.png')}}" alt="" class='py-5 img-accueil-voitures'>
        </div>
    </div>

    <div class="bg__accueil-contactez py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2>@lang('formContact.contactez_nous') </h2>
                </div>
                <div class="col-12 col-md-6 pt-3">
                    <form action="" class='form__accueil'>
                        <p class='form__accueil__titre'> @lang('formContact.laissez_message')</p>
                        <input type="text" class='form__accueil__input' placeholder="@lang('auth.nom')" name="nom" id="nom">
                        <input type="email" class='form__accueil__input' placeholder="@lang('auth.email')" name="courriel" id="courriel">
                        <input type="number" class='form__accueil__input' placeholder="@lang('auth.telephone')"name="phone" id="phone">
                        <textarea name="message" class='form__accueil__input' id="message" cols="30" rows="4">@lang('formContact.message')</textarea>
                        <button type="submit" class='btn__soumettre mt-3'>@lang('formContact.soumettre')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection('content')