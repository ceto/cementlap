<article id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>>
  <?php $o_id=icl_object_id($post->ID, 'post', true, 'hu'); ?>
  <figure class="post-thumb">
    <a href="<?php the_permalink(); ?>">
      <?= get_the_post_thumbnail($o_id, 'small34');  ?>
    </a>
  </figure>
  <div class="post-desc">
    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <a href="<?php the_permalink(); ?>" class="btn btn-light-line"><?php _e('Tovább','root'); ?></a>
  </div>
</article>