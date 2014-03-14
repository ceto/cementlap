// Browser detection. Yes, really. Guess for which browser? Nope! Chrome.
var b = document.documentElement;
b.setAttribute('data-useragent',  navigator.userAgent);
b.setAttribute('data-platform', navigator.platform);

// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var ExampleSite = {
  // All pages
  common: {
    init: function() {
      // JS here
    },
    finalize: function() { }
  },
  // Home page
  home: {
    init: function() {
      // JS here
    }
  },
  // About page
  about: {
    init: function() {
      // JS here
    }
  }
};

var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = ExampleSite;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {

    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });

    UTIL.fire('common', 'finalize');
  }
};

$(document).ready(UTIL.loadEvents);


var resizeHero = function() {
  var off_canvas_nav_display = $('.off-canvas-navigation').css('display');
  if (off_canvas_nav_display === 'block') {
      //$('.single-product .main .product').height($(window).height()-($('.off-canvas-navigation').offset().top + $('.off-canvas-navigation').height()));
  
  } else {
    //$('.single-product .main .product').height($(window).height()-($('.banner').offset().top + $('.banner').height()));

    $('.single-product .main .product').css('min-height', $(window).height() - $('.main').offset().top );
    
    $('.single-post .main .post').css('min-height', $(window).height() - $('.main').offset().top );
    $('.single-post .main .post .repulo').css('min-height', $(window).height() - $('.main').offset().top );
    $('.single-post .main .post .addcont').css('min-height', $(window).height() - $('.main').offset().top );
    $('.slide-item img').css('min-height', $(window).height() - $('.main').offset().top );
  }
  //$('.contact-row.open').height($(window).height()-($('.banner').offset().top + $('.banner').height()));
  //$('.contact-row.open').css('min-height',($(window).height()-($('.banner').offset().top + $('.banner').height())));
};


var showMenu = function() {
  $('body').toggleClass("active-nav");
  $('.menu-button').toggleClass("active-button");
};

// add/remove classes everytime the window resize event fires
jQuery(window).resize(function(){
  var off_canvas_nav_display = $('.off-canvas-navigation').css('display');
  var menu_button_display = $('.menu-button').css('display');
  if (off_canvas_nav_display === 'block') {
    $("body").removeClass("two-column").addClass("small-screen");
  }
  if (off_canvas_nav_display === 'none') {
    $("body").removeClass("active-nav small-screen").addClass("two-column");
  }
  resizeHero();
});

jQuery(document).ready(function($) {
  $('.menu-button').click(function(e) {
    e.preventDefault();
    showMenu();
  });
  resizeHero();
  $(".main").fitVids();

  /************* Product Filter Fixing ***********/
  if ( $('#filt-wrap').length ){
    var top = $('#filt-wrap').offset().top - parseFloat($('#filt-wrap').css('marginTop').replace(/auto/, 0));
    $(window).scroll(function (event) {
      var y = $(this).scrollTop();
      if (y >= top) {
        $('#filt-wrap').addClass('fixed');
      } else {
        $('#filt-wrap').removeClass('fixed');
      }
    });
  }


  /************* Slide Gallery Controls ***********/
  $('.repulotoggle').click(function(e){
    $(this).toggleClass('hidden');
    $('.repulo').toggleClass('hide');
    $('.addcont').toggleClass('full');
    return false;
  });
  
  var $aktslide=0;
  $('.slide-item').eq($aktslide).toggleClass('active');

  $('.slidecontroll .prev').click(function(e){
    if ($aktslide > 0) {
      $('.slidegallery ul').css({marginLeft: function(index, value) {
        return parseFloat(value) + $('.slide-item').eq($aktslide).width();
      }});
      $('.slide-item').eq($aktslide).toggleClass('active');
      $aktslide--;
      $('.slide-item').eq($aktslide).toggleClass('active');
    }
    return false;
  });

  $('.slidecontroll .next').click(function(e){
    if ($aktslide < ($('.slide-item').length -1) ) {
      $('.slidegallery ul').css({marginLeft: function(index, value) {
        return parseFloat(value) - $('.slide-item').eq($aktslide).width();
      }});
      $('.slide-item').eq($aktslide).toggleClass('active');
      $aktslide++;
      $('.slide-item').eq($aktslide).toggleClass('active');
    }
    return false;
  });



});



/********** Product Control scripts *********/
$(window).load(function(){
  var $container = $('.main .product-list'),
    filters = {};

  $container.isotope({
    itemSelector : '.prod-mini',
    animationOptions: {
      duration: 750,
      easing: 'linear',
      queue: false
    }
  });

  // filter buttons
  $('.filt-item-input').click(function(){
    $(this).parent().parent().toggleClass('hide');
    var $optionSet = $(this).parents('.filt-item');


    // don't proceed if already selected
    // if ( $this.hasClass('selected') ) {
    //   return;
    // }
    
    var group = $optionSet.attr('data-filter-group');
    
    $optionSet.find('.selected').each(function(){
      //filters[ group ] = $(this).attr('data-filter-value');
      $(this).removeClass('selected');
      //window.alert($(this).attr('data-filter-value'));
    });

    $(this).toggleClass('selected');
    if ( $(this).hasClass('selected') ) {
      filters[ group ] = $(this).attr('data-filter-value');
    }
    
 

    // convert object into array
    var isoFilters = [];
    for ( var prop in filters ) {
      isoFilters.push( filters[ prop ] );
    }
    var selector = isoFilters.join('');
    $container.isotope({ filter: selector });
    return false;
  });

});


jQuery(document).ready(function($){
  $('.filt-placeholder').click(function(e){
    e.preventDefault();
    $(this).toggleClass('selected');
    $($(this).attr('data-filter-name')).toggleClass('hide');
  });
});



