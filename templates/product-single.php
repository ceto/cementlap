<?php while (have_posts()) : the_post(); ?>
<?php
  // $actual=$post->ID;
  // $group_terms = wp_get_object_terms($actual, 'product-category', array (
  //    'orderby' => 'date',
  //    'order' => 'ASC',
  //    'fields' => 'all' 
  //   )
  // );
  // $group_id=$group_terms[0]->term_id;
  // $group_name=$group_terms[0]->name;
  // $group=$group_terms[0];
?>
<?php
  $ima = get_post_meta( $post->ID, '_meta_wallimg', flase );
  $imci = wp_get_attachment_image_src( $ima[id], 'banner169');
?>
  <article <?php post_class(); ?> style="background-image:url('<?php echo get_post_meta($post->ID, '_meta_wallimg', true); ?>');">
    <header>
      <h1 class="product-title"><?php the_title(); ?></h1>
      <div class="product-content">
        <?php the_content(); ?>
      </div>
      <figure class="product-figure">
        <?php the_post_thumbnail('tiny11'); ?>
      </figure>
    </header>
    <aside class="product-addcont">
      <?php echo apply_filters('the_content',get_post_meta( $post->ID, '_meta_addcont', true )); ?>
    </aside>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
  </article>
<?php endwhile; ?>
