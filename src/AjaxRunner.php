<?php

namespace Aicha;

class AjaxRunner
{
	public function __construct(){}
	public function setCapabilities($caps){
		$results = array_map(function($c){
			return array($c => true);
		}, $caps);
		return $results;
	}
	public function create_new_groupe_action(){
		if(isset($_POST['name']))
		{
			$name = $_POST['name'];
			$capabilities = $_POST['capabilities'];
			$caps = $this->setCapabilities($capabilities);
			$slug = preg_replace('/\s+/', '_', $name);
			$slug = strtolower($slug);
			$result = add_role($slug, $name, $caps );
			$message =  (null !== $result ) ? array("code"=>0, "message"=>'Yay! New role created!') : array("code"=>0, "message"=>'Oh... '.$name.' role already exists.');
			echo json_encode($message);	
			 wp_die(); 		
		}

	}
}