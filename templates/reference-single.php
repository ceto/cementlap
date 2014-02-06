<?php while (have_posts()) : the_post(); ?>
<?php
  $actual=$post->ID;
  $group_terms = wp_get_object_terms($actual, 'reference-group', array (
     'orderby' => 'date',
     'order' => 'ASC',
     'fields' => 'all' 
    )
  );
  $group_id=$group_terms[0]->term_id;
  $group_name=$group_terms[0]->name;
  //$group = get_term( $term_id, 'reference-group' );
  $group=$group_terms[0];
?>
  <nav class="off-canvas-subnavigation">
    <a href="<?php echo get_permalink(16) ?>" class="bckbtn"><span class="ion-ios7-undo"></span></a>
    <a class="submenu-button" href="#menu">
      <span class="ion-more ici"></span>
      <span class="cat-name"><?php echo $group_name; ?></span>
    </a>    
  </nav>

<?php 
  $the_brothas = new WP_Query(array(
    'post_type' =>  'reference',
    'posts_per_page' => -1,
    'tax_query' =>  array(
       array(
        'taxonomy' => 'reference-group', 
        'field'    => 'id',
        'terms'    => $group_id,
      ),
    ),
  ));
?>
  <nav class="nav-sub">
    <h2 class="nav-title"><a href="#" class="submenu-button2"><span class="ion-android-more ici"></span> <?php echo $group_name; ?> </a></h2>
    <ul>
      <?php while ($the_brothas->have_posts()) : $the_brothas->the_post(); ?>
        <li class="<?php echo ($actual==get_the_id())?'active':''; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php endwhile; ?>
    </ul>
  </nav>
  <?php wp_reset_query(); ?>

  <article <?php post_class(); ?>>
    <figure class="reference-figure">
      <?php the_post_thumbnail(mediumfree); ?>
    </figure>
    <header>
      <h1 class="reference-title"><?php the_title(); ?></h1>
      <div class="reference-content">
        <?php the_content(); ?>
      </div>
    </header>
    <aside class="reference-addcont">
      <?php echo apply_filters('the_content',get_post_meta( $post->ID, '_meta_addcont', true )); ?>
    </aside>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
  </article>
<?php endwhile; ?>
