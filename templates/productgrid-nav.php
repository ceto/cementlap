

<nav class="post-nav">

    <?php
global $wp_query; // you can remove this line if everything works for you

// don't display the button if there are not enough posts
if (  $wp_query->max_num_pages > 1 )
    echo '<br><br><br><a href="#" class="btn loadmoreproduct">'.__('Load more','cementlap').'</a><br><br><br>'; // you can use <a> as well
?>

    <?php
      /* the_posts_pagination( array(
        'mid_size'  => 2,
        'prev_text' => __( '&larr; Prev', 'cementlap' ),
        'next_text' => __( 'Next &rarr;', 'cementlap' ),
      ) );
     */
     ?>
</nav>