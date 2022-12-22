window.addEventListener('DOMContentLoaded', (e) => {
   updateCartTotal();
   
   let livraisonOptions = document.querySelectorAll('[data-js-livraison-options]');
   for ( let i = 0; i < livraisonOptions.length; i++ ) {
      livraisonOptions[i].addEventListener('click', updateCartTotal)
   }

   function updateCartTotal() {
      let cartItemContainer = document.querySelectorAll('[data-js-voiture-prix]')
      let sousTotal = document.querySelector('[data-js-sous-total]')
      let fraisLivraison = document.querySelector('[data-js-frais-livraison]')
      let totalProduits = document.querySelector('[data-js-total-produits]')
      let impotTPS = document.querySelector('[data-js-tps]')
      let impotTVQ = document.querySelector('[data-js-tvq]')
      let totalPrix = document.querySelector('[data-js-total-prix]')
      let sum = 0

      for(let i = 0; i < cartItemContainer.length; i++) {
         sum += parseFloat(cartItemContainer[i].textContent);
      } 

      totalProduits.innerText = sum

      if(fraisLivraison.innerText === '150 $') {
         sum += 150
      }

      sousTotal.innerText = sum
      let totalTPS = (sum * 0.05).toFixed(2)
      let totalTVQ = (sum * 0.09975).toFixed(2)
      impotTPS.innerText = totalTPS
      impotTVQ.innerText = totalTVQ
      let totalFinal = sum + parseFloat(totalTPS) + parseFloat(totalTVQ)
      totalPrix.innerText = totalFinal.toFixed(2)
   }

})