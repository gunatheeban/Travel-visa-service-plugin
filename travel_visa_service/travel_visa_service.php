<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Travel Visa Service
 * Plugin URI:        http://gtnsoft.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Gunatheeban
 * Author URI:        http://gtnsoft.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       travel_visa_service
 * Domain Path:       /languages
 */

class GtVisaPlugin{
    
    function __construct() {
        add_action('init', array($this,'visa_post_type'));
        add_action('init', array($this,'custom_country_taxnomies'));
        add_action('init', array($this,'custom_visa_type_taxnomies'));
        add_filter( 'template_include', array($this,'cpte_force_template'));
    }
    
    function activate(){
        $this->visa_post_type();
        $this->custom_country_taxnomies();
        $this->custom_visa_type_taxnomies();
        // $this->cpte_force_template();
//        add_filter( 'template_include', 'cpte_force_template' );
    }
    
    function deactivate(){
        echo "Plugin deactivated";
    }
    
    function uninstall(){
        
    }
    
    function visa_post_type(){
        $args = array(
            'public' => true,
            'label' => 'Visa',
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
        );
        register_post_type('visa', $args);
       
    }
    
    function custom_country_taxnomies(){
        $args = array(
            'public' => true,
            'label' => 'Country',
        );
        register_taxonomy('country', 'visa', $args);
    }
    
    function custom_visa_type_taxnomies(){
        $args = array(
            'public' => true,
            'label' => 'Visa Type',
        );
        register_taxonomy('visatype', 'visa', $args);
    }
    
    // force use of templates from plugin folder
    function cpte_force_template( $template )
    {	
        if( is_archive( 'visa' ) ) {
            $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/templates/archive-visa.php';
    	}
     
    	if( is_singular( 'visa' ) ) {
            $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/templates/single-visa.php';
    	}
     
        return $template;
    } 

}

$visaplugin =  (class_exists('GtVisaPlugin')) ? new GtVisaPlugin() : "";

//actvation
register_activation_hook(__FILE__, array( $visaplugin , 'activate' )) ;
//deactivation
register_deactivation_hook(__FILE__, array( $visaplugin , 'deactivate' )) ;
//uninstall