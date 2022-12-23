@extends('layouts.app')
@section('content')

<div class="container py-5">
   <div class="row">
      <div class="produit__panier__section col-12">
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
               <div class="d-flex justify-content-center">
                  <button class="btn__inscription my-3">@lang('commande.btn_suivant')</button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <!-- <button class="btn__caisse__reserver--desktop mt-3">@lang('commande.btn_suivant')</button> -->
</div>
@endsection('content')