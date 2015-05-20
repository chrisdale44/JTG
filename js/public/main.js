$(document).ready(function($) {
  'use strict';

  // JS to open/close the filter navigation menu
  $('.mobile-menu').click(function(){
    $('.filterNav').toggleClass('open');
  });

  // ==== Sticky mobile nav menu =====

  var filterNav = $('.filterNav'),
      navOffsetTop;

  function getNavOffset() {
    if(!$(filterNav).hasClass('fixed')) {
      navOffsetTop = filterNav.offset().top;
    } 
  }

  getNavOffset();

  // On window resize (debounced)
  $(window).on("debouncedresize", function( event ) {
    // Sticky Nav
    getNavOffset();
  });

  // On scroll
  $(window).bind('scroll', function() {
      // Sticky Nav
      filterNav.toggleClass('fixed', $(window).scrollTop() > navOffsetTop);
      $('.header').toggleClass('fixedNav', $(window).scrollTop() > navOffsetTop);
      getNavOffset();
  });

  // ==== Isotope ====

  var bioContainer = $('.biographies').isotope({
      itemSelector: '.isotopeItem',
      resizable: false,
    });

  bioContainer.isotope({ filter: '.dummy' });

  var bothContainer = $('.img-grid-container, .biographies').imagesLoaded( function() {
    bothContainer.isotope({
      itemSelector: '.isotopeItem',
      resizable: false,
    });
  });

  var imgContainer = $('.img-grid-container').imagesLoaded( function() {
    imgContainer.isotope({
      itemSelector: '.isotopeItem',
      resizable: false,
    });
  });

  // filter tiles using isotope
  $('.filterNav ul, .art-info').on( 'click', 'a', function() {
    var filterValue = $(this).attr('data-filter');

    if (filterValue == "*" ||
        filterValue == ".print" ||
        filterValue == ".photo") {
        bioContainer.isotope({ filter: '.dummy' });
        imgContainer.isotope({ filter: filterValue });
    } else {
        bothContainer.isotope({ filter: filterValue });
    }

    $('.filterNav a').removeClass('selected');
    $('.filterNav a[data-filter="' + filterValue + '"]').addClass('selected');
  });

  // init lightcase
  $('a[data-rel^=lightcase]').lightcase();
});

