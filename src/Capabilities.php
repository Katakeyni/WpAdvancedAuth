<?php

namespace Aicha;
class Capabilities
{
	public static $capabilities = array(
		'super_admin'=>array(
			'manage_network',				
			'manage_sites',				
			'manage_network_users',					
			'manage_network_plugins',					
			'manage_network_themes',					
			'manage_network_options'
		),
		'administrator' => array(
			'activate_plugins',				
			'create_users',				
			'delete_plugins',				
			'delete_themes',				
			'delete_users',				
			'edit_files',				
			'edit_plugins',				
			'edit_theme_options',			
			'edit_themes',				
			'edit_users',				
			'export',			
			'import',
			'install_plugins',
			'install_themes',
			'list_users',
			'manage_options',
			'promote_users',
			'remove_users',
			'switch_themes',
			'update_core',
			'update_plugins',
			'update_themes',
			'edit_dashboard'
		),
		"editor" => array(
			"moderate_comments",
			"manage_categories",			
			"manage_links",		
			"edit_others_posts",			
			"edit_pages",			
			"edit_others_pages",	
			"edit_published_pages",		
			"publish_pages",		
			"delete_pages",	
			"delete_others_pages",		
			"delete_published_pages",		
			"delete_others_posts",			
			"delete_private_posts",		
			"edit_private_posts",		
			"read_private_posts",
			"delete_private_pages",
			"edit_private_pages",
			"read_private_pages",	
			"unfiltered_html"
		),
		"author" => array(
			"edit_published_posts",	
			"upload_files",
			"publish_posts",
			"delete_published_posts"
		),
		"contributor" => array(
			"edit_posts",
			"delete_posts"
		),
		"subscriber" => array(
			"read"
		)
	);
}