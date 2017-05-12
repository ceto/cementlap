<?php
/*
Template Name: Sale Product List (akció)
*/
?>

<?php
    $df=get_option( 'date_format' );
    $the_products = new WP_Query(array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
    ));
?>

<div class="loader loading"><i class="ion-load-a"></i></div>
<div class="product-list loading">
  <?php while ($the_products->have_posts()) : $the_products->the_post(); ?>
    <?php $orig_id=icl_object_id($post->ID, 'product', true, 'hu'); ?>
    <?php if ( (get_post_meta( $orig_id, '_meta_origprice', true ) > 0) )   {
     get_template_part('templates/square','product' );
    } ?>
  <?php endwhile; ?>
</div>
<?php wp_reset_query(); ?>
      <br><br>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <br><br>

