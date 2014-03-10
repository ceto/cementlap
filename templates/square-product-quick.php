<?php global $nagydurva; ?>
<?php
    $termik = array();
    $nagytermlist=array_merge(
      get_the_terms( $post->ID, 'product-category' ),
      get_the_terms( $post->ID, 'product-color' ),
      get_the_terms( $post->ID, 'product-design' ),
      get_the_terms( $post->ID, 'product-stock' )
    );
    foreach ( $nagytermlist as $term ) { $termik[] = $term->slug; }
  

  ?>
  <?php 
  $nagydurva.='';
?> 
