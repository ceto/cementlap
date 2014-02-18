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
    <div class="uszo">
      <header>
        <a class="product-back" href="javascript:history.back()"><i class="ion-ios7-undo"></i> Cementlapok</a>
        <h1 class="product-title"><?php the_title(); ?></h1>
        <div class="product-price">
          <?php echo get_post_meta($post->ID, '_meta_price', true); ?>
          <span class="unit">Ft/<?php echo get_post_meta($post->ID, '_meta_unit', true); ?></span>
        </div>
        <div class="product-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, voluptate, quod, ullam facilis id earum veritatis quis nesciunt culpa unde maxime quo quibusdam blanditiis dolores sit iure eveniet commodi tempora.
          </p>
        </div>
      </header>
      <footer class="product-footer">
        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      </footer>
    </div>
  </article>
<?php endwhile; ?>
