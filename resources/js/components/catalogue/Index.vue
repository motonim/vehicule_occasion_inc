<template>
    <div class="container my-2" :class="{'loading': loading}">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="" class='btn__border filtre__mobile__titre' data-bs-toggle="collapse"
                        data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">Filtre <span class='font-color-yellow'><i
                                class="fa-solid fa-chevron-down ml-2"></i></span></a>
                    <p class='filtre__desktop__titre'><span class='font-color-yellow'><i
                                class="fa-solid fa-filter mr-2"></i></span> Filtre</p>
                    <div class="trier__mobile trier">
                        <select name="tri" id="tri" class='form-select trier__select'>
                            <option value="nouveaux">Nouveaux arrivages</option>
                            <option value="prixAsc">Prix asc.</option>
                            <option value="prixDesc">Prix desc.</option>
                        </select>
                        <span class='font-color-yellow trier__arrow'><i
                                class="fa-solid fa-chevron-down ml-2"></i></span>
                    </div>
                    <div class="trier__desktop trier">
                        <select name="tri" id="tri" class='form-select trier__select'>
                            <option value="nouveaux">Trier par: Nouveaux arrivages</option>
                            <option value="prixAsc">Trier par: Prix asc.</option>
                            <option value="prixDesc">Trier par: Prix desc.</option>
                        </select>
                        <span class='font-color-yellow trier__arrow'><i
                                class="fa-solid fa-chevron-down ml-2"></i></span>
                    </div>
                </div>

                <!-- filtre__mobile -->
                <div class="collapse filtre__mobile" id="navbarToggleExternalContent">
                    <div class="py-2 text-white">
                        <p class='filtre__titre py-2'>Marque</p>
                        <div class='pb-4'>
                            <div class='py-2'>
                                <!-- ajouter les catégories version mobile -->
                            </div>
                            <div class='d-flex justify-content-center'>
                                <p class='filtre__btn__voir-plus btn__border'>Montrer toutes les marques</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-between">
            <!-- <sidebar/> -->
            <!-- FILTRE -->
            <div class="filtre__desktop mt-3">
                <!-- <div class="py-2 text-white">
                    <p class='filtre__titre py-2'>Marque</p>
                    <div class='pb-4'>
                        <div class="py-2" v-for="marque in marques" :key="marque.id">
                            <div class="">
                                <label class="checkbox" :for="('marque' + marque.id)">
                                    <input type="checkbox" :id="('marque' + marque.id)" name="marque" :value="marque.id" v-model="selected.marques"/>
                                    <div class="checkbox__checkmark"></div>
                                    <div class="checkbox__body">{{ marque.nom }} ({{ marque.voitures_count }})</div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <p class='filtre__desktop__btn__voir-plus btn__border'>Montrer toutes les marques</p>
                        </div>
                    </div>
                </div> -->
                <div class="py-2 text-white">
                    <p class='filtre__titre py-2'>Modèle</p>
                    <div class='pb-4'>
                        <div class="py-2" v-for="modele in modeles" :key="modele.id">
                            <div class="">
                                <label class="checkbox" :for="('modele' + modele.id)">
                                    <input type="checkbox" :id="('modele' + modele.id)" name="modele" :value="modele.id" v-model="selected.modeles"/>
                                    <div class="checkbox__checkmark"></div>
                                    <div class="checkbox__body">{{ modele.nom }} ({{ modele.voitures_count }})</div>
                                </label>
                            </div>
                        </div>
                        <!-- <div>
                            <p class='filtre__desktop__btn__voir-plus btn__border'>Montrer tous les modèles</p>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="py-2 text-white">
                    <p class='filtre__titre py-2'>Kilométrage</p>
                    <div class='pb-4'>
                        <div class="py-2" v-for="(km, index) in kms" :key="km.index">
                            <div class="">
                                <label class="checkbox" :for="('km' + index)">
                                    <input type="checkbox" :id="('km' + index)" name="km" :value="index" v-model="selected.kms"/>
                                    <div class="checkbox__checkmark"></div>
                                    <div class="checkbox__body">{{ km.nom }} ({{ km.voitures_count }})</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- TODO AJOUTER LE RESTE DES CATÉGORIES - UNE FOIS QUE JE M'ASSURE QUE LES PREMIÈRES FONCTIONNENT-->
            </div>
            <!-- <voiture class="produit__section pb-5" v-for="voiture in voitures" :key="voiture.id" :voiture="voiture">
            </voiture> -->

            <!-- Affichage de catalogue -->
            <div class="produit__section pb-5">
                <div class="produit__container" v-for="voiture in voitures" :key="voiture.id">
                    <a :href="'catalogue/voiture/vo-' + voiture.id" class='produit'>
                        <img :src="'assets/img/' + voiture.imagePrincipale" alt="" class='produit__img'>
                        <p class='produit__titre'>{{ voiture.modele_nom }}</p>
                        <p class='produit__type'>{{ voiture.marque_nom }}</p>
                        <div class="produit__num d-flex justify-content-between">
                            <p class='produit__km'>{{ voiture.km }} Km</p>
                            <p class='produit__prix'> {{ voiture.prix }} $ </p>
                        </div>
                    </a>
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
            marques: [],
            modeles: [],
            kms: [],
            voitures: [],
            loading: true,
            selected: {
                marques: [],
                modeles: [],
                kms: []
            }
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

