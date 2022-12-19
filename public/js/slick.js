$(function() { 
    $('.slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '320px',
        arrows:true,
        prevArrow: '.arrow-prev',
        nextArrow: '.arrow-next',
        responsive: [
            {
            breakpoint: 1500,
            settings: {
                // arrows: false,
                centerMode: true,
                centerPadding: '100px',
                slidesToShow: 1,
                slidesToScroll: 1,
            }
            },
            {
            breakpoint: 1020,
            settings: {
                // arrows: false,
                centerMode: false,
                centerPadding: '0px',
                slidesToShow: 1,
                slidesToScroll: 1,
            }
            }
        ]
    }),
    $('.accueil-slider').slick({
     infinite: true,
     slidesToShow: 3,
     slidesToScroll: 1,
     centerMode: true,
     centerPadding: '20px',
     arrows:true,
     prevArrow: '.arrow-prev-accueil',
     nextArrow: '.arrow-next-accueil',
     responsive: [
         {
         breakpoint: 1500,
         settings: {
             // arrows: false,
             centerMode: true,
             centerPadding: '100px',
             slidesToShow: 3,
             slidesToScroll: 1,
         }
         },
         {
         breakpoint: 1020,
         settings: {
             // arrows: false,
             centerMode: false,
             centerPadding: '0px',
             slidesToShow: 3,
             slidesToScroll: 1,
         }
         },
         {
             breakpoint: 768,
             settings: {
                 // arrows: false,
                 centerMode: false,
                 centerPadding: '0px',
                 slidesToShow: 1,
                 slidesToScroll: 1,
             }
         }
     ]
 })
 }); 