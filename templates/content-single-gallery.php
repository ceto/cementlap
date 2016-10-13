<?php while (have_posts()) : the_post(); ?>
<?php $o_id=icl_object_id($post->ID, 'post', true, 'hu'); ?>
<?php
  $copt=get_option('cementlap_option_name');

  $ima = get_post_meta( $post->ID, '_meta_wallimg_id', true );

  $imci = wp_get_attachment_image_src( $ima, 'wallimg');
  $imcismall = wp_get_attachment_image_src( $ima, 'wallsmall');
  $imcimedium = wp_get_attachment_image_src( $ima, 'wallmedium');
  $imcigreat = wp_get_attachment_image_src( $ima, 'wallgreat');

?>

  <article <?php post_class(); ?>>

    <div class="repulo">
      <a href="javascript:history.back();" class="repulotoggle"><i class="ion ion-ios-close-empty"></i></a>
      <header>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-meta">
          <div class="entry-cat">
           <?php  _e('Vissza ide:','cementlap'); ?>
           <?php the_category( ', ', 'multiple' ); ?>
          </div>
        </div>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <footer>
        <nav class="post-pn">
          <ul>
            <li><?php previous_post_link( '%link', '<i class="ion-ios-arrow-back"></i><br>%title', TRUE, ' ', 'post_format' ); ?> </li>
            <li><?php next_post_link( '%link', '<i class="ion-ios-arrow-forward"></i><br>%title', TRUE, ' ', 'post_format' ); ?></li>
          </ul>
        </nav>

        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>


      </footer>
      <?php // comments_template('/templates/comments.php'); ?>
    </div>
    <aside class="addcont">
      <?php echo do_shortcode(get_post_meta( $o_id, '_meta_addcont', true )); ?>
    </aside>
  </article>
<?php endwhile; ?>
