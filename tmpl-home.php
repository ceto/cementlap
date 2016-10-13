<?php
/*
Template Name: Home Template
*/
?>
<section class="fresh-posts">
  <?php
    $the_posts = new WP_Query(array(
      'post_type' => 'post',
      'posts_per_page' => 4
    ));
    $icipici=0;
  ?>
  <?php while ($the_posts->have_posts() && $icipici++<4) : $the_posts->the_post(); ?>
    <?php get_template_part('templates/content' ); ?>
  <?php endwhile; ?>
</section>
