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


//********** Scroll Direction Check *************//
var felcsoki=0;
var lecsoki=0;
var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel"; //FF doesn't recognize mousewheel as of FF3.x
$(document).bind(mousewheelevt, function(e) {
        var evt = window.event || e; //equalize event object
        evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible
        var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta; //check for detail first, because it is used by Opera and FF
        if(delta > 0)
            {
            //console.log('Felfele');
            if (felcsoki++ >= 4 ) {
              lecsoki=0;
              $('.banner').addClass('ison');
            }
            }
        else
            {
            //console.log('Lefele');
            if (lecsoki++ > 2 ) {
              felcsoki=0;
              $('.banner').removeClass('ison');
            }
            }
    }
);

/************* Main header Fixing ***********/
// var htop = $('.banner').offset().top - parseFloat($('.banner').css('marginTop').replace(/auto/, 0));
var htop=0;
$(window).scroll(function (event) {
  var y = $(this).scrollTop();
  if (y-40 >= htop) {
    $('.banner').addClass('scrolled');
  } else {
    $('.banner').removeClass('scrolled');
  }
  //$('body').attr('data-offset' ,  $('.banner').height() );
});



var resizeHero = function() {
  var off_canvas_nav_display = $('.off-canvas-navigation').css('display');
  if (off_canvas_nav_display === 'block') {

  } else {

    if ($(window).height() > 700) {
    }
  }
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



  function prevclick(){
    $('.slidecontroll .prev').off('click', prevclick);

    if ($aktslide > 0) {
      $('.slidegallery ul').css({marginLeft: function(index, value) {
        $margit=parseFloat(value) + $('.slide-item').eq($aktslide-1).width();
        return $margit;
      }});
      $('.slidegallery ul').css({marginRight: function(index, value) {
        return 0-$margit;
      }});
      $('.slide-item').eq($aktslide).toggleClass('active');
      $aktslide--;
      $('.slide-item').eq($aktslide).toggleClass('active');
    }
    setTimeout(function(){
      $('.slidecontroll .prev').on('click',prevclick);
    },250);
    return false;
  }

  function nextclick(){

    $('.slidecontroll .next').off('click', nextclick);

    if ($aktslide < ($('.slide-item').length -1) ) {
      $('.slidegallery ul').css({marginLeft: function(index, value) {
        $margit=parseFloat(value) - $('.slide-item').eq($aktslide).width();
        return $margit;
      }});
      $('.slidegallery ul').css({marginRight: function(index, value) {
        return 0-$margit;
      }});
      $('.slide-item').eq($aktslide).toggleClass('active');
      $aktslide++;
      $('.slide-item').eq($aktslide).toggleClass('active');
    }
    setTimeout(function(){
      $('.slidecontroll .next').on('click',nextclick);
    },250);
    return false;
  }





  var $aktslide=0;
  $('.slide-item').eq($aktslide).toggleClass('active');
  var $margit=0;

  $('.slidecontroll .prev').on('click',prevclick);
  $('.slidecontroll .next').on('click',nextclick);


  // $('.repulotoggle').click(function(e){
  //   $(this).toggleClass('hidden');
  //   $('.repulo').toggleClass('hide');
  //   $('.addcont').toggleClass('full');

  //   $('.slidegallery ul').css({marginLeft: '0'});
  //   $('.slidegallery ul').css({marginRight: '0'});
  //   $('.slide-item').eq($aktslide).removeClass('active');
  //   $aktslide=0;
  //   $('.slide-item').eq($aktslide).addClass('active');
  //   $margit=0;

  //   return false;
  // });



});






  var $container = $('.main .product-list'),
  filters = {};


