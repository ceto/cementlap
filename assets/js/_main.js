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


var showMenu = function() {
  $('body').toggleClass("active-subnav");
  $('.submenu-button, .submenu-button2').toggleClass("active-button");
};
var showMainMenu = function() {
  $('.banner').toggleClass('active');
  $('.navbar-toggle').toggleClass('active');
};


// add/remove classes everytime the window resize event fires
jQuery(window).resize(function(){
  var off_canvas_subnav_display = $('.off-canvas-subnavigation').css('display');
  var submenu_button_display = $('.submenu-button').css('display');
  if (off_canvas_subnav_display === 'block') {
    $("body").removeClass("three-column").addClass("small-screen");
  }
  if (off_canvas_subnav_display === 'none') {
    $("body").removeClass("active-subnav small-screen").addClass("three-column");
  }

  //Main navigation toggle
  var header_height = $('.banner').css('height');
  if (header_height === '320px') {
    $('.banner').removeClass('active');
    $('.navbar-toggle').removeClass('active');
  }

});

jQuery(document).ready(function($) {
  // Toggle for nav menu
  $('.submenu-button, .submenu-button2').click(function(e) {
    e.preventDefault();
    showMenu();
  });
  $('.navbar-toggle').click(function(e) {
    e.preventDefault();
    showMainMenu();
  });
});



// var showSidebar = function() {
//   $('body').removeClass("active-nav").toggleClass("active-sidebar");
//   $('.menu-button').removeClass("active-button");
//   $('.sidebar-button').toggleClass("active-button");
// };
// var showMenu = function() {
//   $('body').removeClass("active-sidebar").toggleClass("active-nav");
//   $('.sidebar-button').removeClass("active-button");
//   $('.menu-button').toggleClass("active-button");
// };

// // add/remove classes everytime the window resize event fires
// jQuery(window).resize(function(){
//   var off_canvas_nav_display = $('.off-canvas-navigation').css('display');
//   var menu_button_display = $('.menu-button').css('display');
//   if (off_canvas_nav_display === 'block') {
//     $("body").removeClass("three-column").addClass("small-screen");
//   }
//   if (off_canvas_nav_display === 'none') {
//     $("body").removeClass("active-sidebar active-nav small-screen").addClass("three-column");
//   }
// });

// jQuery(document).ready(function($) {
//   // Toggle for nav menu
//   $('.menu-button').click(function(e) {
//     e.preventDefault();
//     showMenu();
//   });
//   // Toggle for sidebar
//   $('.sidebar-button').click(function(e) {
//     e.preventDefault();
//     showSidebar();
//   });
// });


var resizeHero = function() {
  $('.hero').height($(window).height()-($('.banner').offset().top + $('.banner').height()));
  $('.contact-row.open').height($(window).height()-($('.banner').offset().top + $('.banner').height()));
  //$('.contact-row.open').css('min-height',($(window).height()-($('.banner').offset().top + $('.banner').height())));
};

$(window).resize(function(){
  resizeHero();
});

jQuery(document).ready(function($) {
  resizeHero();
  $('.copener').click(function(e){
    e.preventDefault();
    $('.contact-row').toggleClass('open');
    if ( $('.contact-row').innerHeight()>0 ) {
      $('.contact-row').height(0);
      //$('.contact-row').css('min-height',0);

    } else {
      $('.contact-row').height($(window).height()-($('.banner').offset().top + $('.banner').height()));
      //$('.contact-row.open').css('min-height',($(window).height()-($('.banner').offset().top + $('.banner').height())));

    }
  });
});


