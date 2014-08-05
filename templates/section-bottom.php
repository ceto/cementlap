<?php if ( is_singular('product') ) : ?>
  <?php $reference_ID = $post->ID; ?>
  <aside class="related-products">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#egyes" data-toggle="tab"><?php _e('Színvariációk','root') ?></a></li>
      <li><a href="#kettes" data-toggle="tab"><?php _e('Hasonló lapok','root') ?></a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active fade in" id="egyes">
        <?php 
         
        yarpp_related(
          array(
            // Pool options: these determine the "pool" of entities which are considered
            'post_type' => array('product' ),
            'show_pass_post' => false, // show password-protected posts
            'past_only' => false, // show only posts which were published before the reference post
            'exclude' => array(), // a list of term_taxonomy_ids. entities with any of these terms will be excluded from consideration.
            'recent' => false, // to limit to entries published recently, set to something like '15 day', '20 week', or '12 month'.
            // Relatedness options: these determine how "relatedness" is computed
            // Weights are used to construct the "match score" between candidates and the reference post
            // 'weight' => array(
            //     'body' => 1,
            //     'title' => 2, // larger weights mean this criteria will be weighted more heavily
            //     'tax' => array(
            //         'post_tag' => 1,
            //         ... // put any taxonomies you want to consider here with their weights
            //     )
            // ),
            // Specify taxonomies and a number here to require that a certain number be shared:
            'require_tax' => array(
                'product-style' => 1 // for example, this requires all results to have at least one 'post_tag' in common.
            ),  
            // The threshold which must be met by the "match score"
            'threshold' => 2,

            // Display options:
            'template' => 'yarpp-related-tiles.php', // either the name of a file in your active theme or the boolean false to use the builtin template
            'limit' => 8, // maximum number of results
            'order' => 'score DESC'
          ),
          $reference_ID, // second argument: (optional) the post ID. If not included, it will use the current post.
          true
        ); // third argument: (optional) true to echo the HTML block; false to return it
        ?>
      </div><!-- /.tab-pane -->
      <div class="tab-pane fade" id="kettes">
        <?php 
        yarpp_related(
          array(
            // Pool options: these determine the "pool" of entities which are considered
            'post_type' => array('product' ),
            'show_pass_post' => false, // show password-protected posts
            'past_only' => false, // show only posts which were published before the reference post
            'exclude' => array(), // a list of term_taxonomy_ids. entities with any of these terms will be excluded from consideration.
            'recent' => false, // to limit to entries published recently, set to something like '15 day', '20 week', or '12 month'.
            // Relatedness options: these determine how "relatedness" is computed
            // Weights are used to construct the "match score" between candidates and the reference post
            // 'weight' => array(
            //     'body' => 1,
            //     'title' => 2, // larger weights mean this criteria will be weighted more heavily
            //     'tax' => array(
            //         'post_tag' => 1,
            //         ... // put any taxonomies you want to consider here with their weights
            //     )
            // ),
            // Specify taxonomies and a number here to require that a certain number be shared:
            'require_tax' => array(
                'product-color' => 1,
                'product-design' => 1, // for example, this requires all results to have at least one 'post_tag' in common.
            ),  
            // The threshold which must be met by the "match score"
            'threshold' => 2,

            // Display options:
            'template' => 'yarpp-related-tiles.php', // either the name of a file in your active theme or the boolean false to use the builtin template
            'limit' => 8, // maximum number of results
            'order' => 'score DESC'
          ),
          $reference_ID, // second argument: (optional) the post ID. If not included, it will use the current post.
          true
        ); // third argument: (optional) true to echo the HTML block; false to return it
        ?>
      </div><!-- /.tab-pane -->
      

      </div>
  </aside>
<?php endif; ?>




<?php if (is_page(941) || is_page(3186)): ?>

    <script type="text/javascript">

      var map;
        function initialize() {
          var latlng = new google.maps.LatLng(47.44266,18.93981);
        var centerlatlng = new google.maps.LatLng(47.44266,18.93981);
        var myOptions = {
          zoom: 12,
          center: centerlatlng,
          disableDefaultUI: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles:[
          {
          stylers: [
            { "saturation": -92 },
                { "gamma": 0.34 },
                { "lightness": 25 }
          ]
          }
        ]
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'),  myOptions);
        
        var image = new google.maps.MarkerImage('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/map_zaszlo.png',
        new google.maps.Size(69, 73), new google.maps.Point(0,0), new google.maps.Point(1, 73));
        var shadow = new google.maps.MarkerImage('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/map_zaszlo_shadow.png',
        new google.maps.Size(95, 49), new google.maps.Point(0,0), new google.maps.Point(1, 49));
        
        var marker = new google.maps.Marker({
          position: latlng, 
          map: map, 
          title:"Marrakesh Cementlap",
          icon:image,
          shadow:shadow 
        });
         }

         google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style>
    .gmap {
      min-height: 320px;
      width:100%;
    } 
    </style>
  <section id="map_canvas" class="gmap"></section> 
<?php endif; ?>