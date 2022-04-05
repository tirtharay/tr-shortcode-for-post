jQuery(document).ready(function ($) {

    var owl = $('.tr-carousel');
    owl.owlCarousel({
        margin: 17,
        nav: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
	
	  // Initialize post slick carousel slider.
    if ($(window).width() < 768) {
 		jQuery(".tr-container.dossies-item-container").parent().css("display", 'block');
 		jQuery(".tr-container.dossies-item-container").parent().css("width", '100%');
 		jQuery(".dossies-item-container").css("display", 'block');
        $('.tr-slick-slider').slick({
            dots: true,
            infinite: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

});