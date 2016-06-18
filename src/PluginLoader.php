<?php

namespace Aicha;

class PluginLoader
{
    protected $actions;
    protected $filters;
    protected $shortcodes;

    public function __construct() {
    	$this->actions = array();
    	$this->filters = array();
    	$this->shortcodes = array();
        add_action('admin_menu', array($this, 'AddAdminPage'));
    }
    
    public function add_action( $hook, $component, $callback ) {
        $this->actions = $this->add( $this->actions, $hook, $component, $callback );
    }
 
    public function add_filter( $hook, $component, $callback ) {
        $this->filters = $this->add( $this->filters, $hook, $component, $callback );
    }

    public function add_shortcode($tag, $component, $callback){
        $this->shortcodes[] = array(
        	"tag"=>$tag, 
            'component' => $component,
        	"callback"=>$callback 
        );
    }

    private function add( $hooks, $hook, $component, $callback ) {
 
        $hooks[] = array(
            'hook'      => $hook,
            'component' => $component,
            'callback'  => $callback
        );
 
        return $hooks;
 
    }
    public function AddAdminPage(){
        $page_title = "Gestion personnalisée des utilisateurs";
        $menu_title = "Gestion Utilisateurs avancée";
        $capability = "edit_users";
        $menu_slug = "gestion-advanced-user";
        $page = new AdminPage();
        $callback = array( $page, 'show' );
        add_menu_page( 
            $page_title, 
            $menu_title, 
            $capability, 
            $menu_slug, 
            $callback, 
            "");
    }
    public function init() {

        foreach ( $this->filters as $hook ) {
            add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
        }
  
        foreach ( $this->shortcodes as $shortcode ) {
            add_shortcode( $shortcode['tag'], array($shortcode['component'], $shortcode['callback']) );
        }

        foreach ( $this->actions as $hook ) {
            add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
        }
        
    }
}
