<?php
/*
Template Name: Product Style List
*/
?>

<?php
  $child_terms = get_terms( 'product-style', array(/*'child_of' => $parent_term->term_id */) );
  $copt=get_option('cementlap_option_name');
?>

<div class="loader loading"><i class="ion-load-a"></i></div>
<div class="productstyle-list loading">
<?php $i=0; ?>
  <?php foreach ( $child_terms as $child ) : ?>
    <div class="sqstyle">
      <a class="sqstyle__fulllink" href="<?php echo get_term_link( $child, 'product-style' ); ?>">

      <?php
        $ima = get_tax_meta( $child->term_id, 'ps_image_id');
        $imci = wp_get_attachment_image_src( $ima['id'], 'medium169');

        $saba = get_tax_meta( $child->term_id, 'ps_sablon_id');
        $sabci = wp_get_attachment_image_src( $saba['id'], 'tiny11');
      ?>

      <?php   if (get_tax_meta( $child->term_id, 'ps_image_id') ) : ?>
        <img src="<?php echo $imci[0]; ?>" width="<?php echo $imci[1]; ?>" height="<?php echo $imci[2]; ?>" alt="<?= $child->name;?>" class="sqstyle__img">
      <?php else : ?>
        <img class="sqstyle__img" src="http://lorempixel.com/<?= 640 + $i*16; ?>/<?= 360 + $i * 9; ?>" alt="<?= $child->name;?>">
      <?php endif; ?>

      <h2 class="sqstyle__name"><?= $child->name;?> <i class="ion ion-ios-arrow-thin-right"></i></h2>

      <?php   if (get_tax_meta( $child->term_id, 'ps_sablon_id') ) : ?>
        <img src="<?php echo $sabci[0]; ?>" width="<?php echo $sabci[1]; ?>" height="<?php echo $sabci[2]; ?>" alt="<?= $child->name.__('Sablon', 'cementlap');?>" class="sqstyle__sablon">
      <?php else : ?>
        <img class="sqstyle__sablon" src="http://placehold.it/320/cecece/333333/?text=Sablon" class="sqstyle__sablon">
      <?php endif; ?>





      </a>
    </div>
  <?php $i=($i<12)?$i+1:0; endforeach; ?>
</div>