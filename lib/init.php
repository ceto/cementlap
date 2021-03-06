<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
  // Make theme available for translation
  load_theme_textdomain('roots', get_template_directory() . '/lang');
  load_theme_textdomain('root', get_template_directory() . '/lang');
  load_theme_textdomain('cementlap', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots'),
  ));

  register_nav_menus(array(
    'secondary_navigation' => __('Secondary Navigation', 'roots'),
  ));

  register_nav_menus(array(
    'tertiary_navigation' => __('Tertiary Navigation', 'roots'),
  ));

  register_nav_menus(array(
    'vasinfo_navigation' => __('Vásárlási információk', 'roots'),
  ));

  register_nav_menus(array(
    'lerakinfo_navigation' => __('Lerakási információk', 'roots'),
  ));

  register_nav_menus(array(
    'kapcsinfo_navigation' => __('Kapcsolati adatok', 'roots'),
  ));

  register_nav_menus(array(
    'prodsitemap_navigation' => __('Termék sitemap', 'roots'),
  ));

  register_nav_menus(array(
    'footer_navigation' => __('Footer navigation', 'roots'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  // add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)

  add_image_size('wallfree', 1920, 9999);
  add_image_size('wallgreat', 1600, 9999);
  add_image_size('wallmedium', 1280, 9999);
  add_image_size('wallsmall', 768, 9999);

  add_image_size('slide21', 1920, 860, true);
  add_image_size('slidethumb21', 160, 80, true);





  add_image_size('medium169', 768, 432, true);


  add_image_size('small34', 480, 740, true);
  add_image_size('slidefree', 9999, 1000, false);


  add_image_size('tiny11', 220, 220, true);

  add_image_size('petit11', 120, 120, true);




  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  add_theme_support('post-formats', array('aside', 'gallery'));


  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'roots_setup');

// Backwards compatibility for older than PHP 5.3.0
if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
