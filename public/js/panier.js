window.addEventListener('DOMContentLoaded', (e) => {

   // page panier btns
   const btnExpLivraison = document.querySelector('[data-js-expedition-livraison]');
   const btnExpCollection = document.querySelector('[data-js-expedition-collection]');
   const btnExpReservation = document.querySelector('[data-js-expedition-reservation]');
   const btnPanierReservation = document.querySelector('[data-js-panier-btn-reservation]');
   const btnPanierPayer = document.querySelector('[data-js-panier-btn-payer]');
   

   btnPanierReservation.style.display = 'none';
   document.querySelector('[data-js-frais-livraison]').innerText = '150 $'

   // Page Panier expedition options
   function cliquerSurRadio() {
      let livraison = true;

      if (btnExpLivraison.checked) {
         btnPanierReservation.style.display = 'none';
         btnPanierPayer.style.display = 'block';
         livraison = true;

      } else if (btnExpCollection.checked) {
         btnPanierReservation.style.display = 'none';
         btnPanierPayer.style.display = 'block';
         livraison = false;

      } else {
         btnPanierPayer.style.display = 'none';
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


})
