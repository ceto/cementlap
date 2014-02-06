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


var resizeHero = function() {
  $('.hero').height($(window).height()-($('.banner').offset().top + $('.banner').height()));
};

$(window).resize(function(){
  resizeHero();
});

jQuery(document).ready(function($) {
  resizeHero();
});


