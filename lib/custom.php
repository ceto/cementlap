<?php
/**
 * Custom functions
 */

/********* Custom Post Types for Apartment Management ****************/


/**
 * Reference Custoom Post Type Definition
*/
function create_reference() {
  $labels = array(
    'name' => 'References',
    'singular_name' => 'Reference',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Reference',
    'edit_item' => 'Edit Reference',
    'new_item' => 'New Reference',
    'all_items' => 'All References',
    'view_item' => 'View Reference',
    'search_items' => 'Search References',
    'not_found' =>  'No References found',
    'not_found_in_trash' => 'No References found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'References'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'reference' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'thumbnail' )
  ); 

  register_post_type( 'reference', $args );
}
add_action( 'init', 'create_reference' ); 

/********* END OF Custom Post Types for Apartment Management ****************/


/********* Custom MetaBoxes for Reference Management ****************/

/**
 * Reference Metaboxes
*/
add_filter( 'cmb_meta_boxes', 'cmb_reference' );
function cmb_reference( array $meta_boxes ) {
  $prefix = '_meta_';

  $meta_boxes[] = array(
    'id'         => 'rmeta',
    'title'      => 'Additional details for this reference',
    'pages'      => array( 'reference'), // Post type
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true, // Show field names on the left
    'fields'     => array(
      array(
        'name' => 'Year',
        'id'   => $prefix . 'year',
        'type' => 'text_small',
      ),
      array(
        'name'    => __( 'Additional content', 'root' ),
        'desc'    => __( 'Add your own gallery or additional content', 'root' ),
        'id'      => $prefix . 'addcont',
        'type'    => 'wysiwyg',
        'options' => array( 'textarea_rows' => 15, 'wpautop' => true ),
      ),
    ),
  );
  return $meta_boxes;
}

/********* End of Custom MetaBoxes for Reference Management ****************/

/************* Custom Taxonomies for Reference Management *********/

add_action( 'init', 'create_reference_taxonomies', 0 );

function create_reference_taxonomies() {
  $labels = array(
    'name'              => 'Reference Groups',
    'singular_name'     => 'Reference Group',
    'menu_name'         => 'Reference Group',
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'reference-group' ),
  );

  register_taxonomy( 'reference-group', array( 'reference' ), $args );
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

