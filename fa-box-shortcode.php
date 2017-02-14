<?php
/**
 * Plugin Name:       Font Awesome Box Shortcode
 * Plugin URI:        https://wordpress.org/plugins/fa-box-shortcode/
 * Description:       The Font Awesome box shortcode plugin adds slim information box style shortcodes to your WordPress site which support displaying any of the Font Awesome icons.
 * Version:           1.0.1
 * Author:            Stuart Duff
 * Author URI:        http://stuartduff.com
 * Requires at least: 4.6
 * Tested up to:      4.7.2
 *
 * Text Domain: fa-box-shortcode
 * Domain Path: /languages/
 *
 * @package FA_Box_Shortcode
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Returns the main instance of FA_Box_Shortcode to prevent the need to use globals.
 *
 * @since   1.0.0
 * @return  object FA_Box_Shortcode
 */
function FA_Box_Shortcode() {
  return FA_Box_Shortcode::instance();
} // End FA_Box_Shortcode()
FA_Box_Shortcode();

/**
 * Main FA_Box_Shortcode Class
 *
 * @class FA_Box_Shortcode
 * @version   1.0.0
 * @since     1.0.0
 * @package   FA_Box_Shortcode
 */
final class FA_Box_Shortcode {

  /**
   * FA_Box_Shortcode The single instance of FA_Box_Shortcode.
   * @var     object
   * @access  private
   * @since   1.0.0
   */
  private static $_instance = null;

  /**
   * The token.
   * @var     string
   * @access  public
   * @since   1.0.0
   */
  public $token;

  /**
   * The version number.
   * @var     string
   * @access  public
   * @since   1.0.0
   */
  public $version;

  /**
   * Constructor function.
   * @access  public
   * @since   1.0.0
   * @return  void
   */
  public function __construct() {
    $this->token          = 'fa-box-shortcode';
    $this->plugin_url     = plugin_dir_url( __FILE__ );
    $this->plugin_path    = plugin_dir_path( __FILE__ );
    $this->version        = '1.0.1';

    register_activation_hook( __FILE__, array( $this, 'install' ) );

    $this->plugin_setup();

  }

  /**
   * Main FA_Box_Shortcode Instance
   *
   * Ensures only one instance of FA_Box_Shortcode is loaded or can be loaded.
   *
   * @since   1.0.0
   * @static
   * @see     FA_Box_Shortcode()
   * @return  Main FA_Box_Shortcode instance
   */
  public static function instance() {
    if ( is_null( self::$_instance ) )
      self::$_instance = new self();
    return self::$_instance;
  } // End instance()

  /**
   * Installation.
   * Runs on activation. Logs the version number.
   * @access  public
   * @since   1.0.0
   * @return  void
   */
  public function install() {
    $this->_log_plugin_version_number();
  }

  /**
   * Log the plugin version number.
   * @access  private
   * @since   1.0.0
   * @return  void
   */
  private function _log_plugin_version_number() {
    // Log the version number.
    update_option( $this->token . '-version', $this->version );
  }

  /**
   * Setup all the things.
   * @since   1.0.0
   * @return void
   */
  public function plugin_setup() {
    global $pagenow;

    if ( is_admin() && $pagenow == 'post.php' ) {
      add_action( 'init', array( $this, 'fabs_shortcode_button_init' ) );
    } else {
      add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_plugin_styles' ) );
      add_shortcode( 'box', array( $this, 'box_shortcode_ouput' ) );
    }
  }

  /**
   * Load widget admin styles
   * @since   1.0.0
   */
  public function enqueue_plugin_styles() {

    wp_register_style( 'fa-box-shortcode', $this->plugin_url . 'assets/css/fa-box-shortcode.css' );

    wp_enqueue_style( 'fa-box-shortcode' );

    /**
     * This checks to see if you have a stylesheet titled "font-awesome" loaded from your theme or another plugin.
     *
     * If the name of another loaded version of font awesome on your site does not match "font-awesome"
     * you can set the name of your loaded version via the filter 'enqueued_fabs_font_awesome_filter'.
     *
     * This will then disable this plugins font awesome style from loading and will only
     * load your sites existing font awesome style from another theme or plugin.
     *
     * Otherwise you may have two versions of font awesome loaded.
     */
    if ( ! wp_style_is( apply_filters( 'enqueued_fabs_font_awesome_filter', 'font-awesome' ), $list = 'enqueued' ) ) {
      wp_register_style( 'fabs-font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
      wp_enqueue_style( 'fabs-font-awesome' );
    }

  }

  /**
   * Shortcode output
   * @since   1.0.0
   */
  public function box_shortcode_ouput( $atts, $content = null ) {

  	extract( shortcode_atts( array(
  		'url'   => '',
      'color' => '',
  		'icon'  => '',
  	), $atts ) );

    $html = '';

    $html .= '<div class="fabs-shortcode-box">';

      $html .= '<a href="' . esc_url( $url ) . '" class="fabs-url" target="_blank">';

        $html .= '<div class="fabs-box ' . esc_attr( $color ) . ' ' . substr( esc_attr( $icon ), 3 ) . '"><span class="fabs-icon fa ' . esc_attr( $icon ) . '"></span>';

          $html .= '<div class="fabs-content">' . esc_attr( $content ) .'</div>';

        $html .= '</div><!-- .fabs-box -->';

      $html .= '</a><!-- .fabs-url -->';

    $html .= '</div><!-- .fabs-shortcode-box -->';

    return $html;

  }

  /**
   * Shortcode button init
   * @since   1.0.0
   */
  public function fabs_shortcode_button_init() {
    // Abort early if the user will never see TinyMCE
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) && get_user_option( 'rich_editing' ) == 'true')
      return;

    // Add a callback to register our TinyMCE plugin javascript
    add_filter( 'mce_external_plugins', array( $this, 'fabs_register_tinymce_plugin_javascript' ) );

    // Add a callback to add our button to the TinyMCE toolbar.
    add_filter( 'mce_buttons', array( $this, 'fabs_add_tinymce_button' ) );
  }

  /**
   * This funtion registers our TinyMCE plugin javascript.
   * @since   1.0.0
   */
  public function fabs_register_tinymce_plugin_javascript( $plugin_array ) {
    $plugin_array['fabs_button'] = plugins_url( 'assets/js/fa-box-shortcode.js',__FILE__ );
    return $plugin_array;
  }

  /**
   * This function is for the TinyMCE toolbar button.
   * @since   1.0.0
   */
  public function fabs_add_tinymce_button( $buttons ) {
    // Add the button ID to the $button array
    $buttons[] = 'fabs_button';
    return $buttons;
  }

} // END FA_Box_Shortcode
