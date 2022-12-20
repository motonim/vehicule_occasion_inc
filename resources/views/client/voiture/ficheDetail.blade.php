@extends('layouts.app')
@section('content')
@php $locale = session()->get('locale'); @endphp
    <div class="container my-5">
        
        @if(session('message'))
            <div class="py-3 text-success">{{ session('message') }}</div>
        @endif
        <div class="d-flex justify-content-between align-items-end">
            <h1>{{$voiture->annee}}  {{$marque}} {{$modele}} <span >
              {{ number_format( $voiture->prixAchat * $voiture->marge)}} $</span></h1>
            <p class='detail__id'>STOCK# <span class='font-color-yellow'>VO-{{$voiture->id}}</span></p>
        </div>
    </div>

    <div class="carousel">
        <div class="arrow-prev">
            <button class="slick-prev slick-arrow btn-arrow" aria-label="Previous" type="button" style="display: block;"><i class="fa-solid fa-chevron-left"></i></button>
        </div>
        <div class="slider">
            @foreach($images as $image)
            <img src="{{asset('assets/img/'. $image->url)}}" alt="">
            @endforeach
            
        </div>
        <div class="arrow-next">
            <button class="slick-next slick-arrow btn-arrow" aria-label="Next" type="button" style="display: block;"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>

    <div class="container pb-4">
        <div class="my-5">
            <div class="detail__information">
                <div class="detail__information__vehicule">
                    <p class='detail__information__vehicule__title font-weight-bold font-color-yellow mb-4'>informations sur le véhicule</p>
                    <div class="container">
                        <div class="row">
                            <div class="col font-weight-bold"> @lang('voiture.marque') </div>
                            <div class="col font-weight-bold"> @lang('voiture.modele') </div>
                            <div class="col font-weight-bold"> @lang('voiture.annee')  </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">{{$marque}}</div>
                            <div class="col"> {{$modele}}</div>
                            <div class="col">{{$voiture->annee}}</div>
                        </div>
                        <div class="row mt-5">
                            <div class="col font-weight-bold">  @lang('voiture.carroserie')  </div>     
                            <div class="col font-weight-bold">  @lang('voiture.couleur')     </div>
                            <div class="col font-weight-bold">  @lang('voiture.km')          </div>
                        </div>
                        <div class="row mt-2">
                            @foreach($carrosseries as $carrosseries)
                            <div class="col ">{{$carrosseries->nom}}</div>
                            @endforeach
                            <div class="col">@if($locale=='fr') {{$voiture->couleur}} @else {{$voiture->couleur_en}} @endif</div>
                            <div class="col">{{$voiture->km}} Km</div>
                        </div>
                        <div class="row mt-5">
                        <div class="col font-weight-bold">      @lang('voiture.transmission')  </div>     
                            <div class="col font-weight-bold">  @lang('voiture.carburant')     </div>
                            <div class="col font-weight-bold">  @lang('voiture.traction')      </div>
                        </div>
                        <div class="row mt-2">
                            @foreach($transmissions as $transmission)
                            <div class="col ">{{$transmission->nom}}</div>
                            @endforeach

                            @foreach($carburants as $carburant)
                            <div class="col ">{{$carburant->nom}}</div>
                            @endforeach

                            @foreach($tractions as $traction)
                            <div class="col ">{{$traction->nom}}</div>
                            @endforeach
                           
                        </div>
                    </div>
                </div>
                <div class="detail__information__commander">
                    <div class="detail__information__commander__texte">
                        <p class='font-weight-bold'><span class='font-color-yellow'><i class="fa-solid fa-thumbs-up pr-xxsmall"></i></span>@lang('ficheDetail.titre_paix') </p>
                        <p class='text__body pt-2'>@lang('ficheDetail.text_paix')</p>
                    </div>
                    <div class="detail__information__commander__texte">
                        <p class='font-weight-bold'><span class='font-color-yellow'><i class="fa-solid fa-circle-question pr-xxsmall"></i></span>@lang('ficheDetail.question')</p>
                        <p class='text__body pt-2'>@lang('ficheDetail.question_text')</p>
                    </div>
                    @if ($cart->where('id', $voiture->id)->count())
                    <div class="border--gray border-radius__5px p-2 text-center" disabled>@lang('ficheDetail.incart')</div>    
                    @else
                    <form action="{{route('panier.store', $voiture->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="quantite" value="1">
                        <input type="hidden" name="voiture_id" id="voiture_id" value="{{$voiture->id}}">
                        <input type="hidden" name="test" id="test" value="test">
                        <btnajouter></btnajouter>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-4">
        <div class="detail__service-client">
            <div class="detail__service-client-img">
                <img src="{{asset('assets/img/detail4.jpeg')}}" alt="">
            </div>
            <div class="detail__service-client-texte py-4">
                <h3>@lang('ficheDetail.titire_qualite')</h3>
                <p class='pt-4'>@lang('ficheDetail.text_qualite')</p>
            </div>
        </div>
        <div class="detail__service-client">
            <div class="detail__service-client-img">
                <img src="{{asset('assets/img/detail5.jpeg')}}" alt="">
            </div>
            <div class="detail__service-client-texte py-4">
                <h3>@lang('ficheDetail.titre_garantie')</h3>
                <p class='pt-4'>@lang('ficheDetail.text_garantie')</p>
            </div>
        </div>
    </div>
    @endsection('content')
<!--     
@section('scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endsection -->