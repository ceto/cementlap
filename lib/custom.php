<?php
/**
 * Custom functions
 */

define('ICL_DONT_LOAD_NAVIGATION_CSS', TRUE);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', TRUE);
define('ICL_DONT_LOAD_LANGUAGES_JS', TRUE);

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );



// 1. customize ACF path
add_filter('acf/settings/path', 'cement_acf_settings_path');
function cement_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/lib/acf/';
    return $path;
}
// 2. customize ACF dir
add_filter('acf/settings/dir', 'cement_acf_settings_dir');
function cement_acf_settings_dir( $dir ) {
  $dir = get_stylesheet_directory_uri() . '/lib/acf/';
  return $dir;
}
// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/lib/acf/acf.php' );

include_once( get_stylesheet_directory() . '/lib/cement-acf.php' );





// function icl_load_jquery_dialog() {
//         wp_enqueue_script( 'jquery-ui-dialog', false, array('jquery'), false, true );
// }

// add_action( 'admin_enqueue_scripts', 'icl_load_jquery_dialog' );


/**
 * Product Group Custom Post Type Definition
*/
function create_group() {
  $labels = array(
    'name' => 'Group',
    'singular_name' => 'Group',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Group',
    'edit_item' => 'Edit Group',
    'new_item' => 'New Group',
    'all_items' => 'Groups',
    'view_item' => 'View Group',
    'search_items' => 'Search Group',
    'not_found' =>  'No Group found',
    'not_found_in_trash' => 'No Group found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Group'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => 'edit.php?post_type=product',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'group' ),
    'capability_type' => 'page',
    'supports' => array('title', 'page-attributes', 'thumbnail'),
    'has_archive' => true,
    'hierarchical' => true,
    'menu_position' => null,
    'yarpp_support' => false
  );

  register_post_type( 'group', $args );
}
//add_action( 'init', 'create_group' );

/********* END OF Custom Post Types for Group Management ****************/


/**
 * Product Konténer Custom Post Type Definition
*/
function create_kontener() {
  $labels = array(
    'name' => 'Konténer',
    'singular_name' => 'Konténer',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Konténer',
    'edit_item' => 'Edit Konténer',
    'new_item' => 'New Konténer',
    'all_items' => 'Konténerek',
    'view_item' => 'View Konténer',
    'search_items' => 'Search Konténer',
    'not_found' =>  'No Konténer found',
    'not_found_in_trash' => 'No Konténer found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Konténer'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => 'edit.php?post_type=product',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'kontener' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'yarpp_support' => false,
    'supports' => array( 'title' )
  );

  register_post_type( 'kontener', $args );
}
add_action( 'init', 'create_kontener' );

/********* END OF Custom Post Types for Konténer Management ****************/

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
    'yarpp_support' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' )
  );

  register_post_type( 'product', $args );
}
add_action( 'init', 'create_product' );

/********* END OF Custom Post Types for Product Management ****************/



/************* Custom Category for Product Management *********/

add_action( 'init', 'create_style_group', 0 );

function create_style_group() {
  $labels = array(
    'name'              => __('Style Group', 'root'),
    'singular_name'     => __('Style Group', 'root'),
    'menu_name'         => __('Style Group', 'root'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'style-group' ),
  );

  register_taxonomy( 'style-group', array('product'), $args );
}



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



/********* Custom MetaBoxes for Product Management ****************/



/**
 * Home Slider Post Type Definition
*/
function create_slider() {
  $labels = array(
    'name' => 'Slides',
    'singular_name' => 'Slide',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Slide',
    'edit_item' => 'Edit Slide',
    'new_item' => 'New Slide',
    'all_items' => 'All Slides',
    'view_item' => 'View Slide',
    'search_items' => 'Search Slides',
    'not_found' =>  'No Slides found',
    'not_found_in_trash' => 'No Slides found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Slider'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'slides' ),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'yarpp_support' => true,
    'supports' => array( 'title', 'thumbnail' )
  );

  register_post_type( 'slide', $args );
}
add_action( 'init', 'create_slider' );

/********* END OF Slider Post Types ****************/



