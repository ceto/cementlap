<nav class="post-nav">
    <?php
      the_posts_pagination( array(
        'mid_size'  => 2,
        'prev_text' => __( '&larr; Prev', 'cementlap' ),
        'next_text' => __( 'Next &rarr;', 'cementlap' ),
      ) );
     ?>
</nav>