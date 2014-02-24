<?php
/*
Template Name: Home Template
*/
?>
<section class="fresh-posts">
  <?php 
    $the_posts = new WP_Query(array(
      'post_type' => 'post',
      'posts_per_page' => 3
    ));
  ?>
  <?php while ($the_posts->have_posts()) : $the_posts->the_post(); ?>
  <article id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>>
    <figure class="post-thumb">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('small34');  ?>
      </a>
    </figure>
    <div class="post-desc">
      <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <a href="<?php the_permalink(); ?>" class="btn btn-light-line"><?php _e('Tovább','root'); ?></a>
    </div>
  </article>
  <?php endwhile; ?>


</section>
