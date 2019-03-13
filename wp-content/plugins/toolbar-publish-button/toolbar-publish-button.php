<?php

/*
 * Plugin Name: Toolbar Publish Button
 * Plugin URI: https://wpUXsolutions.com
 * Description: Save a lot of your time by scrolling less in WP admin! A small UX improvement that keeps Publish button within reach and retains the scrollbar position after saving in WordPress admin.
 * Version: 1.6.2
 * Author: wpUXsolutions
 * Author URI: https://wpUXsolutions.com
 * License: GPL2+ - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: toolbar-publish-button
 * Domain Path: /languages/
 *
 * Copyright 2013-2018  wpUXsolutions  (email : wpUXsolutions@gmail.com)
 */



if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}



if ( ! class_exists( 'tpb' ) ) :

class tpb {

    /**
     * TPB version.
     *
     * @var string
     */
    public $version = '1.6.2';



    /**
     *  Main TPB Instance.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  N/A
     *  @return (object) the one TPB instance
     */

    public static function instance() {

        static $instance = null;

        if ( null === $instance ) {
            $instance = new tpb;
            $instance->initialize();
        }

        return $instance;
    }



    /**
     * Constructor. Intentionally left empty.
     *
     * @since   1.5
     *  @date   07/10/16
     */

    function __construct() {}



    /**
     *  Initializes TPB.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  N/A
     *  @return N/A
     */

