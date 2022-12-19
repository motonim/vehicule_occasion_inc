<template>
   <div class="container py-5" :class="{'loading': loading}">
      <div class="row">
         <div class="produit__panier__section col-12 col-lg-8">
            <div class="border--gray border-radius__5px p-2">         
               <h2 class='p-2'>@lang('commande.panier_articles')</h2>
               <div class="produit__panier__item py-3 d-flex justify-content-between align-items-center" v-for="item in items" :key="item.id">
                  <img src="{{ asset('assets/img/' . item.imagePrincipale) }}" alt="" class='produit__img w-25 p-2'>
                  <div class="produit__panier__attributes w-75 p-2 mx-5">
                     <p class='produit__panier__titre'>{{item.annee}}  {{item.marque}} {{item.modele}}</p>
                     <p class="produit__panier__prix">{{ item.prixAchat }} $</p>
                  </div>
                  <div class="produit__panier__supprimer pr-2">
                     <button><i class="fa-regular fa-rectangle-xmark font-color-yellow"></i></button>
                  </div>
               </div>

               <!-- <div class="produit__panier__item py-3 d-flex justify-content-between align-items-center">
                  <img src="{{asset('assets/img/car-no-bg-1.png')}}" alt="" class='produit__img w-25 p-2'>
                  <div class="produit__panier__attributes w-75 p-2 mx-5">
                     <p class='produit__panier__titre'>2022 Maserati Grecale PrimaSerie</p>
                     <p class="produit__panier__prix">227956.25 $</p>
                  </div>
                  <div class="produit__panier__supprimer pr-2">
                     <button><i class="fa-regular fa-rectangle-xmark font-color-yellow"></i></button>
                  </div>
               </div> -->
            </div>
         </div>
         <div class="produit__panier__section col-12 col-lg-4">
            <div class="produit__panier__section__side col-12 col-md-6 col-lg-12 border--gray border-radius__5px p-2">
               <h2 class='p-2'>@lang('commande.delivery_method')</h2>
               <div class="produit__panier__expedition p-2">
                  <form id="" method="post">
                     <div>
                        <input type="radio" name="expedition" id="pmlivraison" data-js-expedition-livraison checked>
                        <label for="pmlivraison" class="btn__radio__option pmlivraison">
                           <div class="btn__radio__dot"></div>
                           <span>@lang('commande.pm_livrer')</span>
                        </label>
                     </div>
                     
                     <div class='pt-2'>
                        <input type="radio" name="expedition" id="pmmagasin" data-js-expedition-collection>
                        <label for="pmmagasin" class="btn__radio__option pmmagasin">
                           <div class="btn__radio__dot"></div>
                           <span>@lang('commande.pm_collecte')</span>
                        </label>
                     </div>

                     <div class='pt-2'>
                        <input type="radio" name="expedition" id="reserver" data-js-expedition-reservation>
                        <label for="reserver" class="btn__radio__option reserver">
                           <div class="btn__radio__dot"></div>
                           <span>@lang('commande.pay_sur_place')</span>
                        </label>
                     </div>
                     
                  </form>
               </div>
            </div>
            <div class="produit__panier__section__side col-12 col-md-6 col-lg-12 px-0">
               <div class="border--gray border-radius__5px p-2">
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
                        <p>227956.25 $</p>
                        <p>@lang('commande.gratuite')</p>
                        <p>227956.25 $</p>
                        <p>11397.81 $</p>
                        <p>22738.63 $</p>
                        <p>262092.69 $</p>
                     </div>
                  </div>
                  <a href="#" class="my-2 btn__commander w-100 text-bold" data-js-panier-btn-payer>@lang('commande.payer')</a>
                  <a href="{{route('commande.reserver')}}" class="my-2 btn__commander w-100 text-bold" data-js-panier-btn-reserver>@lang('commande.reserver')</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>


<script>
import { computed } from '@vue/runtime-core';
export default {
   data () {
      return {
         items: [],
         loading: true,
      }
   },

   mounted() {
      this.getKms();
      this.getMarques();
      this.getModeles();
      this.getVoitures();
   },

   watch: {
      selected: {
         handler: function () {
               this.getKms();
               this.getMarques();
               this.getModeles();
               this.getVoitures();
         },
         deep: true
      }
   },

   methods: {
      getMarques () {
         axios.get('/marque', {
                  params: _.omit(this.selected, 'marques')
               })
               .then((response) => {
                  this.marques = response.data.data;
                  this.loading = false;
               })
               .catch(function (error) {
                  console.log(error);
               });
      },

      getModeles () {
         axios.get('/modele', {
                  params: _.omit(this.selected, 'modeles')
               })
               .then((response) => {
                  this.modeles = response.data.data;
                  this.loading = false;
               })
               .catch(function (error) {
                  console.log(error);
               });
      },

      getKms () {
         axios.get('/km', {
                  params: _.omit(this.selected, 'kms')
               })
               .then((response) => {
                  this.kms = response.data;
                  this.loading = false;
               })
               .catch(function (error) {
                  console.log(error);
               });
      },

      getVoitures () {
         axios.get('/voiture', {
                  params: this.selected
               })
               .then((response) => {
                  this.voitures = response.data.data;
                  this.loading = false;
               })
               .catch(function (error) {
                  console.log(error);
               });
      }
   },
}

</script>

