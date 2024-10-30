<?php
include_once ( PISOL_GA_PATH . 'include/pisol.class.form.php');
include_once ( PISOL_GA_PATH . 'options.php');

class pisol_ba_menu{

    
    function __construct(){
       
        add_action( 'admin_menu', array($this,'plugin_menu') );
        add_action( 'admin_enqueue_scripts', array($this,'menu_page_style') );
        do_action('pisol_ba_options');
        add_action('pisol_dtt_promotion', array($this,'promotion'));
    }

    function plugin_menu(){
        
        add_submenu_page('options-general.php', __('Block animation','pisol-ba'), __('Block animation','pisol-ba'), 'manage_options', 'pisol-ba',  array($this, 'menu_option_page')  );

    }

    function menu_option_page(){
        ?>
        <div class="wrap">
            <h1><?php echo __('Block animation setting','pisol-ba'); ?></h1>
            <h2 class="nav-tab-wrapper">
                <?php do_action('pisol_ba_tab'); ?>
            </h2>
            <div id="main-wrap-area" class="pisol-main-wrap-area">
                <div class="pisol-form-container">
                    <?php do_action('pisol_ba_tab_content'); ?>
                </div>
                <div class="pisol-msg-container">
                <?php do_action('pisol_ba_promotion'); ?>
                </div>
            </div>
        </div>
        <?php
    }

    function menu_page_style(){
        wp_enqueue_style('pi_ba_menu_page_style', plugins_url('css/style.css', __FILE__));
    }

    function promotion(){
        ?>
        <?php if (!class_exists('pisol_dtt_pro_option_pickup_location')) : ?>
           <div class="postbox">
                <h2 class="hndle ui-sortable-handle pisol-heading"><span>Get Pro for <strong><?php echo PISOL_DTT_PRICE; ?></strong> insted of $69, Buy Now !!</span></h2>
                <div class="inside" style="text-align:center;">
                    Buy Pro version now to unlock all the features<br /><br />
                    <a class="button button-primary" href="<?php echo PISOL_DTT_BUY_URL; ?>" target="_blank">Click to Buy Now</a>
                </div>
            </div>
        

            <div class="postbox pisol-offer">
                <h2 class="hndle ui-sortable-handle pisol-heading"><span>OFFER !!! Get Pro Version for FREE</span></h2>
                <div class="inside" style="text-align:center;">
                    Review us on WordPress and you may get PRO version for FREE<br /><br />
                    <a class="button button-primary" href="https://wordpress.org/support/plugin/pi-woocommerce-order-date-time-and-type/reviews/" target="_blank">Give Rating Now !!</a>
                </div>
            </div>
        <?php endif; ?>
        <?php
    }

}

new pisol_ba_menu();