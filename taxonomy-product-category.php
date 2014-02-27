<?php
/*
Template Name: Product Category List
*/
?>

<?php
  //global $query_string;
  //query_posts( $query_string . '&orderby=date&order=ASC&posts_per_page=-1' );
  //$term_id = term_exists( get_query_var( 'term' ) );
  //$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  //$ima = get_tax_meta( $term_id ,'_meta_image');
  //$imci = wp_get_attachment_image_src( $ima[id], 'banner169');
  //$actual_term = get_term( $term_id, 'object' );
  //$parent_term = get_term( $actual_term->parent, 'object' );
  //$term_children = get_term_children( $parent_term->term_id, 'object' );
  $copt=get_option('cementlap_option_name');
?>


<section class="product-control">
  <h1>Cementlapok</h1>
  
  <nav class="nav-category">
    <ul>
      <li><a href="#" class="active">Mind</a></li>
      <li><a href="<?php get_term_link( 'normal', 'product-group' ); ?>">Normál</a></li>
      <li><a href="#">Kicsi</a></li>
      <li><a href="<?php get_term_link( 'hexa', 'product-group' ); ?>">Hatszög</a></li>
    </ul>
  </nav>

  <div id="filt-wrap">

    <div class="filt-select-con">
      <div class="filt-placeholder" data-filter-name=".filt-color">
        <span class="filt-placeholder-text">Színek</span>
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
        <span class="filt-placeholder-text">Design</span>
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
      <div class="filt-placeholder" data-filter-name=".filt-stock">
        <span class="filt-placeholder-text">Készlet</span>
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


  </div><!-- /#filt-wrap -->
  

  
</section>

<?php 
  $the_product = new WP_Query( array(
    'post_type' => 'product',
    'posts_per_page' => -1
  ));
?>
<div class="product-list">
  <?php while ($the_product->have_posts()) : $the_product->the_post(); ?>
  <?php
    $termik = array();
    $termlist=get_the_terms( $post->ID, 'product-category' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termlist=get_the_terms( $post->ID, 'product-color' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termlist=get_the_terms( $post->ID, 'product-design' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termlist=get_the_terms( $post->ID, 'product-stock' );
    foreach ( $termlist as $term ) { $termik[] = $term->slug; }
    $termes = join(" ", $termik );
  ?>
  <a id="product-<?php echo $post->ID; ?>" <?php post_class($termes.' prod-mini'); ?>
    href="<?php the_permalink(); ?>"
    data-url="<?php the_permalink(); ?>"
    data-name="<?php the_title(); ?>"
  >
    <figure class="prod-thumb">
      <?php the_post_thumbnail('small11');  ?>
      <?php
        $ima = get_post_meta( $post->ID, '_meta_singleimg_id', true );
        $imci = wp_get_attachment_image_src( $ima, 'petit11');
      ?>
    <img src="<?php echo $imci[0]; ?>" width="<?php echo $imci[1]; ?>" height="<?php echo $imci[2]; ?>" alt="" class="prod-sthumb">
    </figure>
    <div class="prod-desc">
      <h3 class="prod-title"><?php the_title(); ?></h3>
      <div class="prod-stock-status">
        <?php if (has_term('raktarrol-azonnal','product-stock')) : ?>
          <i class="ion-ios7-cart"></i>
          <?php _e('Raktáron van:','root') ?>
          <span class="prod-amount">
            <?php echo get_post_meta($post->ID, '_meta_amount', true); ?><?php echo get_post_meta($post->ID, '_meta_unit', true); ?>
          </span>
        <?php elseif ( has_term('hamarosan-erkezik','product-stock'))  : ?>
          <i class="ion-clock"></i>
          <?php _e('Érkezik:','root') ?>
          <span class="prod-ntd"><?php echo get_post_meta($post->ID, '_meta_arrive', true); ?></span>
          <?php else : ?>
          <i class="ion-android-hand"></i>
          <?php _e('Csak rendelésre','root') ?>
        <?php endif; ?>
      </div>

      <span class="prod-price">
        <?php echo number_format(get_post_meta($post->ID, '_meta_price', true), 0, ',', ' '); ?>
        <span class="prod-unit">Ft/<?php echo get_post_meta($post->ID, '_meta_unit', true); ?></span>
      </span>
    </div>
  </a>
  <!-- /#reference-## --><?php endwhile; ?>
</div>