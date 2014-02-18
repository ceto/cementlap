<?php
/**
 * Custom functions
 */

/********* Custom Post Types for Product Management ****************/


/**
 * Product Custom Post Type Definition
*/
function create_product() {
  $labels = array(
    'name' => 'Products',
    'singular_name' => 'Product',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Product',
    'edit_item' => 'Edit Product',
    'new_item' => 'New Product',
    'all_items' => 'All Products',
    'view_item' => 'View Product',
    'search_items' => 'Search Products',
    'not_found' =>  'No Products found',
    'not_found_in_trash' => 'No Products found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Products'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'thumbnail' )
  ); 

  register_post_type( 'product', $args );
}
add_action( 'init', 'create_product' ); 

/********* END OF Custom Post Types for Product Management ****************/


/********* Custom MetaBoxes for Product Management ****************/

/**
 * Product Metaboxes
*/
add_filter( 'cmb_meta_boxes', 'cmb_product' );
function cmb_product( array $meta_boxes ) {
  $prefix = '_meta_';

  $meta_boxes[] = array(
    'id'         => 'rmeta',
    'title'      => 'Additional product details',
    'pages'      => array( 'product'), // Post type
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true, // Show field names on the left
    'fields'     => array(
      array(
        'name'   => __( 'Price', 'root' ),
        'desc'   => __( 'Unit price. (only numbers allowed)', 'root' ),
        'id'     => $prefix . 'price',
        'type'   => 'text_money',
        'before' => 'Ft', // override '$' symbol if needed
        // 'repeatable' => true,
      ),
      array(
        'name' => __( 'On Stock', 'root' ),
        'desc' => __( 'Amount of unit on Törökbálint', 'root' ),
        'id'   => $prefix . 'amount',
        'type' => 'text_small',
        // 'repeatable' => true,
      ),
      array(
        'name'    => __( 'Unit', 'root' ),
        'desc'    => __( 'Please select a unit', 'root' ),
        'id'      => $prefix . 'unit',
        'type'    => 'radio_inline',
        'options' => array(
          array( 'name' => __( 'm<sup>2</sup>', 'root' ), 'value' => 'm2', ),
          array( 'name' => __( 'kg', 'root' ), 'value' => 'kg', ),
          array( 'name' => __( 'db', 'root' ), 'value' => 'db', ),
        ),
      ),
      array(
        'name' => __( 'Next transport date', 'root' ),
        'desc' => __( 'field description (optional)', 'root' ),
        'id'   => $prefix . 'arrive',
        'type' => 'text_date',
      ),
      array(
        'name' => __( 'Fullscreen wallpaper', 'root' ),
        'desc' => __( 'Upload an image or enter a URL. (min: 1920×1280px)', 'root' ),
        'id'   => $prefix . 'wallimg',
        'type' => 'file',
        'save_id' => true, // save ID using true
        'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
      ),
      array(
        'name' => __( 'Single Cement Tile', 'root' ),
        'desc' => __( 'Upload an image or enter a URL. (optional, min: 500×500px)', 'root' ),
        'id'   => $prefix . 'singleimg',
        'type' => 'file',
        'save_id' => true, // save ID using true
        'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
      ),

      // array(
      //   'name'    => __( 'Additional content', 'root' ),
      //   'desc'    => __( 'Add your own gallery or additional content', 'root' ),
      //   'id'      => $prefix . 'addcont',
      //   'type'    => 'wysiwyg',
      //   'options' => array( 'textarea_rows' => 15, 'wpautop' => true ),
      // ),
    ),
  );
  return $meta_boxes;
}

/********* End of Custom MetaBoxes for Product Management ****************/

/************* Custom Category for Product Management *********/

add_action( 'init', 'create_product_category', 0 );

function create_product_category() {
  $labels = array(
    'name'              => __('Product Category', 'root'),
    'singular_name'     => __('Product Category', 'root'),
    'menu_name'         => __('Product Category', 'root'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'product-category' ),
  );

  register_taxonomy( 'product-category', array( 'product' ), $args );
}


/************* Custom Style for Product Management *********/

add_action( 'init', 'create_style_category', 0 );

function create_style_category() {
  $labels = array(
    'name'              => __('Product Style', 'root'),
    'singular_name'     => __('Product Style', 'root'),
    'menu_name'         => __('Product Style', 'root'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'product-style' ),
  );

  register_taxonomy( 'product-style', array( 'product' ), $args );
}

/************* Custom Colors for Product Management *********/

add_action( 'init', 'create_color_tag', 0 );

function create_color_tag() {
  $labels = array(
    'name'              => __('Colors', 'root'),
    'singular_name'     => __('Colors', 'root'),
    'menu_name'         => __('Colors', 'root'),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'product-color' ),
  );

  register_taxonomy( 'product-color', array( 'product' ), $args );
}

/************* Custom Design for Product Management *********/

add_action( 'init', 'create_design_tag', 0 );

function create_design_tag() {
  $labels = array(
    'name'              => __('Design', 'root'),
    'singular_name'     => __('Design', 'root'),
    'menu_name'         => __('Design', 'root'),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'product-design' ),
  );

  register_taxonomy( 'product-design', array( 'product' ), $args );
}

/************* Custom Stock for Product Management *********/

add_action( 'init', 'create_stock_tag', 0 );

function create_stock_tag() {
  $labels = array(
    'name'              => __('Stock', 'root'),
    'singular_name'     => __('Stock', 'root'),
    'menu_name'         => __('Stock', 'root'),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'product-stock' ),
  );

  register_taxonomy( 'product-stock', array( 'product' ), $args );
}


add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

  if ( ! class_exists( 'cmb_Meta_Box' ) )
    require_once 'cmb/init.php';

}


add_filter('the_content', 'ceto_fix_shortcodes');
// Intelligently remove extra P and BR tags around shortcodes that WordPress likes to add
function ceto_fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}

