<?php
/**
 * Plugin Name: LH Image Renamer
 * Plugin URI: https://lhero.org/portfolio/lh-image-renamer/
 * Description: Renames image files automatically on upload if they are attached to a post, page, or cpt.
 * Version: 1.01
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 * Text Domain: lh_image_renamer
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!class_exists('LH_Image_renamer_plugin')) {

class LH_Image_renamer_plugin {

    private static $instance;

    static function return_plugin_namespace(){
    
        return 'lh_image_renamer';
    
    }


    static function normalizestring($str = ''){
        
        $str = strip_tags($str); 
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        $str = str_replace('.jpeg', '.jpg', $str);
        return $str;
        
    }



    public function fix_filename($filename) {
        
        $filename = self::normalizestring($filename);
    
        if ( !empty($_REQUEST['post_id']) ) {
        
            $post_id =  (int)$_REQUEST['post_id'];
            $exists = get_post_status( $post_id );
            $info = pathinfo($filename);
        
            if (isset($exists) && !empty($info['extension']) && in_array(strtolower($info['extension']),  array("jpg", "jpeg", "gif", "png", "bmp"))){
        
                $post_object = get_post($post_id);
                $ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
                $name = basename($filename, $ext);
            
                if (isset($post_object->post_name) and !empty($post_object->post_name) ){
        
                    $return  = strtolower($post_object->post_name."_".$name . $ext);
                    $filename = apply_filters( 'lh_image_renamer_return_name_filter', $return, $filename, $post_object, $name, $ext);
    
                } elseif (isset($post_object->post_title) and !empty($post_object->post_title) ){
    
                    $return  = strtolower(self::normalizestring($post_object->post_title)."_".$name . $ext);
                    $filename = apply_filters( 'lh_image_renamer_return_name_filter', $return, $filename, $post_object, $name, $ext);
    
                }
    
            }
    
        }
    
        return $filename;
    
    }

    public function plugin_init(){
        
        //load the translations
        load_plugin_textdomain( self::return_plugin_namespace(), false, basename( dirname( __FILE__ ) ) . '/languages' );
    
        //make uploaded file names more meaningful    
        add_filter('sanitize_file_name', array($this,'fix_filename'), 10,1);
        
        
    }

    /**
     * Gets an instance of our plugin.
     *
     * using the singleton pattern
     */
     
    public static function get_instance(){
        
        if (null === self::$instance) {
            
            self::$instance = new self();
            
        }
 
        return self::$instance;
        
    }


    public function __construct() {
    
        //add hooks on plugins loaded   
        add_action( 'plugins_loaded', array($this,'plugin_init'));
    
    }



}


$lh_image_renamer_instance = LH_Image_renamer_plugin::get_instance();

}


?>