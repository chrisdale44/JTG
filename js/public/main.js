$(document).ready(function($) {
  'use strict';
  
  // init isotope for image grid
  var container = $('.img-grid-container').imagesLoaded( function() {
    container.isotope({
      // options
      itemSelector: '.tile',
      resizable: false,
      masonry: {
      }
    });
  });

  // filter tiles using isotope
  $('.artistNav').on( 'click', 'a', function() {
    var filterValue = $(this).attr('data-filter');
    container.isotope({ filter: filterValue });
    $('.artistNav a').removeClass('selected');
    $(this).addClass('selected');
  });

  // init lightcase
  $('a[data-rel^=lightcase]').lightcase();
});