<?php
/**
 * Custom functions
 */

define('ICL_DONT_LOAD_NAVIGATION_CSS', TRUE);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', TRUE);
define('ICL_DONT_LOAD_LANGUAGES_JS', TRUE);


// function icl_load_jquery_dialog() {
//         wp_enqueue_script( 'jquery-ui-dialog', false, array('jquery'), false, true );
// }
  
// add_action( 'admin_enqueue_scripts', 'icl_load_jquery_dialog' );

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
        'name'   => __( 'Original Price', 'root' ),
        'desc'   => __( 'Original price. (if special)', 'root' ),
        'id'     => $prefix . 'origprice',
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
        'name' => __( 'On Stock in Marrakesh', 'root' ),
        'desc' => __( 'Amount of unit on Marrakesh', 'root' ),
        'id'   => $prefix . 'amountmarr',
        'type' => 'text_small',
      ),
      array(
        'name' => __( 'Next transport date', 'root' ),
        'desc' => __( 'field description (optional)', 'root' ),
        'id'   => $prefix . 'arrive',
        'type' => 'text_date',
      ),
      array(
        'name' => __( 'Size', 'root' ),
        'desc' => __( 'eg:  20 × 20 × 1,6 cm', 'root' ),
        'id'   => $prefix . 'size',
        'type' => 'text_small',
      ),
      array(
        'name' => __( 'Weight', 'root' ),
        'desc' => __( 'eg:  34 kg/m<sup>2</sup> | 1,35 kg / lap', 'root' ),
        'id'   => $prefix . 'weight',
        'type' => 'text_small',
      ),
      array(
        'name' => __( 'Kit', 'root' ),
        'desc' => __( 'eg:  dobozban (13 lap ≈ 0,52 m<sup>2</sup>)', 'root' ),
        'id'   => $prefix . 'kit',
        'type' => 'text_small',
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
      array(
        'name'    => __( 'Additional content', 'root' ),
        'desc'    => __( 'Add your own gallery or additional content', 'root' ),
        'id'      => $prefix . 'addcont',
        'type'    => 'wysiwyg',
        'options' => array( 'textarea_rows' => 15, 'wpautop' => true ),
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



/********* Custom MetaBoxes for Product Management ****************/

/**
 * Product Metaboxes
*/
add_filter( 'cmb_meta_boxes', 'cmb_ppp' );
function cmb_ppp( array $meta_boxes ) {
  $prefix = '_meta_';

  $meta_boxes[] = array(
    'id'         => 'pppmeta',
    'title'      => 'Additional details',
    'pages'      => array( 'post'), // Post type
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
    ),
  );
  return $meta_boxes;
}

/********* End of Custom MetaBoxes for Product Management ****************/


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

        add_settings_field(
            'ntd', 
            'Next Transport Date', 
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
}

if( is_admin() ) {
  $cementlap_settings_page = new CementlapSettingsPage();
}




function cementlap_modify_num_products($query)
{
    if ( ($query->is_main_query()) && ($query->is_tax('product-category') || $query->is_category() ) && (!is_admin()) ) {
      $query->set('posts_per_page', -1);
      $query->set('orderby', 'title');
      $query->set('order', 'ASC');
    }

}
 
add_action('pre_get_posts', 'cementlap_modify_num_products');



# Deregister style files
function cement_DequeueYarppStyle()
{
  wp_dequeue_style('yarppRelatedCss');
  wp_deregister_style('yarppRelatedCss');
}
add_action('wp_footer', cement_DequeueYarppStyle);

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
