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
               @if(count($voitures) < 1)
                  <p class="py-5 px-2">@lang('commande.indisponible')</p>           
               @else
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
               
               <form action="{{ route('commande.paypal') }}" method="POST" data-js-panier-btn-payer>
                  @csrf
                  <input type="hidden" name="prix" id="payer-maintenat" value="">
                  <button type="submit" class="d-flex justify-content-center align-items-center my-2 btn__commander w-100 text-bold" >@lang('commande.payer_avec')
                     <!-- PayPal Logo --><table class="ml-2" border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/c2/webapps/mpp/home?locale.x=en_C2" title="PayPal" onclick="javascript:window.open('https://www.paypal.com/c2/webapps/mpp/home?locale.x=en_C2','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/digitalassets/c/website/marketing/apac/C2/logos-buttons/optimize/26_Grey_PayPal_Pill_Button.png" alt="PayPal" /></a></td></tr></table><!-- PayPal Logo -->
                  </button>
               </form>
      
               <a href="{{ route('panier.reserver') }}" class="my-2 btn__commander w-100 text-bold" data-js-panier-btn-reservation>@lang('commande.reserver')</a>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>

@endsection('content')
<script src="{{asset('js/panier.js')}}"></script>
<script src="{{asset('js/prix.js')}}" async></script>
