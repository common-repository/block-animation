<?php
/*
Plugin Name: Gutenberg Block Animation
Plugin URI: https://woo-restaurant.com/
Description: Set animation to any guttenberg block
Version: 1.2.9
Author: PI Websolution
Author URI: piwebsolution.com
Text Domain: pisol-ga
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('PISOL_GA_URL', plugin_dir_url(__FILE__));
define('PISOL_GA_PATH', plugin_dir_path( __FILE__ ));
define('PISOL_GA_BASE', plugin_basename(__FILE__));
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
include_once( PISOL_GA_PATH . 'menu.php' );

function gutenberg_animation_block() {

        wp_enqueue_script(
            'pisol-block',
            PISOL_GA_URL.'js/block.js',
            array( 'wp-blocks', 'wp-element' )
        );

        wp_enqueue_style(
            'pisol-animation',
            PISOL_GA_URL.'css/animate.min.css'
        );
    }
    add_action( 'enqueue_block_editor_assets', 'gutenberg_animation_block');

    add_action( 'enqueue_block_assets', 'pisol_adding_for_front_end');
    function pisol_adding_for_front_end(){
        if(!is_admin()){
            $offset = get_option('pi_offset', 20);
            $mobile = get_option('pi_mobile',true);
            $wow = "
                var wow_ob = new WOW({
                    offset:".$offset.",
                    mobile: ".$mobile."
                });

                wow_ob.init();
            ";
            wp_enqueue_script('pisol-wow', PISOL_GA_URL.'js/wow.min.js');
            wp_add_inline_script('pisol-wow',$wow);
           
            /*            
                wp_enqueue_script(
                'pisol-custom',
                PISOL_GA_URL.'js/custom.js',
                array( 'pisol-wow')
            );
            */
        }
        
    }