/***** Create list of galleries ******/
function cement_show_refgal( $field ) {
  $the_refs = new WP_Query(array (
      'post_type' => 'post',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'post_format',
          'field'    => 'slug',
          'terms'    => array( 'post-format-gallery' ),
        ),
      ),
    )
  );

  $reflist = array();
  $reflist[0] = 'Nincs csatolt galéria';
  while ($the_refs->have_posts()) : $the_refs->the_post();
    $reflist[get_the_ID()] = get_the_title();
  endwhile;

  return $reflist;
}

/***** Create list of konteners ******/
function cement_show_kontener() {
  $the_konts = new WP_Query(array (
      'post_type' => 'kontener',
      'posts_per_page' => -1,
    )
  );

  $kontlist = array();
  $kontlist[0] = 'Nincs csatolt konténer';
  while ($the_konts->have_posts()) : $the_konts->the_post();
    $kontlist[get_the_ID()] = get_the_title().' - '. date('Y.m.d.', get_post_meta( get_the_ID(), '_meta_cardate', true ));
  endwhile;

  return $kontlist;
}

/********* Custom MetaBoxes ****************/

if ( file_exists(  __DIR__ .'/CMB2/init.php' ) ) { require_once  __DIR__ .'/CMB2/init.php';};

add_action( 'cmb2_init', 'cementes_metaboxes' );

