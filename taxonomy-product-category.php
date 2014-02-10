<?php
/*
Template Name: Product Category List
*/
?>

<?php
  //global $query_string;
  //query_posts( $query_string . '&orderby=date&order=ASC&posts_per_page=-1' );
  //$term_id = term_exists( get_query_var( 'term' ) );
  //$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  //$ima = get_tax_meta( $term_id ,'_meta_image');
  //$imci = wp_get_attachment_image_src( $ima[id], 'banner169');
  //$actual_term = get_term( $term_id, 'object' );
  //$parent_term = get_term( $actual_term->parent, 'object' );
  //$term_children = get_term_children( $parent_term->term_id, 'object' );
?>

<?php 
  $the_product = new WP_Query( array(
    'post_type' => 'product',
    'posts_per_page' => -1
  ));
?>
<div class="product-list">
  <?php while ($the_product->have_posts()) : $the_product->the_post(); ?>
  <a id="reference-<?php echo $post->ID; ?>" <?php post_class('ref-mini'); ?>
    href="<?php the_permalink(); ?>"
    data-url="<?php the_permalink(); ?>"
    data-name="<?php the_title(); ?>"
  >
    <figure class="ref-thumb">
      <?php the_post_thumbnail('small11');  ?>
    </figure>
    <div class="ref-desc">
      <h3 class="ref-title"><?php the_title(); ?></h3>
    </div>
  </a>
  <!-- /#reference-## --><?php endwhile; ?>
</div>