window.addEventListener('DOMContentLoaded', (e) => {

   // page panier btns
   const btnExpLivraison = document.querySelector('[data-js-expedition-livraison]');
   const btnExpCollection = document.querySelector('[data-js-expedition-collection]');
   const btnExpReservation = document.querySelector('[data-js-expedition-reservation]');
   const btnPanierReservation = document.querySelector('[data-js-panier-btn-reservation]');
   const btnPanierLivraison = document.querySelector('[data-js-panier-btn-livraison]');
   const btnPanierCollection = document.querySelector('[data-js-panier-btn-collection]');
   const formulaireReservation = document.querySelector('[data-js-formulaire-reservation]');
   const formulaireLivraison = document.querySelector('[data-js-formulaire-livraison]');
   const formulaireCollection = document.querySelector('[data-js-formulaire-collection]');

   btnPanierReservation.style.display = 'none';
   btnPanierCollection.style.display = 'none';
   formulaireReservation.style.display = 'none';
   formulaireLivraison.style.display = 'none';
   formulaireCollection.style.display = 'none';
   document.querySelector('[data-js-frais-livraison]').innerText = '150 $'

   // Page Panier expedition options
   function cliquerSurRadio() {
      let livraison = true;

      if (btnExpLivraison.checked) {
         btnPanierReservation.style.display = 'none';
         btnPanierCollection.style.display = 'none';
         btnPanierLivraison.style.display = 'block';
         livraison = true;

      } else if (btnExpCollection.checked) {
         btnPanierReservation.style.display = 'none';
         btnPanierLivraison.style.display = 'none';
         btnPanierCollection.style.display = 'block';
         livraison = false;

      } else {
         btnPanierLivraison.style.display = 'none';
         btnPanierCollection.style.display = 'none';
         btnPanierReservation.style.display = 'block';
         livraison = false;

      }

      if(livraison) {
         document.querySelector('[data-js-frais-livraison]').innerText = '150 $'
      } else {
         document.querySelector('[data-js-frais-livraison]').innerText = 'GRAUITE';
      }
   }


   const btnRadios = document.querySelectorAll('input[name="expedition"]');
   btnRadios.forEach(radio => {
      radio.addEventListener('click', cliquerSurRadio);
   });

   btnPanierLivraison.addEventListener('click', () => {
      formulaireReservation.style.display = 'none';
      formulaireCollection.style.display = 'none';
      formulaireLivraison.style.display = 'block';
      formulaireLivraison.classList.add('slide-top');
      btnPanierLivraison.classList.add('btn_disabled');
      btnPanierReservation.classList.remove('btn_disabled');
      btnPanierCollection.classList.remove('btn_disabled');

   })

   btnPanierCollection.addEventListener('click', () => {
      formulaireLivraison.style.display = 'none';
      formulaireReservation.style.display = 'none';
      formulaireCollection.style.display = 'block';
      formulaireCollection.classList.add('slide-top');
      btnPanierCollection.classList.add('btn_disabled');
      btnPanierReservation.classList.remove('btn_disabled');
      btnPanierLivraison.classList.remove('btn_disabled');
   })

   btnPanierReservation.addEventListener('click', () => {
      formulaireCollection.style.display = 'none';
      formulaireLivraison.style.display = 'none';
      formulaireReservation.style.display = 'block';
      formulaireReservation.classList.add('slide-top');
      btnPanierReservation.classList.add('btn_disabled');
      btnPanierLivraison.classList.remove('btn_disabled');
      btnPanierCollection.classList.remove('btn_disabled');
   })

})
