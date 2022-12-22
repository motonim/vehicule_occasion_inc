window.addEventListener('DOMContentLoaded', (e) => {

   // page panier btns
   const btnExpLivraison = document.querySelector('[data-js-expedition-livraison]');
   const btnExpCollection = document.querySelector('[data-js-expedition-collection]');
   const btnExpReservation = document.querySelector('[data-js-expedition-reservation]');
   const btnPanierReserver = document.querySelector('[data-js-panier-btn-reserver]');
   const btnPanierPayer = document.querySelector('[data-js-panier-btn-payer]');
   const formulaireReserver = document.querySelector('[data-js-formulaire-reserver]');
   const formulairePayer = document.querySelector('[data-js-formulaire-payer]');

   btnPanierReserver.style.display = 'none';
   formulaireReserver.style.display = 'none';
   formulairePayer.style.display = 'none';
   document.querySelector('[data-js-frais-livraison]').innerText = '150 $'

   // Page Panier expedition options
   function cliquerSurRadio() {
      let livraison = true;

      if (btnExpLivraison.checked) {
         btnPanierReserver.style.display = 'none';
         btnPanierPayer.style.display = 'block';
         livraison = true;

      } else if (btnExpCollection.checked) {
         btnPanierReserver.style.display = 'block';
         btnPanierPayer.style.display = 'none';
         livraison = false;

      } else {
         btnPanierReserver.style.display = 'block';
         btnPanierPayer.style.display = 'none';
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

   btnPanierReserver.addEventListener('click', () => {
      formulairePayer.style.display = 'none';
      formulaireReserver.style.display = 'block';
      formulaireReserver.classList.add('slide-top');
      btnPanierReserver.classList.add('btn_disabled');
      btnPanierPayer.classList.remove('btn_disabled');

   })

   btnPanierPayer.addEventListener('click', () => {
      formulaireReserver.style.display = 'none';
      formulairePayer.style.display = 'block';
      formulairePayer.classList.add('slide-top');
      btnPanierPayer.classList.add('btn_disabled');
      btnPanierReserver.classList.remove('btn_disabled');
   })

})
