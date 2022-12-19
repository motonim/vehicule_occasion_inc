@extends('layouts.app-admin')
@section('content')
<div class="container p-5 bg-light col-12 col-lg-10">
    <h1 class="fs-2 text-dark">@lang('admin.voiture_ajout_titre')</h1>
    
    <!-- Formulaire d'ajout -->
    <form class="add-form m-5" enctype="multipart/form-data" method="POST" action="{{route('voiture.enregistrer')}}">
        @csrf
            <!-- À IMPLÉMENTER PLUS TARD - Pour préciser les modèles à afficher -->
            <!-- <div class="d-flex align-items-center">
                <label class="text-dark col-2 col-2" for="marque">@lang('admin.voiture_ajout_select_marque')</label>
                <select name="marque_id" id="marque" class="form-control form-control-m m-3">
                    <option value="" disabled selected>-</option>
                    @foreach($marques as $marque)
                    <option value="{{$marque->id}}" {{ $marque->id == old('marque_id') ? 'selected' : '' }}>{{$marque->nom}}</option>
                    @endforeach
                </select>
                @if($errors->has('marque_id'))
                    <span class="text-danger">{{ $errors->first('marque_id') }}</span>
                @endif
            </div> -->
        <!-- Modele-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="modele">@lang('admin.voiture_ajout_select_modele')</label>
                <select name="modele_id" id="modele" class="form-control form-control-m m-3">
                    <option value="" disabled selected>-</option>
                    @foreach($modeles as $modele)
                    <option value="{{$modele->id}}" {{ $modele->id == old('modele_id') ? 'selected' : '' }}>{{$modele->nom}}</option>
                    @endforeach
                </select>
                @if($errors->has('modele_id'))
                    <span class="text-danger">{{ $errors->first('modele_id') }}</span>
                @endif
            </div>

        <!-- Année-->
            <div class="d-flex align-items-center justify-content-stretch">
                <label class="text-dark col-2" for="annee">@lang('admin.voiture_ajout_annee')</label>
                <input name="annee" id="annee" class="form-control form-control-m m-3" type="text" value="{{old('annee')}}"/>
                @if($errors->has('annee'))
                    <span class="text-danger">{{ $errors->first('annee') }}</span>
                @endif
            </div>

        <!-- Couleur en Français-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="couleur_fr">@lang('admin.voiture_ajout_couleur_fr')</label>
                <input name="couleur" id="couleur_fr" class="form-control form-control-m m-3" type="text" value="{{old('couleur')}}"/>
                @if($errors->has('couleur'))
                    <span class="text-danger">{{ $errors->first('couleur') }}</span>
                @endif
            </div>

        <!-- Couleur en English-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="couleur_en">@lang('admin.voiture_ajout_couleur_en')</label>
                <input name="couleur_en" id="couleur_en" class="form-control form-control-m m-3" type="text" value="{{old('couleur_en')}}"/>
                @if($errors->has('couleur_en'))
                    <span class="text-danger">{{ $errors->first('couleur_en') }}</span>
                @endif
            </div>

        <!-- KM-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="km">@lang('admin.voiture_ajout_km')</label>
                <input name="km" id="km" class="form-control form-control-m m-3" type="number" value="{{old('km')}}"/>
                @if($errors->has('km'))
                    <span class="text-danger">{{ $errors->first('km') }}</span>
                @endif
            </div>

        <!-- Transmission-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="transmission">@lang('admin.voiture_ajout_select_transmission')</label>
                <select name="transmission_id" id="transmission" class="form-control form-control-m m-3">
                    <option value="" disabled selected>-</option>
                    @foreach($transmissions as $transmission)
                    <option value="{{$transmission->id}}" {{ $transmission->id == old('transmission_id') ? 'selected' : '' }}>{{$transmission->nom}}</option>
                    @endforeach
                </select>
                @if($errors->has('transmission_id'))
                    <span class="text-danger">{{ $errors->first('transmission_id') }}</span>
                @endif
            </div>

        <!-- Carrosserie-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="carrosserie">@lang('admin.voiture_ajout_select_carrosserie')</label>
                <select name="carrosserie_id" id="carrosserie" class="form-control form-control-m m-3">
                    <option value="" disabled selected>-</option>
                    @foreach($carrosseries as $carrosserie)
                    <option value="{{$carrosserie->id}}" {{ $carrosserie->id == old('carrosserie_id') ? 'selected' : '' }}>{{$carrosserie->nom}}</option>
                    @endforeach
                </select>
                @if($errors->has('carrosserie_id'))
                    <span class="text-danger">{{ $errors->first('carrosserie_id') }}</span>
                @endif
            </div>

        <!-- Traction -->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="traction">@lang('admin.voiture_ajout_select_traction')</label>
                <select name="traction_id" id="traction" class="form-control form-control-m m-3">
                    <option value="" disabled selected>-</option>
                    @foreach($tractions as $traction)
                    <option value="{{$traction->id}}" {{ $traction->id == old('traction_id') ? 'selected' : '' }}>{{$traction->nom}}</option>
                    @endforeach
                </select>
                @if($errors->has('traction_id'))
                    <span class="text-danger">{{ $errors->first('traction_id') }}</span>
                @endif
            </div>

        <!-- Carburant-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="carburant">@lang('admin.voiture_ajout_select_carburant')</label>
                <select name="carburant_id" id="craburant" class="form-control form-control-m m-3">
                    <option value="" disabled selected>-</option>
                    @foreach($carburants as $carburant)
                    <option value="{{$carburant->id}}" {{ $carburant->id == old('carburant_id') ? 'selected' : '' }}>{{$carburant->nom}}</option>
                    @endforeach
                </select>
                @if($errors->has('carburant_id'))
                    <span class="text-danger">{{ $errors->first('carburant_id') }}</span>
                @endif
            </div>

        <!-- Prix d'achat-->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="prix_achat">@lang('admin.voiture_ajout_prix_achat')</label>
                <input name="prixAchat" id="prix_achat" class="form-control form-control-m m-3" type="number" value="{{old('prixAchat')}}"/>
                @if($errors->has('prixAchat'))
                    <span class="text-danger">{{ $errors->first('prixAchat') }}</span>
                @endif
            </div>

        <!-- Le champ marge afficheé que pour les privilége 1 et 2 -->
            @if(Auth::user()->privilege_id == 1 || Auth::user()->privilege_id == 2 )
            <div class="d-flex align-items-center">   

                <label class="text-dark col-2" for="marge">@lang('admin.voiture_ajout_marge')</label>           
                <input name="marge" id="marge" class="form-control form-control-m m-3"   type="text"  value="1.25"/>
                
                @if($errors->has('marge'))
                <span class="text-danger">{{ $errors->first('marge') }}</span>
                @endif
            </div>
            @else
            <div class="d-flex align-items-center"> 
                <input name="marge" id="marge" class="form-control form-control-m m-3"    type="hidden"  value="1.25"/>
                @if($errors->has('marge'))
                <span class="text-danger">{{ $errors->first('marge') }}</span>
                @endif
            </div>
            @endif

        <!-- Image principale -->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="image_principale">@lang('admin.voiture_ajout_img_principale')</label>
                <input name="imagePrincipale" id="image_principale" class="m-3" type="file"/>
                @if($errors->has('imagePrincipale'))
                    <span class="text-danger">{{ $errors->first('imagePrincipale') }}</span>
                @endif
            </div>

        <!-- Les images secondaires -->
            <div class="d-flex align-items-center">
                <label class="text-dark col-2" for="images_secondaires">@lang('admin.voiture_ajout_imgs_secondaires')</label>
                <input name="images[]" id="images_secondaires" class="m-3" type="file" multiple/>
                @if($errors->has('images'))
                    <span class="text-danger">{{ $errors->first('images') }}</span>
                @endif
            </div>

        <!-- Boutons confirmer l'ajout / annuler -->
            <div class="col-xs-12 d-flex justify-content-end">
                <button type="submit" class="btn__border">
                    <i class="fa fa-check fs-5 font-color-yellow"></i>
                </button>
                <a class="btn btn-outline-danger ml-3" href="{{route('voiture.liste')}}">
                    <i class="fa fa-x fs-5"></i>
                </a>
            </div>
    </form>
</div>
@endsection('content')
