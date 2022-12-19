<template>
    <div class="filtre__desktop mt-3">
        <div class="py-2 text-white">
            <p class='filtre__titre py-2'>Marque</p>
            <div class='pb-4'>
                <div class="py-2" v-for="(marque, index) in marques" :key="marque.id">
                    <div class="">
                        <label class="checkbox" :for="'marque' + index">
                            <input type="checkbox" :id="'marque'+index" name="marque" :value="$marque.id" v-model="selected.marques"/>
                            <div class="checkbox__checkmark"></div>
                            <div class="checkbox__body">{{ marque.nom }} ({{ marque.products_count }})</div>
                        </label>
                    </div>
                </div>
                <!-- <div>
                            <p class='filtre__desktop__btn__voir-plus btn__border'>Montrer toutes les marques</p>
                        </div> -->
            </div>
        </div>
        <div class="py-2 text-white">
            <p class='filtre__titre py-2'>Modèle</p>
            <div class='pb-4'>
                <div class='py-2' v-for="(modele, index) in modeles" :key="modele.id">
                    <div class="">
                        <label class="checkbox" :for="'modele' + index">
                            <input type="checkbox" :id="'modele'+index" name="modele" :value="$modele.id" v-model="selected.modeles"/>
                            <div class="checkbox__checkmark"></div>
                            <div class="checkbox__body">{{ $modele.nom }} ({{ modele.products_count }})</div>
                        </label>
                    </div>

                </div>
                <!-- <div>
                    <p class='filtre__desktop__btn__voir-plus btn__border'>Montrer toutes les marques</p>
                </div> -->
            </div>
        </div>
        <!-- TODO AJOUTER LE RESTE DES CATÉGORIES - UNE FOIS QUE JE M'ASSURE QUE LES PREMIÈRES FONCTIONNENT-->
    </div>
</template>

<script>
export default {
    props: [
        'marque',
        'selectedMarque',
        'modele',
        'selectedModel'
    ]
    data() {
        return {
            categories: [],
            voitures: [],
            selectedCategory: null,
            loading: true
        }
    },
}
</script>
