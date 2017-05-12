<?php
    $df='Y. m. d.';
    if (ICL_LANGUAGE_CODE!='hu') {$dateformat='d/m/y';}
    $kontid=$post->ID;
    $the_products = new WP_Query(array(
      'post_type' => 'product',
      'posts_per_page' => -1,
    ));
  ?>
  <section class="product-control">
  <h1><?= __('Coming soon','cementlap') .': ' .date($df, get_post_meta( $kontid, '_meta_cardate', true ) ) ?></h1>
  </section>
<div class="loader loading"><i class="ion-load-a"></i></div>
<div class="product-list loading">
  <?php while ($the_products->have_posts()) : $the_products->the_post(); ?>
    <?php
      $orig_id=icl_object_id($post->ID, 'product', true, 'hu');
      $csdates = get_post_meta( $orig_id, 'prod_coming_group', true );
      $kell=FALSE;
      foreach ( (array) $csdates as $key => $entry ) {
        if ( $entry['prc_kontno']== $kontid )  { $kell=TRUE; }
      }
    ?>
    <?php if ($kell) {
     get_template_part('templates/square','product' );
    } ?>
  <?php endwhile; ?>
</div>