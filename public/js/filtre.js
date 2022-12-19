
const filtreBtn = document.querySelector('.filtre__btn__voir-plus');
const filtreDesktopBtn = document.querySelector('.filtre__desktop__btn__voir-plus');
const plusMarques = document.querySelector('.filtre__marque__plus');
const desktopPlusMarques = document.querySelector('.filtre__desktop__marque__plus');

filtreBtn.addEventListener('click', () => {
   plusMarques.classList.toggle('filtre__marque__plus--open')
   filtreBtn.textContent = filtreBtn.textContent.includes('Montrer toutes les marques') ? 'Montrer moins de marques' : 'Montrer toutes les marques'
})

filtreDesktopBtn.addEventListener('click', () => {
   desktopPlusMarques.classList.toggle('filtre__desktop__marque__plus--open')
   filtreDesktopBtn.textContent = filtreDesktopBtn.textContent.includes('Montrer toutes les marques') ? 'Montrer moins de marques' : 'Montrer toutes les marques'
})
