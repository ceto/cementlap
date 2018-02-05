<?php
  $aktermterm_id = term_exists( get_query_var( 'term' ) );
  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  $parent_term = ($term->parent==0)?$term:get_term($term->parent, get_query_var('taxonomy') );

  //$child_terms = get_term_children( $parent_term->term_id, 'product-category' );

  $child_terms = get_terms( 'product-category', array( 'child_of' => $parent_term->term_id ) );
  $copt=get_option('cementlap_option_name');

  //print_r( get_terms( 'product-category', array( 'child_of' => $parent_term->term_id ) ) );
      $df='Y. m. d.';
    if (ICL_LANGUAGE_CODE!='hu') {$dateformat='d/m/y';}
?>
<section class="product-control">
  <div id="filt-wrap" class="filt-wrap">
    <div class="filt-wrap__inner">
      <span class="filt-title"><?php _e('Találatok szűrése','cementlap'); ?></span>
      <div class="filt-selectors">
        <div class="filt-select-con filt-select-con--color">
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

        <div class="filt-select-con filt-select-con--style">
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

        <div class="filt-select-con filt-select-con--design">
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
      </div>
    </div>

  </div><!-- /#filt-wrap -->
</section>