function cementes_metaboxes( ) {
  $prefix = '_meta_';

  /****** Product Boxes ******/
  $cmb_product = new_cmb2_box( array(
    'id'         => 'rmeta',
    'title'      => 'Additional product details',
    'object_types'  => array( 'product'), // Post type
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true, // Show field names on the left
    'fields'     => array(
      array(
        'name'   => __( 'Price', 'root' ),
        'desc'   => __( 'Unit price. (only numbers allowed)', 'root' ),
        'id'     => $prefix . 'price',
        'type'   => 'text_small',
        'before' => 'Ft', // override '$' symbol if needed
        // 'repeatable' => true,
      ),
      array(
        'name'   => __( 'Original Price', 'root' ),
        'desc'   => __( 'Original price. (if special)', 'root' ),
        'id'     => $prefix . 'origprice',
        'type'   => 'text_small',
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
          'm2' => __( 'm<sup>2</sup>', 'root' ),
          'kg' => __( 'kg', 'root' ),
          'db' => __( 'db', 'root' ),
        ),
      ),
      array(
        'name' => __( 'Size', 'root' ),
        'desc' => __( 'eg:  20 × 20 × 1,6 cm', 'root' ),
        'id'   => $prefix . 'size',
        'type' => 'text_medium',
      ),
      array(
        'name' => __( 'Weight', 'root' ),
        'desc' => __( 'eg:  34 kg/m<sup>2</sup> | 1,35 kg / lap', 'root' ),
        'id'   => $prefix . 'weight',
        'type' => 'text_medium',
      ),
      array(
        'name' => __( 'Kit', 'root' ),
        'desc' => __( 'eg:  dobozban (13 lap ≈ 0,52 m<sup>2</sup>)', 'root' ),
        'id'   => $prefix . 'kit',
        'type' => 'text_medium',
      ),
      array(
        'name'    => __( 'Background position', 'root' ),
        'desc'    => __( 'Hogyan viselkedik a Fullscreen background', 'root' ),
        'id'      => $prefix . 'bgpos',
        'type'    => 'radio_inline',
        'options' => array(
          'fs' => 'Kifeszített',
          'float' => 'Úsztatott',
        ),
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
        'name'    => __( 'Kiskocka?', 'root' ),
        'desc'    => __( 'Kell e jobb alsó sarokba kiskép', 'root' ),
        'id'      => $prefix . 'spos',
        'type'    => 'radio_inline',
        'options' => array(
          'van' => 'Van',
          'nincs' => 'Nincs',
        ),
      ),
      array(
        'name' => __( 'Single Cement Tile', 'root' ),
        'desc' => __( 'Upload an image or enter a URL. (optional, min: 500×500px)', 'root' ),
        'id'   => $prefix . 'singleimg',
        'type' => 'file',
        'save_id' => true, // save ID using true
        'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
      ),

      array(
          'name'             => 'Csatolt galéria',
          'desc'             => 'Válassz egy galériát',
          'id'               => $prefix . 'refgal',
          'type'             => 'select',
          'show_option_none' => false,
          'default'          => '0',
          'options'          =>  'cement_show_refgal'
      ),

     array(
        'name'    => __( 'Additional content', 'root' ),
        'desc'    => __( 'Add your own gallery or additional content', 'root' ),
        'id'      => $prefix . 'addcont',
        'type'    => 'wysiwyg',
        'options' => array( 'textarea_rows' => 15, 'wpautop' => true ),
      ),

    ),
    )
  );

  $kontlista=cement_show_kontener();

  $cmb_product2 = new_cmb2_box( array(
    'id'         => 'r2meta',
    'title'      => 'Szállítási infók',
    'object_types'  => array( 'product'), // Post type
    'context'    => 'side',
    'priority'   => 'high',
    'show_names' => true,
    'closed'     => true
  ));

  $prodgroup_field_id = $cmb_product2->add_field( array(
    'id'          => 'prod_coming_group',
    'type'        => 'group',
    'description' => __( 'Érkező mennyiségek', 'cmb2' ),
    'options'     => array(
        'group_title'   => __( 'Szállítmány {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => __( 'Új szállítmány hozzáadása', 'cmb2' ),
        'remove_button' => __( 'Szállítmány törlése', 'cmb2' ),
        'sortable'      => true, // beta
    ),
  ) );

  $cmb_product2->add_group_field( $prodgroup_field_id, array(
    'id' => 'prc_kontno',
    'name' => 'Konténer',
    'type' => 'select',
    'show_option_none' => false,
    'default'          => '0',
    'options'          =>  $kontlista
  ) );


  // $cmb_product2->add_group_field( $prodgroup_field_id, array(
  //   'id' => 'prc_date',
  //   'name' => 'Érkezik ekkor',
  //   'type' => 'text_date_timestamp',
  // ) );
  $cmb_product2->add_group_field( $prodgroup_field_id, array(
    'id' => 'prc_quant',
    'name' => 'Érkező mennyiség',
    'type' => 'text_small',
  ) );


  /****** Konténer Boxes ******/
  $cmb_kontener = new_cmb2_box( array(
    'id'         => 'kontenermeta',
    'title'      => 'Konténer részletek',
    'object_types'      => array( 'kontener'), // Post type
    'context'    => 'side',
    'priority'   => 'high',
    'show_names' => true, // Show field names on the left
  ));
  $cmb_kontener->add_field( array(
        'name' => __( 'Érkezési dátuma', 'root' ),
        'id'   => $prefix . 'cardate',
        'type' => 'text_date_timestamp'
  ));


  /****** Post Boxes ******/
  $cmb_posts = new_cmb2_box( array(
    'id'         => 'pppmeta',
    'title'      => 'Additional details',
    'object_types'      => array( 'post'), // Post type
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true, // Show field names on the left
    'fields'     => array(
      array(
        'name' => __( 'Fullscreen wallpaper', 'root' ),
        'desc' => __( 'Upload an image or enter a URL. (min: 1920×1280px)', 'root' ),
        'id'   => $prefix . 'wallimg',
        'type' => 'file',
        'save_id' => true, // save ID using true
        'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
      ),
      array(
        'name'    => __( 'Additional content', 'root' ),
        'desc'    => __( 'Add your own gallery or additional content', 'root' ),
        'id'      => $prefix . 'addcont',
        'type'    => 'wysiwyg',
        'options' => array( 'textarea_rows' => 15, 'wpautop' => true ),
      ),
    )
    )
  );

  /****** Slider Boxes ******/
  $cmb_slider = new_cmb2_box( array(
    'id'         => 'slidemeta',
    'title'      => 'Slide details',
    'object_types'      => array( 'slide'), // Post type
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true, // Show field names on the left
    'fields'     => array(
      array(
        'name' => __( 'Button text', 'root' ),
        'desc' => __( 'Add button for this slide', 'root' ),
        'id'   => $prefix . 'btntxt',
        'type' => 'text',
        // 'repeatable' => true,
      ),
      array(
        'name' => __( 'Button Url', 'root' ),
        'desc' => __( 'Add custom url to jump', 'root' ),
        'id'   => $prefix . 'btnurl',
        'type' => 'text_url',
        // 'repeatable' => true,
      ),
    ),
    )
  );

}

