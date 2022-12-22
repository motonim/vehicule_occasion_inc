@extends('layouts.app')
@section('content')

<div class="container py-5">
   <div class="row">
      <div class="produit__panier__section col-12 col-lg-8">
         <div class="border--gray border-radius__5px p-2">         
            <h2 class='p-2'>@lang('commande.panier_articles')</h2>
            @if(count($voitures) < 1)
               <p class="py-5 px-2">No result</p>           
            @else
               @foreach ($voitures as $voiture)
               <div class="produit__panier__item py-3 d-flex justify-content-between align-items-center">
                  <div class="w-30 p-2">
                     <img src="{{ asset('assets/img/' . $voiture->imagePrincipale) }}" alt="" class='produit__img'>
                  </div>
                  <div class="produit__panier__attributes w-60 p-2 mx-5">
                     <p class='produit__panier__titre'>{{$voiture->annee}}  {{$voiture->marque}} {{$voiture->modele}}</p>
                     <p class="produit__panier__prix pt-2"><span data-js-voiture-prix>{{ $voiture->prixAchat * $voiture->marge }}</span> $</p>
                  </div>
                  <div class="produit__panier__supprimer pr-2 w-10">
                     <a href="{{ route('panier.suppression', $voiture->id) }}">
                        <i class="fa-regular fa-rectangle-xmark font-color-yellow"></i>
                     </a>
                  </div>
               </div>
               @endforeach
            @endif
         </div>

         <!-- --------formulaire Réservation-------- -->
         <form action="{{route('commande.store')}}" method="post" data-js-formulaire-reservation>
            @csrf
            <input type="hidden" name="expedition_id" value="3">
            <input type="hidden" name="paiement_id" value="2">
            <input type="hidden" name="statut_id" value="1">
            @if(count($voitures) >= 1)
               @foreach ($voitures as $voiture)
               <input type="hidden" name="metadata[]" value="{{ $voiture->id }}">
               @endforeach
            @endif
            <div class="border--gray border-radius__5px p-2 mt-3">         
               <h2 class='p-2'>Information</h2>
               <div class="py-3 px-2">
                  <label for="courriel">@lang('auth.email') *</label>
                  <div class="">
                        <input type="email" class="form__connexion__input" name="courriel" placeholder="@lang('auth.email')">
                  </div>
               </div>

               <h2 class='pt-5 pb-2 pl-2'>@lang('commande.adresse_facturation')</h2>
               <div class="py-3 px-2">
                  <label for="prenom">@lang('auth.prenom') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="prenom" >
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="nom">@lang('auth.nom') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="nom">
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="adresse">@lang('auth.adresse') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="adresse" placeholder="ex: 123 Rue Rpincipale">
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="ville">@lang('auth.ville') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="ville">
                  </div>
               </div>
               <div class="d-flex">
                  <div class="py-3 px-2">
                     <label for="province">@lang('auth.province') *</label>
                     <div class="">
                        <select name="province" id="province" class="form__connexion__input">
                           @foreach($provinces as $province)
                              <option value="{{$province->id}}">{{$province->nom}}</option>
                           @endforeach
                        </select>                  
                     </div>
                  </div>
                  <div class="py-3 px-2">
                     <label for="code_postal">@lang('auth.code_postal') *</label>
                     <div class="">
                           <input type="text" class="form__connexion__input" name="code_postal" placeholder="ex: H3Z 2Y7">
                     </div>
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="telephone">@lang('auth.telephone') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="telephone">
                  </div>
               </div>
               <button class="btn__caisse__reserver--desktop my-3">@lang('commande.btn_suivant')</button>
            </div>
         </form>

         <!-- --------formulaire Collection-------- -->
         <form action="{{route('commande.store')}}" method="post" data-js-formulaire-collection>
            @csrf
            <input type="hidden" name="expedition_id" value="2">
            <input type="hidden" name="paiement_id" value="1">
            <input type="hidden" name="statut_id" value="2">
            @if(count($voitures) >= 1)
               @foreach ($voitures as $voiture)
               <input type="hidden" name="metadata[]" value="{{ $voiture->id }}">
               @endforeach
            @endif
            <div class="border--gray border-radius__5px p-2 mt-3">         
               <h2 class='p-2'>Information</h2>
               <div class="py-3 px-2">
                  <label for="courriel">@lang('auth.email') *</label>
                  <div class="">
                        <input type="email" class="form__connexion__input" name="courriel" placeholder="@lang('auth.email')">
                  </div>
               </div>

               <h2 class='pt-5 pb-2 pl-2'>@lang('commande.adresse_facturation')</h2>
               <div class="py-3 px-2">
                  <label for="prenom">@lang('auth.prenom') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="prenom" >
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="nom">@lang('auth.nom') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="nom">
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="adresse">@lang('auth.adresse') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="adresse" placeholder="ex: 123 Rue Rpincipale">
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="ville">@lang('auth.ville') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="ville">
                  </div>
               </div>
               <div class="d-flex">
                  <div class="py-3 px-2">
                     <label for="province">@lang('auth.province') *</label>
                     <div class="">
                        <select name="province" id="province" class="form__connexion__input">
                           @foreach($provinces as $province)
                              <option value="{{$province->id}}">{{$province->nom}}</option>
                           @endforeach
                        </select>                  
                     </div>
                  </div>
                  <div class="py-3 px-2">
                     <label for="code_postal">@lang('auth.code_postal') *</label>
                     <div class="">
                           <input type="text" class="form__connexion__input" name="code_postal" placeholder="ex: H3Z 2Y7">
                     </div>
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="telephone">@lang('auth.telephone') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="telephone">
                  </div>
               </div>
               <button class="btn__caisse__reserver--desktop my-3">@lang('commande.btn_suivant')</button>
            </div>
         </form>

         <!-- --------formulaire Livraison-------- -->
         <form action="{{route('commande.store')}}" method="post" data-js-formulaire-livraison>
            @csrf
            <input type="hidden" name="expedition_id" value="1">
            <input type="hidden" name="paiement_id" value="1">
            <input type="hidden" name="statut_id" value="2">
            @if(count($voitures) >= 1)
               @foreach ($voitures as $voiture)
               <input type="hidden" name="metadata[]" value="{{ $voiture->id }}">
               @endforeach
            @endif
            <div class="border--gray border-radius__5px p-2 mt-3" >         
               <h2 class='p-2'>Information</h2>
               <div class="py-3 px-2">
                  <label for="courriel">@lang('auth.email') *</label>
                  <div class="">
                        <input type="email" class="form__connexion__input" name="courriel" placeholder="@lang('auth.email')">
                  </div>
               </div>

               <h2 class='pt-5 pb-2 pl-2'>@lang('commande.adresse_livraison')</h2>
               <div class="py-3 px-2">
                  <label for="prenom">@lang('auth.prenom') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="prenom" >
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="nom">@lang('auth.nom') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="nom">
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="adresse">@lang('auth.adresse') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="adresse" placeholder="ex: 123 Rue Rpincipale">
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="ville">@lang('auth.ville') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="ville">
                  </div>
               </div>
               <div class="d-flex">
                  <div class="py-3 px-2">
                     <label for="province">@lang('auth.province') *</label>
                     <div class="">
                        <select name="province" id="province" class="form__connexion__input">
                           @foreach($provinces as $province)
                              <option value="{{$province->id}}">{{$province->nom}}</option>
                           @endforeach
                        </select>                  
                     </div>
                  </div>
                  <div class="py-3 px-2">
                     <label for="code_postal">@lang('auth.code_postal') *</label>
                     <div class="">
                           <input type="text" class="form__connexion__input" name="code_postal" placeholder="ex: H3Z 2Y7">
                     </div>
                  </div>
               </div>
               <div class="py-3 px-2">
                  <label for="telephone">@lang('auth.telephone') *</label>
                  <div class="">
                        <input type="text" class="form__connexion__input" name="telephone">
                  </div>
               </div>
               <button class="btn__caisse__reserver--desktop my-3">@lang('commande.btn_suivant')</button>
            </div>
         </form>
      </div>
      <div class="produit__panier__section col-12 col-lg-4">
         <div class="produit__panier__section__side col border--gray border-radius__5px p-2 ">
            <h2 class='p-2'>@lang('commande.delivery_method')</h2>
            <div class="produit__panier__expedition p-2">
               @if(count($voitures) < 1)
                  <p class="py-5 px-2">@lang('commande.indisponible')</p>           
               @else
               <form id="" method="post">
                  <div class="line-height-base h-70px" data-js-livraison-options>
                     <input type="radio" name="expedition" id="pmlivraison" data-js-expedition-livraison checked>
                     <label for="pmlivraison" class="btn__radio__option pmlivraison">
                        <div class="btn__radio__dot"></div>
                        <span>@lang('commande.pm_livrer')</span>
                     </label>
                  </div>
                  
                  <div class='pt-2 line-height-base h-70px' data-js-livraison-options>
                     <input type="radio" name="expedition" id="pmmagasin" data-js-expedition-collection>
                     <label for="pmmagasin" class="btn__radio__option pmmagasin">
                        <div class="btn__radio__dot"></div>
                        <span>@lang('commande.pm_collecte')</span>
                     </label>
                  </div>

                  <div class='pt-2 line-height-base h-70px' data-js-livraison-options>
                     <input type="radio" name="expedition" id="reserver" data-js-expedition-reservation>
                     <label for="reserver" class="btn__radio__option reserver">
                        <div class="btn__radio__dot"></div>
                        <span>@lang('commande.pay_sur_place')</span>
                     </label>
                  </div>
                  
               </form>
               @endif
            </div>
         </div>
         <div class="produit__panier__section__side col-12 col-md-6 col-lg-12 px-0">
            <div class="border--gray border-radius__5px p-2 position-sticky">
               <h2 class='p-2'>@lang('commande.sommaire')</h2>
               <div class="p-2 d-flex justify-content-between">
                  <div class="produit__panier__sommaire__head">
                     <p>@lang('commande.total_produits')</p>
                     <p>@lang('commande.livraison')</p>
                     <p>@lang('commande.sous_total')</p>
                     <p>@lang('commande.tps') (5%)</p>
                     <p>@lang('commande.tvq') (9.975%)</p>
                     <p>Total</p>
                  </div>
                  <div class="produit__panier__sommaire__body text-right">
                     <p><span data-js-total-produits></span> $</p>
                     <p><span data-js-frais-livraison></span></p>
                     <p><span data-js-sous-total></span> $</p>
                     <p><span data-js-tps></span> $</p>
                     <p><span data-js-tvq></span> $</p>
                     <p><span data-js-total-prix></span> $</p>
                  </div>
               </div>
               <button class="my-2 btn__commander w-100 text-bold" data-js-panier-btn-livraison>@lang('commande.payer')</button>
               <button class="my-2 btn__commander w-100 text-bold" data-js-panier-btn-collection>@lang('commande.payer')</button>
               <button class="my-2 btn__commander w-100 text-bold" data-js-panier-btn-reservation>@lang('commande.reserver')</button>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection('content')
<script src="{{asset('js/panier.js')}}"></script>
<script src="{{asset('js/prix.js')}}" async></script>
