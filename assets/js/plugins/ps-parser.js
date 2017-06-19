(function($) {
  var urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (!results) { return 0; }
    return decodeURIComponent(results[1].replace(/\+/g, " ")) || 0;
  }
  $.fn.psdomgallery = function(options) {
    //var galleries = [];
    galleries = [];
    var  _options = options;


    var init = function($this) {

      galleries = [];
      $this.each(function(i, gallery) {
        galleries.push({
          id: i,
          items: [],
          maincaption: galleryCaption(gallery)
        });

        // $(gallery).find('a.js-gallerystart').data('gallery-id', i + 1);
        // $(gallery).find('a.js-gallerystart').data('photo-id', 0);

        $(gallery).find('figure a').each(function(k, link) {
          var $link = $(link),
            size = $link.data('size').split('x');

          if (size.length != 2) {
            throw SyntaxError("Missing data-size attribute.");
          }

          $link.data('gallery-id', i + 1);
          $link.data('photo-id', k );

          var gurl = $(gallery).data('galleryurl')?$(gallery).data('galleryurl'):window.location.href.match(/^[^\#\?]+/)[0];

          var item = {
            src: link.href,
            msrc: link.children[0].getAttribute('src'),
            w: parseInt(size[0], 10),
            h: parseInt(size[1], 10),
            attachmentURL: gurl + '#/&gid=1&pid=' + (k+1),
            el: link,
            title: '<h3>'+link.getAttribute('title')+'</h3><ul class="card__related">'+ $(link).parents('.card').find('.card__related').html()+'</ul>'+$(link).parents('.card').find('.card__leiras').html()
          }

          galleries[i].items.push(item);

        });



        $(gallery).on('click', 'figure a', function(e) {
          e.preventDefault();
          var gid = $(this).data('gallery-id'),
            pid = $(this).data('photo-id');
          startGallery(gid, pid);
        });


      });
    }


    var galleryCaption = function(gallery) {
        var $gtitle = $(gallery).data('gallerytitle'),
            $gdate = $(gallery).data('gallerydate'),
            $gphotographer = $(gallery).data('galleryphotographer');


        var niceHead = '<header class="niceHeader"><h1 class="niceHeader-mainText"><span>' + $gtitle + '</span></h1><time class="niceHeader-subText">' + $gdate + '</time><div class="niceHeader-disclaimer">Fotó: ' + $gphotographer + '</div></header>';

        return niceHead;
    };

    var parseHash = function() {
      var hash = window.location.hash.substring(1),
        params = {};

      if (hash.length < 5) {
        return params;
      }

      var vars = hash.split('&');
      for (var i = 0; i < vars.length; i++) {
        if (!vars[i]) {
          continue;
        }
        var pair = vars[i].split('=');
        if (pair.length < 2) {
          continue;
        }
        params[pair[0]] = pair[1];
      }

      if (params.gid) {
        params.gid = parseInt(params.gid, 10);
      }

      if (!params.hasOwnProperty('pid')) {
        return params;
      }
      params.pid = parseInt(params.pid, 10);
      return params;
    };

    var openGallery = function(gid, pid) {
      var pswpElement = document.querySelectorAll('.pswp')[0],
        items = galleries[gid - 1].items,
        fixcaption = galleries[gid - 1].maincaption
        options = {
          barsSize: {top:44, bottom:'66'},
          bgOpacity: 1,
          shareButtons: [
              {id:'urltest', label:'Sima link teszt', url: '{{url}}'},
              {id:'facebook', label:'Megosztás Facebookon', url:'https://www.facebook.com/dialog/share?app_id=646072898740588&amp;href={{url}}&amp;picture={{image_url}}'},
              {id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'},
              {id:'download', label:'Kép letöltése', url:'{{raw_image_url}}', download:true}
          ],
          getPageURLForShare: function( /* shareButtonData */ ) {
            return items[urlParam('pid') - 1].attachmentURL;
          },
          // Function builds caption markup
          // addCaptionHTMLFn: function(item, captionEl, isFake) {
          //     captionEl.children[0].innerHTML = fixcaption;
          //     return true;
          // },
          index: pid,
          galleryUID: gid,
          getThumbBoundsFn: function(index) {
            var thumbnail = items[index].el.children[0],
              pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
              rect = thumbnail.getBoundingClientRect();

            return {
              x: rect.left,
              y: rect.top + pageYScroll,
              w: rect.width
            };
          }
        };
      $.extend(options, _options);

      var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
      gallery.init();
      // gallery.listen('destroy', function() {
      //   $('.pswp').remove();
      // });

    }

    //load ui + open gallery. root html lang attr must be set
    var startGallery = function(gid, pid) {
      $('.banner').removeClass('ison');
      openGallery(gid,pid);
      return true;
    }


    // initialize
    init(this);


    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = parseHash();
    if (hashData.pid > 0 && hashData.gid > 0) {
      if ($('.js-gallery').length) {
        startGallery(hashData.gid, hashData.pid);
      }
    }

    return this;
  };
}(jQuery));