<?php
  $aktermterm_id = term_exists( get_query_var( 'term' ) );
  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  $parent_term = ($term->parent==0)?$term:get_term($term->parent, get_query_var('taxonomy') );

  //$child_terms = get_term_children( $parent_term->term_id, 'product-category' );

  $child_terms = get_terms( 'product-category', array( 'child_of' => $parent_term->term_id ) );
  $copt=get_option('cementlap_option_name');

  //print_r( get_terms( 'product-category', array( 'child_of' => $parent_term->term_id ) ) );
?>


<header class="stheader">
  <figure class="stheader__fig">
    <?php
        $saba = get_tax_meta( $aktermterm_id, 'ps_sablon_id');
        $sabci = wp_get_attachment_image_src( $saba['id'], 'wallsmall');
        $borda = get_tax_meta( $aktermterm_id, 'ps_border_id');
        $borci = wp_get_attachment_image_src( $borda['id'], 'small11');
    ?>
    <?php   if (get_tax_meta( $aktermterm_id, 'ps_sablon_id') ) : ?>
      <img src="<?php echo $sabci[0]; ?>" width="<?php echo $sabci[1]; ?>" height="<?php echo $sabci[2]; ?>" alt="<?= $term->name.__('Sablon', 'cementlap');?>">
    <?php else : ?>
      <img src="http://placehold.it/640/cecece/333333/?text=Minta+helye">
    <?php endif; ?>

    <?php   if (get_tax_meta( $aktermterm_id, 'ps_border_id') ) : ?>
      <img src="<?php echo $borci[0]; ?>" width="<?php echo $borci[1]; ?>" height="<?php echo $borci[2]; ?>" alt="<?= $term->name.__('Bordűr', 'cementlap');?>" class="stheader__bordur">
    <?php else : ?>
      <img src="http://placehold.it/220/cecece/333333/?text=Bordűr+helye" class="stheader__bordur">
    <?php endif; ?>


  </figure>
  <h1 class="stheader__title"><?= $term->name; ?></h1>
  <p class="stheader__descr"><?= $term->description; ?> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt.</p>
  <?php
    $contentwithgallery= get_post_meta( get_post_meta(6971, '_meta_refgal', true), '_meta_addcont', true );
    $imagelist=array();
    $imagelist=get_gallery_attachments($contentwithgallery);
  ?>
  <div class="product__gallery st__gallery">
    <div id="owl-refgal" class="popup-gallery">
      <?php
        foreach ( $imagelist as $image_id ) {
          $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
          $thumbimg = wp_get_attachment_image_src( $image_id, 'tiny11', false );
          $fullimage = wp_get_attachment_image_src( $image_id, 'wallfree', false );
          $imagedata = wp_get_attachment_image( $image_id, 'wallfree', false )
        ?>
          <a class="item" href="<?= $fullimage[0]; ?>" title="<?= get_the_title(get_post_meta($orig_id, '_meta_refgal', true)); ?>">
            <img src="<?=$thumbimg[0]; ?>" alt="<?= get_the_title(get_post_meta($orig_id, '_meta_refgal', true)); ?>">
          </a>
        <?php } ?>
      </div>
    </div>
    <a class="stheader__back" href="javascript:history.back();"><i class="ion-ios-undo"></i> Vissza a mintákhoz</a>
</header>
<section class="stcont">
  <div class="loader loading"><i class="ion-load-a"></i></div>
  <div class="product-list stlist loading">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/square','product' ); ?>
    <?php endwhile; ?>
  </div>
</section>