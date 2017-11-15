<?php
  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  $aktermterm_id = $term->term_id;
  $aktermterm_id = icl_object_id($aktermterm_id,'style-group','true','hu');
  $stylegroups = get_term_children( $aktermterm_id, 'style-group' );

?>

<section class="product-control">
  <nav class="nav-category">
  <ul class="menu menu--group">
      <?php if ($term->parent!==0) :?>
      <li>
        <a class="" href="<?= get_term_link( $term->parent ) ?>"><i class="ion-ios-undo"></i><small><?php _e('Vissza','cementlap'); ?></small></a>
      </li>
    <?php endif; ?>

    <?php  foreach( $stylegroups as $stylegroupid ):
      $the_term = get_term_by( 'id', $stylegroupid, 'style-group' );
      if ($the_term->parent == $aktermterm_id) : ?>
        <li>
          <a href="<?= get_term_link( $the_term ) ?>"><?= $the_term->name ?><?php if ($the_term->description): ?><small><?= $the_term->description ?></small><?php endif; ?></a>
        </li>
      <?php endif ?>
    <?php endforeach; ?>
  </ul>
  </nav>


</section>

<?php
  $child_terms = get_terms( 'product-style', array(/*'child_of' => $parent_term->term_id */) );
  array_push($stylegroups, $aktermterm_id);
?>
<div class="loader loading"><i class="ion-load-a"></i></div>
<div class="productstyle-list loading">
  <?php foreach ( $child_terms as $child ) : ?>
    <?php
      if (styleisingroup($child, $stylegroups )): ?>
      <div class="sqstyle">
        <a class="sqstyle__fulllink" href="<?php echo get_term_link( $child, 'product-style' ); ?>">

        <?php
          $childtermid_hu = icl_object_id($child->term_id,'product-style','true','hu');

          $ima = get_tax_meta( $childtermid_hu, 'ps_image_id');
          $imci = wp_get_attachment_image_src( $ima['id'], 'medium169');

          $saba = get_tax_meta( $childtermid_hu, 'ps_sablon_id');
          $sabci = wp_get_attachment_image_src( $saba['id'], 'tiny11');
        ?>

        <?php   if (get_tax_meta( $childtermid_hu, 'ps_image_id') ) : ?>
          <img src="<?php echo $imci[0]; ?>" width="<?php echo $imci[1]; ?>" height="<?php echo $imci[2]; ?>" alt="<?= $child->name;?>" class="sqstyle__img">
        <?php endif; ?>

        <h2 class="sqstyle__name"><?= $child->name;?> <i class="ion ion-ios-arrow-thin-right"></i></h2>

        <?php   if (get_tax_meta( $childtermid_hu, 'ps_sablon_id') ) : ?>
          <img src="<?php echo $sabci[0]; ?>" width="<?php echo $sabci[1]; ?>" height="<?php echo $sabci[2]; ?>" alt="<?= $child->name.__('Sablon', 'cementlap');?>" class="sqstyle__sablon">
        <?php else : ?>
          <img class="sqstyle__sablon" src="http://placehold.it/320/cecece/333333/?text=Sablon" class="sqstyle__sablon">
        <?php endif; ?>
        </a>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>