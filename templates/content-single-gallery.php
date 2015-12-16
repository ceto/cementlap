<?php while (have_posts()) : the_post(); ?>
<?php
  $copt=get_option('cementlap_option_name');
  $ima = get_post_meta( $post->ID, '_meta_wallimg_id', true );

  $imci = wp_get_attachment_image_src( $ima, 'wallimg');
  $imcismall = wp_get_attachment_image_src( $ima, 'wallsmall');
  $imcimedium = wp_get_attachment_image_src( $ima, 'wallmedium');
  $imcigreat = wp_get_attachment_image_src( $ima, 'wallgreat');

?>
<!--style type="text/css">
  article.post {
    background-image:none;
  }
  @media only screen and (min-width: 768px) {
    article.post {
      background-image:url('<?php echo $imcimedium['0']; ?>');
    }
  }
  @media only screen and (min-width: 1280px) {
    article.post {
      background-image:url('<?php echo $imcigreat['0']; ?>');
    }
  }
  @media only screen and (min-width: 1600px) {
    article.post {
      background-image:url('<?php echo $imci['0']; ?>');
    }
  }
</style-->
  <article <?php post_class(); ?>>

    <div class="repulo">
      <a href="#" class="repulotoggle"><i class="ion ion-arrow-expand"></i></a>
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
      <?php echo do_shortcode(get_post_meta( $post->ID, '_meta_addcont', true )); ?>
    </aside>
  </article>
<?php endwhile; ?>