/********* End of Custom MetaBoxes ****************/




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


/******* WP OPtions ******/
class CementlapSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin',
            'Cementlap Settings',
            'manage_options',
            'cementlap-setting-admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'cementlap_option_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Cementlap Settings</h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'cementlap_option_group' );
                do_settings_sections( 'cementlap-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'cementlap_option_group', // Option group
            'cementlap_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Cementlap Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'cementlap-setting-admin' // Page
        );



        /***** Konténer vége ******/

        add_settings_field(
            'ntd',
            'Gyártandó termékek ekkor érkezhetnek legkorábban',
            array( $this, 'ntd_callback' ),
            'cementlap-setting-admin',
            'setting_section_id'
        );
        add_settings_field(
            'subtitle',
            'Advert Sub Title',
            array( $this, 'subtitle_callback' ),
            'cementlap-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'button_text', // ID
            'Advert button text', // Title
            array( $this, 'button_text_callback' ), // Callback
            'cementlap-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'button_url', // ID
            'Button url', // Title
            array( $this, 'button_url_callback' ), // Callback
            'cementlap-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'change', // ID
            'Euro arfolyam', // Title
            array( $this, 'change_callback' ), // Callback
            'cementlap-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'vat', // ID
            'ÁFA', // Title
            array( $this, 'vat_callback' ), // Callback
            'cementlap-setting-admin', // Page
            'setting_section_id' // Section
        );


    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();


        if( isset( $input['ntd'] ) )
            $new_input['ntd'] = sanitize_text_field( $input['ntd'] );

        if( isset( $input['subtitle'] ) )
            $new_input['subtitle'] = sanitize_text_field( $input['subtitle'] );

        if( isset( $input['button_text'] ) )
            $new_input['button_text'] = sanitize_text_field( $input['button_text'] );

        if( isset( $input['button_url'] ) )
            $new_input['button_url'] = sanitize_text_field( $input['button_url'] );

        if( isset( $input['change'] ) )
            $new_input['change'] = sanitize_text_field( $input['change'] );

        if( isset( $input['vat'] ) )
            $new_input['vat'] = sanitize_text_field( $input['vat'] );

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print "Don't use long sentences below!";
    }

    /**
     * Get the settings option array and print one of its values
     */


    public function ntd_callback()
    {
        printf(
            '<input type="text" id="ntd" name="cementlap_option_name[ntd]" value="%s" />',
            isset( $this->options['ntd'] ) ? esc_attr( $this->options['ntd']) : ''
        );
    }

    public function subtitle_callback()
    {
        printf(
            '<input type="text" id="subtitle" name="cementlap_option_name[subtitle]" value="%s" />',
            isset( $this->options['subtitle'] ) ? esc_attr( $this->options['subtitle']) : ''
        );
    }

    public function button_text_callback()
    {
        printf(
            '<input type="text" id="button_text" name="cementlap_option_name[button_text]" value="%s" />',
            isset( $this->options['button_text'] ) ? esc_attr( $this->options['button_text']) : ''
        );
    }

    public function button_url_callback()
    {
        printf(
            '<input type="text" id="button_url" name="cementlap_option_name[button_url]" value="%s" />',
            isset( $this->options['button_url'] ) ? esc_attr( $this->options['button_url']) : ''
        );
    }

    public function change_callback()
    {
        printf(
            '<input type="text" id="change" name="cementlap_option_name[change]" value="%s" />',
            isset( $this->options['change'] ) ? esc_attr( $this->options['change']) : ''
        );
    }

    public function vat_callback()
    {
        printf(
            '<input type="text" id="vat" name="cementlap_option_name[vat]" value="%s" />',
            isset( $this->options['vat'] ) ? esc_attr( $this->options['vat']) : ''
        );
    }
}

if( is_admin() ) {
  $cementlap_settings_page = new CementlapSettingsPage();
}




