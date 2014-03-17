<?php
/*
Template Name: Product Category List
*/
?>

<?php
  //global $query_string;
  //query_posts( $query_string . '&orderby=date&order=ASC&posts_per_page=-1' );
  $aktermterm_id = term_exists( get_query_var( 'term' ) );
  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  //$ima = get_tax_meta( $term_id ,'_meta_image');
  //$imci = wp_get_attachment_image_src( $ima[id], 'banner169');
  //$actual_term = get_term( $term_id, 'object' );
  $parent_term = ($term->parent==0)?$term:get_term($term->parent, get_query_var('taxonomy') );
  $child_terms = get_term_children( $parent_term->term_id, 'product-category' );
  //$term_children = get_term_children( $parent_term->term_id, 'object' );
  $copt=get_option('cementlap_option_name');
?>


<section class="product-control">
  <h1><?php echo $parent_term->name; ?>ok</h1>
  <nav class="nav-category">
    <ul>
      <li class="<?php echo ($parent_term->term_id==$aktermterm_id)?'active':''; ?>">
        <a href="<?php echo get_term_link( $parent_term, 'product-category' ); ?>">
          Mind
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

  <div id="filt-wrap" class="filt-wrap">

    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-stock">
        <span class="filt-placeholder-text"><?php _e('Készlet','root') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="stock" class="filt-item filt-stock hide">
        <?php $filtlist=get_terms('product-stock' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
        <li id="filter-<?php echo $term->slug; ?>">
          <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
          <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-close-round"></i></label>
        </li>
        <?php } ?>
      </ul>
    </div>

    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-color">
        <span class="filt-placeholder-text"><?php _e('Színek','root') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="color" class="filt-item filt-color hide">
        <?php $filtlist=get_terms('product-color' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
        <li id="filter-<?php echo $term->slug; ?>">
          <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
          <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-close-round"></i></label>
        </li>
        <?php } ?>
      </ul>
    </div>
    
    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-design">
        <span class="filt-placeholder-text"><?php _e('Stílus','root') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="design" class="filt-item filt-design hide">
        <?php $filtlist=get_terms('product-design' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
        <li id="filter-<?php echo $term->slug; ?>">
          <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
          <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-close-round"></i></label>
        </li>
        <?php } ?>
      </ul>
    </div>

    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-minta">
        <span class="filt-placeholder-text"><?php _e('Design','root') ?></span>
        <i class="ion-chevron-down"></i>
      </div>
      <ul data-filter-group="minta" class="filt-item filt-minta hide">
        <?php $filtlist=get_terms('product-style' ); ?>
        <?php foreach ( $filtlist as $term ) {  ?>
        <li id="filter-<?php echo $term->slug; ?>">
          <input data-filter-value=".<?php echo $term->slug; ?>" class="filt-item-input" type="checkbox" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>">
          <label class="filt-item-label" for="<?php echo $term->slug; ?>"><?php echo $term->name; ?> <i class="ion-close-round"></i></label>
        </li>
        <?php } ?>
      </ul>
    </div>






  </div><!-- /#filt-wrap -->
  

  
</section>
<div class="product-list">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/square','product' ); ?>
  <?php endwhile; ?>
</div>