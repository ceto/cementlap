<?php
/*
Template Name: Product Category List
*/
?>

<?php
  $aktermterm_id = term_exists( get_query_var( 'term' ) );
  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  $parent_term = ($term->parent==0)?$term:get_term($term->parent, get_query_var('taxonomy') );

  //$child_terms = get_term_children( $parent_term->term_id, 'product-category' );

  $child_terms = get_terms( 'product-category', array( 'child_of' => $parent_term->term_id ) );
  $copt=get_option('cementlap_option_name');

  //print_r( get_terms( 'product-category', array( 'child_of' => $parent_term->term_id ) ) );
?>


<section class="product-control">
  <h1><?php echo $parent_term->name; ?></h1>
  <nav class="nav-category">
    <ul>
      <li class="<?php echo ($parent_term->term_id==$aktermterm_id)?'active':''; ?>">
        <a href="<?php echo get_term_link( $parent_term, 'product-category' ); ?>">
          <?php _e('All','cementlap') ?>
        </a>
      </li>
      <?php foreach ( $child_terms as $child ) { ?>
        <?php if (!in_array($child, array('9')  ) ): ?>
        <li class="<?php echo ($child==$aktermterm_id)?'active':''; ?>">
          <a href="<?php echo get_term_link( $child, 'product-category' ); ?>">
            <?php
              $teri = get_term($child, 'product-category' );
              echo $teri->name;
            ?>
          </a>
        </li>

        <?php endif ?>

      <?php } ?>
    </ul>
  </nav>

  <?php
    $df='Y. m. d.';
    if (ICL_LANGUAGE_CODE!='hu') {$dateformat='d/m/y';}
  ?>

  <div id="filt-wrap" class="filt-wrap">

    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-stock">
        <span class="filt-placeholder-text"><?php _e('Stock','cementlap') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="stock" class="filt-item filt-stock hide">

          <li id="filter-in-stock">
            <input data-filter-value=".in-stock" class="filt-item-input" type="checkbox" id="raktar_in-stock" value="raktar_in-stock">
            <label class="filt-item-label" for="raktar_in-stock"><?= __('In stock','cementlap') ?> <i class="ion-checkmark"></i></label>
          </li>


        <?php
          $the_konts = new WP_Query(array (
              'post_type' => 'kontener',
              'posts_per_page' => -1,
            )
          );
          while ($the_konts->have_posts()) : $the_konts->the_post(); $aktkont=get_the_ID();?>
            <li id="filter-<?= 'kont_'.$aktkont ?>">
              <input data-filter-value=".kont_<?=  $aktkont ?>" class="filt-item-input" type="checkbox" id="kont_<?=  $aktkont ?>" value="kont_<?=  $aktkont ?>">
              <label class="filt-item-label" for="kont_<?= $aktkont ?>">Érkezik: <?= date($df, get_post_meta( $aktkont, '_meta_cardate', true ) ) ?> <i class="ion-checkmark"></i></label>
            </li>
          <?php endwhile;?>

        <li id="filter-stockall">
          <input data-filter-value="*" class="filt-item-input" type="checkbox" id="stock-all" value="<?php _e('Show all','cementlap'); ?>">
          <label class="filt-item-label" for="stock-all"><?php _e('Show all','cementlap'); ?> <i class="ion-checkmark"></i></label>
        </li>


        <?php /*$filtlist=get_terms('product-stock' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
          <?php if ($term->slug!='hamarosan-erkezik' && $term->slug!='coming-soon') : ?>
            <li id="filter-<?php echo $term->slug; ?>">
              <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
              <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-checkmark"></i></label>
            </li>
          <?php endif; ?>

        <?php } */?>
      </ul>
    </div>


    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-color">
        <span class="filt-placeholder-text"><?php _e('Colors','cementlap') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="color" class="filt-item filt-color hide">
        <li id="filter-colorall">
          <input data-filter-value="*" class="filt-item-input" type="checkbox" id="color-all" value="<?php _e('Show all','cementlap'); ?>">
          <label class="filt-item-label" for="color-all"><?php _e('Show all','cementlap'); ?> <i class="ion-checkmark"></i></label>
        </li>
        <?php $filtlist=get_terms('product-color' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
        <li id="filter-<?php echo $term->slug; ?>">
          <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
          <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-checkmark"></i></label>
        </li>
        <?php } ?>
      </ul>
    </div>

    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-design">
        <span class="filt-placeholder-text"><?php _e('Style','cementlap') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="design" class="filt-item filt-design hide">
        <li id="filter-designall">
          <input data-filter-value="*" class="filt-item-input" type="checkbox" id="design-all" value="<?php _e('Show all','cementlap'); ?>">
          <label class="filt-item-label" for="design-all"><?php _e('Show all','cementlap'); ?> <i class="ion-checkmark"></i></label>
        </li>
        <?php $filtlist=get_terms('product-design' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
        <li id="filter-<?php echo $term->slug; ?>">
          <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
          <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-checkmark"></i></label>
        </li>
        <?php } ?>
      </ul>
    </div>

    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-minta">
        <span class="filt-placeholder-text"><?php _e('Design','cementlap') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="minta" class="filt-item filt-minta hide">
        <li id="filter-stylerall">
          <input data-filter-value="*" class="filt-item-input" type="checkbox" id="style-all" value="<?php _e('Show all','cementlap'); ?>">
          <label class="filt-item-label" for="style-all"><?php _e('Show all','cementlap'); ?> <i class="ion-checkmark"></i></label>
        </li>
        <?php $filtlist=get_terms('product-style' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
        <li id="filter-<?php echo $term->slug; ?>">
          <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
          <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-checkmark"></i></label>
        </li>
        <?php } ?>
      </ul>
    </div>






  </div><!-- /#filt-wrap -->



</section>
<div class="loader loading"><i class="ion-load-a"></i></div>
<div class="product-list loading">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/square','product' ); ?>
  <?php endwhile; ?>
</div>