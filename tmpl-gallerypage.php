<?php
/*
Template Name: Gallery Page With Photoswipe
*/
$panci=0;
?>
<?php while (have_posts()) : the_post(); ?>
<div class="gallerygrid js-gallery">
    <div class="gallerygrid__sizer"></div>
    <?php while ( have_rows('galeria') ) : the_row(); ?>
        <div class="gallerygrid__item <?= get_sub_field('nagy')?'gallerygrid__item--large':'' ?>">
            <?php 
            //Temporary reference generator goes here

        //     if ( current_user_can( 'manage_options' ) ) : 
        //         $post_arr = array(
        //             'post_title'   => get_sub_field('cim',false,false),
        //             'post_content' => get_sub_field('leiras',false,false),
        //             'post_status'  => 'publish',
        //             'post_type' => 'reference',
        //             'menu_order' => $panci++,
        //             'meta_input'   => array(
        //                 '_thumbnail_id' => get_sub_field('foto',false,false),
        //                 'linkedproducts' => get_sub_field('termeklink',false,false),
        //                 'largethumb' =>  get_sub_field('nagy',false,false)
        //             ),
        //         );
        //         wp_insert_post( $post_arr );
        //    endif; 
           
           //End of Reference generator
           ?>


            <?php
                    $image = get_sub_field('foto');
                    $targetimg = wp_get_attachment_image_src($image['id'], 'full' );
                    $targetwidth =  $targetimg[1];
                    $targetheight =  $targetimg[2];
            ?>
            <div id="card-<?= $image['id'] ?>" class="card card--simple">

                <figure class="card__illustration"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" data-itemtitle="<?php the_sub_field('cim'); ?>" style="padding-bottom:<?= $targetheight/$targetwidth*100 ?>%;">
                    <a href="<?= $targetimg[0]; ?>" title="<?php the_sub_field('cim'); ?>" itemprop="contentUrl" data-size="<?= $targetwidth.'x'.$targetheight; ?>">
                        <?= wp_get_attachment_image($image['id'], 'medium_large', false, 'itemprop="thumbnail"' ); ?>
                    </a>
                </figure>
                <h4 class="card__title"><?php the_sub_field('cim'); ?></h4>

                <?php $relprods = get_sub_field('termeklink'); ?>
                <ul class="card__related">
                <?php foreach ($relprods as $key => $prod) : ?>
                    <li><a href="<?php the_permalink($prod->ID); ?>"><?= get_the_title($prod->ID) ?></a></li>
                <?php endforeach; ?>
                </ul>
                <div class="card__leiras"><?= get_sub_field('leiras') ?></div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Background of PhotoSwipe.
    It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>
    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">
        <!-- Container that holds slides.
        PhotoSwipe keeps only 3 of them in the DOM to save memory.
        Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <!--  Controls are self-explanatory. Order can be changed. -->
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<?php the_content(); ?>
<?php endwhile; ?>