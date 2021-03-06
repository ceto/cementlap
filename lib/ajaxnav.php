<?php
    function cement_loadmore_ajax_handler(){


    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    if ( isset( $_POST[ 'wpml_lang' ] ) ) {
        do_action( 'wpml_switch_language',  $_POST[ 'wpml_lang' ] ); // switch the content language
    }

    // it is always better to use WP_Query but not here
    query_posts( $args );

    if( have_posts() ) :

        // run the loop
        while( have_posts() ): the_post();

            // look into your theme code how the posts are inserted, but you can use your own HTML of course
            // do you remember? - my example is adapted for Twenty Seventeen theme
            // get_template_part( 'template-parts/post/content', get_post_format() );
            // for the test purposes comment the line above and uncomment the below one
            get_template_part('templates/square','product' );
            //the_title();


        endwhile;

    endif;
    die; // here we exit the script and even no wp_reset_query() required!
}



add_action('wp_ajax_loadmore', 'cement_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'cement_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
