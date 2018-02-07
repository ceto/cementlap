<?php
/*
Template Name: Product Style List
*/
?>

<?php
  $allstylegroups = get_terms(array(
    'taxonomy' => 'style-group',
    'hide_empty' => false,
  ));
?>
<section class="product-control">
  <nav class="nav-category">
    <ul class="menu menu--group">
      <?php  foreach( $allstylegroups as $sgelem ): ?>
        <li>
          <a href="<?= get_term_link( $sgelem ) ?>"><?= $sgelem->name ?><?php if ($sgelem->description): ?><small><?= $sgelem->description ?></small><?php endif; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
</section>

<?php $child_terms = get_terms( 'product-style', array(/*'child_of' => $parent_term->term_id */) ); ?>

<div class="loader loading"><i class="ion-load-a"></i></div>
<div class="productstyle-list loading">
<?php $i=0; ?>
  <?php foreach ( $child_terms as $child ) : ?>
    <div class="sqstyle">
      <a class="sqstyle__fulllink" href="<?php echo get_term_link( $child, 'product-style' ); ?>">

      <?php
        $childtermid_hu = icl_object_id($child->term_id,'category','true','hu');

        $ima = get_tax_meta( $childtermid_hu, 'ps_image_id');
        $imci = wp_get_attachment_image_src( $ima['id'], 'medium169');

        $saba = get_tax_meta( $childtermid_hu, 'ps_sablon_id');
        $sabci = wp_get_attachment_image_src( $saba['id'], 'tiny11');
      ?>

      <?php   if (get_tax_meta( $childtermid_hu, 'ps_image_id') ) : ?>
        <img src="<?php echo $imci[0]; ?>" width="<?php echo $imci[1]; ?>" height="<?php echo $imci[2]; ?>" alt="<?= $child->name;?>" class="sqstyle__img">
      <?php else : ?>
        <img class="sqstyle__img" src="http://placehold.it/640x360/cecece/333333/?text=<?= $child->name;?>" alt="<?= $child->name;?>">
      <?php endif; ?>

      <h2 class="sqstyle__name"><?= $child->name;?> <i class="ion ion-ios-arrow-thin-right"></i></h2>

      <?php   if (get_tax_meta( $childtermid_hu, 'ps_sablon_id') ) : ?>
        <img src="<?php echo $sabci[0]; ?>" width="<?php echo $sabci[1]; ?>" height="<?php echo $sabci[2]; ?>" alt="<?= $child->name.__('Sablon', 'cementlap');?>" class="sqstyle__sablon">
      <?php else : ?>
        <img class="sqstyle__sablon" src="http://placehold.it/320/cecece/333333/?text=Sablon" class="sqstyle__sablon">
      <?php endif; ?>
      </a>
    </div>
  <?php $i=($i<12)?$i+1:0; endforeach; ?>
</div>