function cementlap_modify_num_products($query)
{
    if ( ($query->is_main_query()) && ($query->is_tax('product-category') || $query->is_tax('product-design') || $query->is_tax('product-color') || $query->is_tax('product-style') || $query->is_category() ) && (!is_admin()) ) {
      $query->set('posts_per_page', 75);
      if ( !($query->is_category() ) ) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
      }


    }

}

add_action('pre_get_posts', 'cementlap_modify_num_products');



# Deregister style files
function cement_DequeueYarppStyle()
{
  wp_dequeue_style('yarppRelatedCss');
  wp_deregister_style('yarppRelatedCss');
}
add_action('wp_footer', 'cement_DequeueYarppStyle');

# WPSS Styles Remove
function cement_remove_wpss_styles() {
  if(!is_admin()){
    //wp_deregister_style( 'wpss-style' );
    //wp_deregister_style( 'wpss-custom-db-style' );
  }
}
add_action( 'wp_print_styles', 'cement_remove_wpss_styles', 100 );

# Deregister scripts file
function cement_remove_scripts () {
  if(!is_admin()){
    //wp_deregister_script('bootstrap-shortcodes-tooltip');
    //wp_deregister_script('bootstrap-shortcodes-popover');

  }
}
add_action('wp_print_scripts', 'cement_remove_scripts', 11);



/***** Gallery Posts Option list *****/



/******** WPML Helper Functions ********/
function lang_object_ids($ids_array, $type) {
 if(function_exists('icl_object_id')) {
  $res = array();
  foreach ($ids_array as $id) {
   $xlat = icl_object_id($id,$type,false);
   if(!is_null($xlat)) $res[] = $xlat;
  }
  return $res;
 } else {
  return $ids_array;
 }
}



function get_term_top_most_parent( $term_id, $taxonomy ) {
    $parent  = get_term_by( 'id', $term_id, $taxonomy );
    while ( $parent->parent != 0 ){
        $parent  = get_term_by( 'id', $parent->parent, $taxonomy );
    }
    return $parent;
}


function get_gallery_attachments($contentblock){

  preg_match('/\[gallery.*ids=.(.*).\]/', $contentblock, $ids);
  $images_id = explode(",", $ids[1]);

  return $images_id;
}



/*** Product Style Meta Data ***/

if (is_admin()){
  /*
   * prefix of meta keys, optional
   */
  $prefix = 'ps_';
  /*
   * configure your meta box
   */
  $config = array(
    'id' => 'demo_meta_box',          // meta box id, unique per meta box
    'title' => 'Additional data',          // meta box title
    'pages' => array('product-style'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => get_stylesheet_directory_uri().'/lib/Tax-Meta-Class/Tax-meta-class/',          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );


  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);

  /*
   * Add fields to your meta box
   */


  $repeater_colorfields[] = $my_meta->addTaxonomy('color_id',array('taxonomy' => 'product-color'),array('name'=> 'Color'), true);
  $repeater_designfields[] = $my_meta->addTaxonomy('design_id',array('taxonomy' => 'product-design'),array('name'=> 'Style'), true);


  $my_meta->addRepeaterBlock('rec_',array('inline' => true, 'name' => 'Available in these colors','fields' => $repeater_colorfields));
  $my_meta->addRepeaterBlock('red_',array('inline' => true, 'name' => 'Design','fields' => $repeater_designfields));

  $semmi=0;
  $my_meta->addSelect($prefix.'gallery_id',cement_show_refgal($semmi),array('name'=> __('Attached gallery ','tax-meta'), 'std'=> array('0')));

  $my_meta->addImage($prefix.'image_id',array('name'=> __('Featured Image (min. 768x432) ','tax-meta')));
  $my_meta->addImage($prefix.'sablon_id',array('name'=> __('Sablon Image (min. 768x768) egy két svg-t is kipróbálhatsz ','tax-meta')));
  $my_meta->addImage($prefix.'border_id',array('name'=> __('Border Image ','tax-meta')));


  /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}


  function styleisingroup($style,$group) {
    $r=false;
    //var_dump($style->term_id);
    $terms = get_field('grouping', $style );
    //var_dump($group);
    //echo "<hr>";
    foreach ($terms as $key => $value) {
      if (in_array($value, $group) ) {
        $r = true;
        break;
      }
    }
    return $r;
  }