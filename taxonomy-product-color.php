<?php
/*
Template Name: Product Category List
*/
?>

<?php get_template_part('templates/product','control'); ?>

<div class="loader loading"><i class="ion-load-a"></i></div>
<div class="product-list loading">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/square','product' ); ?>
  <?php endwhile; ?>
</div>

<?php get_template_part('templates/productgrid','nav'); ?>
