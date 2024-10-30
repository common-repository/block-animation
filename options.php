<?php

class pisol_ba_option{

    private $setting = array();

    private $active_tab;

    private $this_tab = 'default';

    private $tab_name = "General setting";

    private $setting_key = 'pisol_ba_default';

    function __construct(){

        $this->active_tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'default';

        $this->settings = array(
                array('field'=>'pi_offset', 'label'=>__('Animation offset','pisol-dtt'),'desc'=> 'Define the distance between the bottom of browser viewport and the top of hidden box.
                When the user scrolls and reach this distance the hidden box is revealed.', 'type'=>'number',  'default'=>"20"),

                array('field'=>'pi_mobile', 'label'=>__('Animation on Mobile','pisol-dtt'),'desc'=>'Turn on/off animation on mobile devices.', 'type'=>'select', 'value'=>array(false=>__('OFF','pisol-ba'), true=>__('ON','pisol-ba')), 'default'=>true), 

            );
        

        if($this->this_tab == $this->active_tab){
            add_action('pisol_ba_tab_content', array($this,'tab_content'));
        }

        add_action('pisol_ba_tab', array($this,'tab'),1);
        
        $this->register_settings();
    }

    function register_settings(){   

        foreach($this->settings as $setting){
                register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        ?>
        <a class="nav-tab <?php echo $this->active_tab == $this->this_tab || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'admin.php?page='.$_GET['page'].'&tab='.$this->this_tab ); ?>">
            <?php _e( $this->tab_name, 'pisol-dtt' ); ?> 
        </a>
        <?php
    }

    function tab_content(){
       ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <div class="pisol_grid">
        <?php
            foreach($this->settings as $setting){
                new pisol_ba_class_form($setting, $this->setting_key);
            }
        ?>
        </div>
        <?php submit_button(); ?>
        </form>
       <?php
    }
}

add_action('pisol_ba_option', new pisol_ba_option());