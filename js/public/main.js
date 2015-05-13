$(document).ready(function($) {
  'use strict';
  
  // init isotope for image grid
  var container = $('.img-grid-container').imagesLoaded( function() {
    container.isotope({
      // options
      itemSelector: '.tile',
      resizable: false,
      //layoutMode: 'fitRows',
    });
  });

  // filter tiles using isotope
  $('.artistNav, .art-info').on( 'click', 'a', function() {
    var filterValue = $(this).attr('data-filter');
    container.isotope({ filter: filterValue });
    $('.artistNav a').removeClass('selected');
    $('.artistNav a[data-filter="' + filterValue + '"]').addClass('selected');
  });

  // init lightcase
  $('a[data-rel^=lightcase]').lightcase();
});