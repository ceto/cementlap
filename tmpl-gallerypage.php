<?php
/*
Template Name: Gallery Page With Photoswipe
*/
?>
<?php while (have_posts()) : the_post(); ?>
  <?php //the_content(); ?>

    <?php $i=0; while ( have_rows('galeria') ) : the_row(); $i++; ?>
      <div class="column">
        <div class="card card--simple">
            <figure class="card__illustration ">
              <?php
                $image = get_sub_field('foto');
                $targetimg = wp_get_attachment_image_src($image['id'], 'full' ); ?>
                <a href="<?= $targetimg[0]; ?>" title="<?php the_sub_field('cim'); ?>">
                  <?= wp_get_attachment_image($image['id'], 'medium' ); ?>
                </a>
            </figure>

          <h4 class="card__title">
            <?php the_sub_field('cim'); ?>
          </h4>
          <div class="card__text"><?php the_sub_field('description'); ?></div>

        </div>
      </div>
      <?php endwhile; ?>
<?php endwhile; ?>