/********** Product Control scripts *********/
$(window).load(function(){




  $container.isotope({
    itemSelector : '.prod-mini',
    layoutMode: 'cellsByRow',
    animationOptions: {
      duration: 750,
      easing: 'linear',
      queue: false
    }
   });





  // filter buttons
  $('.filt-item-input').on('click',function(){
    $(this).parent().parent().toggleClass('hide');
    $(this).parent().parent().parent().find('.filt-placeholder').toggleClass('selected');

    var $optionSet = $(this).parents('.filt-item');

    var group = $optionSet.attr('data-filter-group');

    $optionSet.find('.selected').each(function(){
      $(this).removeClass('selected');
    });

    $(this).toggleClass('selected');

    if ( $(this).hasClass('selected') ) {
      $(this).parent().parent().parent().find('.filt-placeholder em').remove();
      if ( $(this).attr('data-filter-value')!=='*') {
        $(this).parent().parent().parent().addClass('active');
        $(this).parent().parent().parent().find('.filt-placeholder').append('<em>'+$(this).parent().find('label').html()+'</em>');
        filters[ group ] = $(this).attr('data-filter-value');
      } else {
        $(this).parent().parent().parent().removeClass('active');
        filters[ group ] = [];
      }
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


  $('.filt-item li input').each(function(){
    if ( $('.product-list '+$(this).attr('data-filter-value')).length < 1)  {
     $(this).parent().remove();
    }
  });


  if ($.bbq.getState('filter')!==''){
    //$container.isotope({ filter: $.bbq.getState('filter') });
    $('.filt-item-input[data-filter-value="'+$.bbq.getState('filter')+'"]').trigger('click');
  } else {
    $('.filt-item-input[data-filter-value=".*"]').trigger('click');
  }


  //window.alert('Pina'+$.bbq.getState('filter'));

  /*********------------- Hashing -----------********/

  // $('.filt-item-input').click(function(){
  //   var href = $(this).attr('href').replace( /^#/, '' ),
  //   option = $.deparam( href, true );
  //   //option.filter+=' '+$.bbq.getState('filter');
  //   //window.alert('Pina'+$.bbq.getState('filter'));
  //   //window.alert(option);
  //   $.bbq.pushhState( option );
  //   return false;
  // });


});


/******* BBQ *******/
$(window).bind( 'hashchange', function( event ){
  // get options object from hash
  var hashOptions = $.deparam.fragment();
  // apply options from hash
  $container.isotope( hashOptions );
});
  // trigger hashchange to capture any hash data on init
  //.trigger('hashchange');


//Fixes the issue where fonts are not loading with Google Chrome & websites using Google Webfonts
// var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
// if(is_chrome) {
//   jQuery(window).load(function(){jQuery('body').width(jQuery('body').width()+1).width('auto');});
// }

function share_click(mi, width, height, media) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
    var u=location.href;
    var t=document.title;
    if (mi==='fb') {
      window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
    } else {
      if (mi==='pi') {
        window.open('http://www.pinterest.com/pin/create/button/?url='+encodeURIComponent(u)+'&media='+media+'&description='+encodeURIComponent(t),'sharer', windowFeatures);
      }
    }
    return false;
}


jQuery(document).ready(function($){

  $('.filt-placeholder').click(function(e){
    e.preventDefault();
    $(this).toggleClass('selected');
    $($(this).attr('data-filter-name')).toggleClass('hide');
  });

  $('.product-list').removeClass('loading');
  $('.loader').removeClass('loading');
  $('.share-info').click(function(){
    $('.flip-container').toggleClass('hover');
    return false;
  });

  $(".uszo #owl-refgal").owlCarousel({
      autoPlay: 6000, //Set AutoPlay to 3 seconds
      items : 5,
      pagination:false,
      itemsMobile : [480, 5],
      itemsTablet : [768,7],
      itemsDesktop : false,
      itemsDesktopSmall : false
  });

  $(".stheader #owl-refgal").owlCarousel({
      autoPlay: 6000, //Set AutoPlay to 3 seconds
      items : 4,
      pagination:false,
      itemsMobile : [480, 3],
      itemsTablet : [768,5],
      itemsDesktop : [1024,3],
      itemsDesktopSmall : false
  });


  var thegal = $('.popup-gallery').magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-img-mobile',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
      titleSrc: function(item) {
        return item.el.attr('title') + '<small>&copy; Marrakesh Cementlap</small>';
      }
    }
  });


  $('.startpopup').click(function(e) {
    e.preventDefault();
    thegal.magnificPopup('open');
  });



});
