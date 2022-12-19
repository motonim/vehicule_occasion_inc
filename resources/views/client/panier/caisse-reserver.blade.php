@extends('layouts.app')
@section('content')

<div class="container py-5">
   <div class="row">
      <div class="produit__panier__section col-12 col-lg-8">
         <div class="border--gray border-radius__5px p-2">         
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
               <label for="infoSupp">@lang('commande.infoSupplementaires') *</label>
               <div class="">
                     <input type="text" class="form__connexion__input" name="infoSupp" placeholder="ex: Suite 200">
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
                        <option value="" selected>-</option>
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
         </div>
         <button class="btn__caisse__reserver--desktop mt-3">@lang('commande.btn_suivant')</button>
      </div>
      <div class="produit__panier__section col-12 col-lg-4">
         <div class="col-12 px-0">
            <div class="border--gray border-radius__5px p-2">
               <h2 class='p-2'>@lang('commande.sommaire')</h2>
               <p class='mx-2 pb-3 my-3 border--bt--gray'>2 Produit(s) (<a href="" class="panier__modification">@lang('commande.modifier_panier')</a>)</p>
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
                     <p>227956.25 $</p>
                     <p>@lang('commande.gratuite')</p>
                     <p>227956.25 $</p>
                     <p>11397.81 $</p>
                     <p>22738.63 $</p>
                     <p>262092.69 $</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <button class="btn__caisse__reserver--mobile mt-3">ÉTAPE SUIVANTE</button>
</div>
@endsection('content')