    function initialize() {

        // options
        $this->options = array(

            'name'              => __('Toolbar Publish Button', 'enhanced-media-library'),
            'dir'               => plugin_dir_url( __FILE__ ),
            'basename'          => plugin_basename( __FILE__ ),

            'settings'          => get_option( 'wpuxss_tpb_settings', array() )
        );


        // on update
        $version = get_option( 'wpuxss_tpb_version', null );

        if ( ! is_null( $version ) && version_compare( $version, $this->version, '<>' ) ) {
            $this->on_update();
        }


        // init actions
        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
        add_action( 'init', array( $this, 'register_admin_assets') );

        add_action( 'admin_init', array( $this, 'register_setting' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets') );
        add_action( 'admin_print_scripts-settings_page_tpb-settings', array( $this, 'print_tpb_settings_page_scripts' ) );


        // activation hook
        add_action( 'activate_' . $this->get_option( 'basename' ), array( $this, 'on_activation' ), 20 );


        // filters
        add_filter( 'plugin_action_links_' . $this->get_option( 'basename' ), array( $this, 'tpb_settings_links' ) );
    }



    /**
     *  Returns a value from the options.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  $name (string) the option name to return
     *  @param  $value (mixed) default value
     *  @return $value (mixed)
     */

    function get_option( $name, $value = null ) {

        if ( isset( $this->options[$name] ) ) {
            $value = $this->options[$name];
        }

        return $value;
    }



    /**
     *  Updates a value into the options.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  $name (string)
     *  @param  $value (mixed)
     *  @return N/A
     */

    function update_option( $name, $value ) {

        $this->options[$name] = $value;
    }



    /**
     *  Loads plugin text domain.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function load_plugin_textdomain() {

        load_plugin_textdomain( 'toolbar-publish-button', false, dirname( $this->get_option( 'basename' ) ) . '/languages' );
    }



    /**
     *  Register plugin settings.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function register_setting() {

        register_setting(
            'wpuxss_tpb_settings', //option_group
            'wpuxss_tpb_settings', //option_name
            array( $this, 'sanitize_tpb_settings' ) //sanitize_callback
        );
    }



    /**
     *  Sanitizes plugin settings before saving.
     *
     *  @type   callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function sanitize_tpb_settings( $input ) {

        // settings
        $input['scrollbar_return'] = isset( $input['scrollbar_return'] ) && !! $input['scrollbar_return'] ? 1 : 0;
        $input['draft_button'] = isset( $input['draft_button'] ) && !! $input['draft_button'] ? 1 : 0;
        $input['preview_button'] = isset( $input['preview_button'] ) && !! $input['preview_button'] ? 1 : 0;


        // button BG color setting
        $tpb_settings = $this->get_option( 'settings' );
        $button_bg_color = trim( $input['button_bg_color'] );
        $button_bg_color = strip_tags( stripslashes( $button_bg_color ) );

        if( ! empty( $button_bg_color ) && false === $this->validate_color_format( $button_bg_color ) ) {

            // $setting, $code, $message, $type
            add_settings_error( 'wpuxss_tpb_settings', 'wpuxss_tpb_settings_color_error', __( 'Please choose a valid color for background', 'toolbar-publish-button' ), 'error' );

            $input['button_bg_color'] = $tpb_settings['button_bg_color'];

        } else {
            $input['button_bg_color'] = $button_bg_color;
        }

        return $input;
    }



    /**
     *  Checks if BG color format is correct.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  $color (string)
     *  @return (bool)
     */

    function validate_color_format( $color ) {

        if ( preg_match( '/^#[a-f0-9]{6}$/i', $color ) ) {
            return true;
        }

        return false;
    }



    /**
     *  Registers scripts and styles for admin.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function register_admin_assets() {

        $version = $this->version;
        $dir     = $this->get_option( 'dir' );


        // scripts
        wp_register_script( 'tpb-admin', $dir . 'js/tpb.js', array( 'jquery' ), $version, true );
        wp_register_script( 'tpb-jquery-cookie', $dir . 'js/jquery.cookie.js', array( 'jquery', 'tpb-admin' ), $version, true );
        wp_register_script( 'tpb-scrollbar', $dir . 'js/tpb-scrollbar.js', array( 'jquery', 'tpb-admin' ), $version, true );
        wp_register_script( 'tpb-color-picker', $dir . 'js/tpb-color-picker.js', array( 'wp-color-picker' ), $version, true );
        wp_register_script( 'tpb-acf', $dir . 'js/tpb-acf.js', array( 'acf-field-group' ), $version, true );


        // styles
        wp_register_style( 'tpb-admin', $dir . 'css/tpb-admin.css', false, $version, 'all' );
    }



    /**
     *  Enqueues scripts and styles for admin.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function enqueue_admin_assets( $hook ) {

        global $hook_suffix;

        if ( 'index.php' == $hook_suffix ) {
            return;
        }


        $screen = get_current_screen();
        $settings = $this->get_option( 'settings' );


        // scripts
        wp_enqueue_script( 'tpb-admin' );
        wp_localize_script( 'tpb-admin', 'tpb_l10n', array(
            'button_bg' => $settings['button_bg_color'],
            'draft_button' => (bool) $settings['draft_button'],
            'preview_button' => (bool) $settings['preview_button']
        ) );

        if ( (bool) $settings['scrollbar_return'] ) {

            wp_enqueue_script( 'tpb-jquery-cookie' );
            wp_enqueue_script( 'tpb-scrollbar' );

            if ( 'acf-field-group' === $screen->post_type || 'acf' === $screen->post_type && class_exists( 'ACF' ) ) {
                wp_enqueue_script( 'tpb-acf' );
            }
        }


         // styles
         wp_enqueue_style( 'tpb-admin' );
    }



    /**
     *  Enqueues scripts for plugin's settings page.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function print_tpb_settings_page_scripts() {

        // scripts
        wp_enqueue_script( 'tpb-color-picker' );

        // styles
        wp_enqueue_style( 'wp-color-picker' );
    }



    /**
     *  Adds plugin options admin page.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function admin_menu() {

        add_options_page(
            __('Toolbar Publish Button Settings','toolbar-publish-button'), //page_title
            __('Toolbar Publish Button','toolbar-publish-button'), //menu_title
            'manage_options', //capability
            'tpb-settings', //page
            array( $this, 'print_tpb_settings_page' ) //callback
        );
    }



    /**
     *  Displays TPB settings page.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  N/A
     *  @return N/A
     */

    function print_tpb_settings_page() {

        $version = $this->version;
        $settings = $this->get_option( 'settings' );


        if ( ! current_user_can( 'manage_options' ) )
            wp_die( __('You do not have sufficient permissions to access this page.','toolbar-publish-button') );
        ?>

        <div id="tpb-settings-wrap" class="wrap">

            <h2><?php _e( 'Toolbar Publish Button', 'toolbar-publish-button' ); ?></h2>

            <div id="poststuff">

                <div id="post-body" class="metabox-holder columns-2">

                    <div id="postbox-container-2" class="postbox-container">

                        <div class="postbox">

                            <h3 class="hndle"><?php _e( 'Basic Settings', 'toolbar-publish-button' ); ?></h3>

                            <div class="inside">

                                <form method="post" action="options.php">

                                    <?php settings_fields( 'wpuxss_tpb_settings' ); ?>

                                    <table class="form-table">

                                        <tr>
                                            <th scope="row"><?php _e('Scrollbar Position','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('Remember scrollbar position','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[scrollbar_return]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['scrollbar_return'] ); ?> /> <?php _e('Remember scrollbar position','toolbar-publish-button'); ?></label>
                                                    <p class="description"><?php _e('Returns the scrollbar of an admin page (including code Editor page) to its position after saving.','toolbar-publish-button'); ?></p>
                                                    <p class="description"><?php _e('Works for Plugins page after plugin actiation / deactivation.','toolbar-publish-button'); ?></p>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php _e('"Save Draft" button','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('"Save Draft" button','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[draft_button]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['draft_button'] ); ?> /> <?php _e('Duplicate "Save Draft" button to admin bar','toolbar-publish-button'); ?></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php _e('"Preview" button','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('"Preview" button','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[preview_button]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['preview_button'] ); ?> /> <?php _e('Duplicate "Preview" / "Preview Changes" button to admin bar','toolbar-publish-button'); ?></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php _e('Button Background','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('Button Background','toolbar-publish-button'); ?></span></legend>
                                                    <label><input type="text" value="<?php echo $settings['button_bg_color']; ?>" class="wpuxss-tpb-button-color" name="wpuxss_tpb_settings[button_bg_color]" /></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                    </table>

                                    <?php submit_button(); ?>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div id="postbox-container-1" class="postbox-container">

                        <div class="postbox" id="wpuxss-credit">

                            <h3 class="hndle">Toolbar Publish Button <?php echo $version; ?></h3>

                            <div class="inside">

                                <h4><?php _e( 'Changelog', 'toolbar-publish-button' ); ?></h4>
                                <p><?php _e( 'What\'s new in', 'toolbar-publish-button' ); ?> <a href="http://wordpress.org/plugins/toolbar-publish-button/changelog/"><?php _e( 'version', 'toolbar-publish-button' ); echo ' ' . $version; ?></a>.</p>

                                <h4><?php _e( 'Support', 'toolbar-publish-button' ); ?></h4>
                                <p><?php _e( 'Feel free to ask for help on', 'toolbar-publish-button' ); ?> <a href="http://www.wpuxsolutions.com/support/">www.wpuxsolutions.com</a>.</p>

                                <h4><?php _e( 'Plugin rating', 'toolbar-publish-button' ); ?> <span class="dashicons dashicons-thumbs-up"></span></h4>
                                <p><?php _e( 'Please', 'toolbar-publish-button' ); ?> <a href="http://wordpress.org/support/view/plugin-reviews/toolbar-publish-button/"><?php _e( 'vote for the plugin', 'toolbar-publish-button' ); ?></a>. <?php _e( 'Thanks!', 'toolbar-publish-button' ); ?></p>

                                <h4><?php _e( 'Other plugins you may find useful', 'toolbar-publish-button' ); ?></h4>
                                <ul>
                                    <li><a href="http://wordpress.org/plugins/enhanced-media-library/">Enhanced Media Library</a></li>
                                </ul>

                                <div class="author">
                                    <span><a href="http://www.wpuxsolutions.com/">wpUXsolutions</a> by <a class="logo-webbistro" href="http://twitter.com/webbistro"><span class="icon-webbistro">@</span>webbistro</a></span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php
    }



    /**
     *  Adds settings link to the plugin action links.
     *
     *  @type   filter callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function tpb_settings_links( $links ) {

        return array_merge(
            array(
                'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/options-general.php?page=tpb-settings">' . __('Settings','toolbar-publish-button') . '</a>'
            ),
            $links
        );
    }



    /**
     *  Sets initial plugin settings.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function on_activation() {

        if ( ! is_null( get_option( 'wpuxss_tpb_version', null ) ) ) {
            return;
        }

        // update version
        update_option( 'wpuxss_tpb_version', $this->version );


        // set initial settings
        $tpb_settings = array (
            'scrollbar_return' => 1,
            'button_bg_color' => '',
            'draft_button' => 1,
            'preview_button' => 1
        );

        update_option( 'wpuxss_tpb_settings', $tpb_settings );
        $this->update_option( 'settings', $tpb_settings );
    }



    /**
     *  Makes changes to plugin options on update.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function on_update() {

        // update version
        update_option( 'wpuxss_tpb_version', $this->version );


        // correct settings
        $tpb_settings = $this->get_option( 'settings' );

        $tpb_settings_defaults = array (
            'scrollbar_return' => isset( $tpb_settings['wpuxss_tpb_scrollbar_return'] ) ? $tpb_settings['wpuxss_tpb_scrollbar_return'] : 1,
            'button_bg_color' => isset( $tpb_settings['wpuxss_tpb_background'] ) ? $tpb_settings['wpuxss_tpb_background'] : '',
            'draft_button' => 1,
            'preview_button' => 1
        );

        $tpb_settings = array_intersect_key( $tpb_settings, $tpb_settings_defaults );
        $tpb_settings = array_merge( $tpb_settings_defaults, $tpb_settings );


        update_option( 'wpuxss_tpb_settings', $tpb_settings );
        $this->update_option( 'settings', $tpb_settings );
    }


} // class tpb



/**
*  The main function.
*
*  @since    1.5
*  @date  07/10/16
*
*  @param    N/A
*  @return   (object)
*/

function tpb() {

   return tpb::instance();
}



// initialize
tpb();


endif; // class_exists
