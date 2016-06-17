<?php

namespace Aicha;
class Capabilities
{
	private $capabilities = array(
		'super_admin'=>array(
			'manage_network',				
			'manage_sites',				
			'manage_network_users',					
			'manage_network_plugins',					
			'manage_network_themes',					
			'manage_network_options'
		),
		'administrators' => array(
			'activate_plugins'				
			'create_users'				
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
			'install_themes'
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
	)
}