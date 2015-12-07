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
        <img class="sqstyle__img" src="http://lorempixel.com/<?= 640 + $i*16; ?>/<?= 360 + $i * 9; ?>" alt="<?= $child->name;?>">
        <h2 class="sqstyle__name"><?= $child->name;?> <i class="ion ion-ios-arrow-thin-right"></i></h2>
        <img class="sqstyle__sablon" src="http://placehold.it/320/cecece/333333/?text=Sablon" class="sqstyle__sablon">
      </a>
    </div>
  <?php $i=($i<12)?$i+1:0; endforeach; ?>
</div>