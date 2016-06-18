<?php

namespace Aicha;

class AssetsInit
{
	public function __construct(){

	}
	public function enqueue_stylesheets($hook){
		global $hook_suffix;
		if($hook_suffix != "toplevel_page_gestion-advanced-user"){
			return;
		}
		wp_register_style( 'style-materialize', plugins_url( 'wp_advanced_auth/css/materialize.min.css' ) );
		wp_register_style( 'style-plugin', plugins_url( 'wp_advanced_auth/css/design.css' ) );
		wp_register_style( 'include-fa-fa', plugins_url( 'wp_advanced_auth/css/font-awesome.min.css' ) );
		wp_enqueue_style( 'style-materialize' );
		wp_enqueue_style( 'style-plugin' );
		wp_enqueue_style( 'include-fa-fa' );
	}
	public function enqueue_scripts(){
		wp_enqueue_script( 'materialize-script', plugins_url( 'wp_advanced_auth/js/materialize.min.js' ), array('jquery') );
		wp_enqueue_script( 'wp_auth_script', plugins_url( 'wp_advanced_auth/js/app.js' ), array('jquery', 'materialize-script') );
	}
}