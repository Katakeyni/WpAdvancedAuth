<?php

namespace Aicha;

class AdminPage
{
	public function __construct(){

	}
	function get_roles() {

	    $wp_roles = new \WP_Roles();
	    $roles = $wp_roles->get_names();
	    $roles = array_map( 'translate_user_role', $roles );

	    return $roles;
	}

	public function flatten($array){
		$flatten_array = [];
		$iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));
		foreach($iterator as $item) {
		   $flatten_array[] = $item;
		}
		return $flatten_array;
	}

	public function show(){
		$roles = $this->get_roles();
		$capabilities = Capabilities::$capabilities;
		$caps = $this->flatten($capabilities);
?>
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab tab-item col s6"><a href="#test1">Utilisateurs</a></li>
        <li class="tab tab-item col s6"><a class="active" href="#groupes"> Groupes</a></li>
      </ul>
    </div>
    <div id="test1" class="col  s12">
    	<div class="tab-content-item row"> test</div>
    </div>
    <div id="groupes" class="col  s12">
    	<div class="tab-content-item row">
	    	<div class="col s4">
	    		<h4>Liste des groupes</h4>
	    		<ul class="groupes-list">
		    		<?php foreach($roles as $role) {?>

		    			<li> <?php echo $role; ?>	</li>

		    		<?php } ?>	    			
	    		</ul>

	    	</div>
	    	<div class="col s8">
	    		<h4> Ajout d'un nouveau groupe</h4>
	    		<div class="form">
		          <form class="col s12" id="form_subscribe_in_community">
		            <div class="row">
		              <div class="input-field col s12">
		                <input id="name" type="text" name="name" class="validate" required>
		                <label for="name">Nom du Groupe</label>
		              </div>
		              <div class="col s12" id="capabilities-list">
						<div class="row caplist-container">
			              	<div class="capibility-title">Super Administrateur</div>
				    		<?php foreach($capabilities['super_admin'] as $cap) {?>
				    			<div class="col s4">
				    				<input type="checkbox" id="<?php echo $cap; ?>"> value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>
						</div>	
						<div class="row caplist-container">
			              	<div class="capibility-title">Editeur</div>
				    		<?php foreach($capabilities['editor'] as $cap) {?>
				    			<div class="col s4">
				    				<input type="checkbox" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title">Auteur</div>
				    		<?php foreach($capabilities['author'] as $cap) {?>
				    			<div class="col s4">
				    				<input type="checkbox" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>" class="filled-in" > 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title">Contributeur</div>
				    		<?php foreach($capabilities['contributor'] as $cap) {?>
				    			<div class="col s4">
				    				<input type="checkbox" id="<?php echo $cap; ?>"> value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title"> Subscriber </div>
				    		<?php foreach($capabilities['subscriber'] as $cap) {?>
				    			<div class="col s4">
				    				<input type="checkbox" id="<?php echo $cap; ?>"> value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>
		              </div>

		            </div>
		            <div class="btn btn-primary"> Enregistrer</div>
		          </form>
	    		</div>
	    	</div>
    	</div>
    </div>
  </div>
<?php
	}

}