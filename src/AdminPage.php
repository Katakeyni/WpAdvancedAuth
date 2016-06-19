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
	public function show_panel(){
		$roles = $this->get_roles();
		$capabilities = Capabilities::$capabilities;
		$caps = $this->flatten($capabilities);
		$users = get_users( 'blog_id=1&orderby=nicename' );
?>
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab tab-item col s6"><a href="#test1">Utilisateurs</a></li>
        <li class="tab tab-item col s6"><a class="active" href="#groupes"> Groupes</a></li>
      </ul>
    </div>
    <div id="test1" class="col  s12">
    	<div class="tab-content-item row"> 
    		<?php foreach($users as $user) {
    			?>
    				<div class="col s3">
    					<?php $url = menu_page_url( "gestion-advanced-user", false )."&user_id=".$user->ID; ?>
    					<a class="user-item" href="<?php echo $url ?>">

    					<div><?php echo get_avatar($user->ID, 128); ?></div>
    						<?php echo $user->display_name ?>
    					</a>
    				</div>
    		<?php } ?>	
    	</div>
    </div>
    <div id="groupes" class="col  s12">
    	<div class="tab-content-item row">
	    	<div class="col s4">
	    		<h4>Liste des groupes</h4>
	    		<ul class="groupes-list">
		    		<?php foreach($roles as $role) {
		    			?>
		    			<li> <?php echo $role;?>	
		    				<div class="btn btn-small red-text btn-flat right"> 
		    					<i class="fa fa-trash"></i>
		    				</div>
		    			</li>

		    		<?php } ?>	    			
	    		</ul>

	    	</div>
	    	<div class="col s8">
	    		<h4> Ajout d'un nouveau groupe</h4>
	    		<div class="form">
		          <form class="col s12" id="form_create_group">
		            <div class="row">
		              <div class="input-field col s12">
		                <input id="name" type="text" name="name" class="validate" required>
		                <label for="name">Nom du Groupe</label>
		              </div>
		              <div class="col s12" id="capabilities-list">
						<div class="row caplist-container">
			              	<div class="capibility-title">Super Administrateur</div>
				    		<?php foreach($capabilities['super_admin'] as $cap) {?>
				    			<div class="col s6">
				    				<input type="checkbox"   name="capabilities[]" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>
						</div>	
						<div class="row caplist-container">
			              	<div class="capibility-title">Administrator</div>
				    		<?php foreach($capabilities['administrator'] as $cap) {?>
				    			<div class="col s6">
				    				<input type="checkbox"  name="capabilities[]"  id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>
						<div class="row caplist-container">
			              	<div class="capibility-title">Editeur</div>
				    		<?php foreach($capabilities['editor'] as $cap) {?>
				    			<div class="col s6">
				    				<input type="checkbox"  name="capabilities[]"  id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title">Auteur</div>
				    		<?php foreach($capabilities['author'] as $cap) {?>
				    			<div class="col s6">
				    				<input type="checkbox"  name="capabilities[]" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>" class="filled-in" > 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title">Contributeur</div>
				    		<?php foreach($capabilities['contributor'] as $cap) {?>
				    			<div class="col s6">
				    				<input type="checkbox" name="capabilities[]"  id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title"> Subscriber </div>
				    		<?php foreach($capabilities['subscriber'] as $cap) {?>
				    			<div class="col s6">
				    				<input type="checkbox"  name="capabilities[]" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>
		              </div>

		            </div>
		            <button type="submit" class="btn btn-primary"> Enregistrer</button>
		          </form>
	    		</div>
	    	</div>
    	</div>
    </div>
  </div>
<?php		
	}
	public function show_user_edit(){
		$id = intval($_GET['user_id']);
		$user = get_user_by("ID", $id);
		$user_info = get_userdata($id);
		$roles = $this->get_roles();
		$capabilities = Capabilities::$capabilities;
		$caps = $this->flatten($capabilities);

		?>
		<div class="row">
			<div class="col s2">
				<div class="user-avatar"><?php echo get_avatar($user->ID, 512); ?></div>
			</div>
			<div class="col s3">

				<div class="userinfo-display"> 
					<span class="user-detail-title"> Fisrt Name: </span> 
					<?php echo $user->first_name ?> 
				</div>
				<div class="userinfo-display"> 
					<span class="user-detail-title"> Last Name: </span>
					<?php echo $user->last_name ?> 
				</div>
				<div class="userinfo-display"> 
					<span class="user-detail-title"> Display Name: </span>
					<?php echo $user->display_name ?> 
				</div>
				<div class="userinfo-display"> 
					<span class="user-detail-title"> Email:</span>
					 <?php echo $user->user_email ?> 
				 </div>
			</div>
			<div class="col s7">
				<h4>Roles</h4>
	    		<?php foreach($roles as $role) {
						$slug = preg_replace('/\s+/', '_', $role);
						$slug = strtolower($slug);
	    				$checked = $user->has_cap($slug) ? "checked='checked'" : '';
	    			?>
	    			<div class="col s6">
	    				<input type="checkbox"  <?php echo $checked; ?>   name="roles[]" id="<?php echo $role; ?>" value="<?php echo $role; ?>"> 
	    				<label for="<?php echo $role; ?>"> <?php echo $role; ?> </label> 	
	    			</div>
	    		<?php } ?>
			</div>
			<div class="col s12">
				<h4>Capabilities</h4>
		          <form class="col s12" id="form_create_group">
		            <div class="row">
		              <div class="col s12" id="capabilities-list">
						<div class="row caplist-container">
			              	<div class="capibility-title">Super Administrateur</div>
				    		<?php foreach($capabilities['super_admin'] as $cap) {
								$checked = $user->has_cap($cap) ? "checked='checked'" : '';
				    			?>
				    			<div class="col s4">
				    				<input type="checkbox"  <?php echo $checked; ?>    name="capabilities[]" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>
						</div>	

						<div class="row caplist-container">
			              	<div class="capibility-title">Administrator</div>
				    		<?php foreach($capabilities['administrator'] as $cap) {
								$checked = $user->has_cap($cap) ? "checked='checked'" : '';
				    			?>
				    			<div class="col s4">
				    				<input type="checkbox"  <?php echo $checked; ?>   name="capabilities[]"  id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title">Editeur</div>
				    		<?php foreach($capabilities['editor'] as $cap) {
								$checked = $user->has_cap($cap) ? "checked='checked'" : '';
				    			?>
				    			<div class="col s4">
				    				<input type="checkbox"  <?php echo $checked; ?>   name="capabilities[]"  id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title">Auteur</div>
				    		<?php foreach($capabilities['author'] as $cap) {
								$checked = $user->has_cap($cap) ? "checked='checked'" : '';
				    			?>
				    			<div class="col s4">
				    				<input type="checkbox"  <?php echo $checked; ?>   name="capabilities[]" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>" class="filled-in" > 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title">Contributeur</div>
				    		<?php foreach($capabilities['contributor'] as $cap) {
								$checked = $user->has_cap($cap) ? "checked='checked'" : '';
				    			?>
				    			<div class="col s4">
				    				<input type="checkbox"  <?php echo $checked; ?>  name="capabilities[]"  id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>

						<div class="row caplist-container">
			              	<div class="capibility-title"> Subscriber </div>
				    		<?php foreach($capabilities['subscriber'] as $cap) {
								$checked = $user->has_cap($cap) ? "checked='checked'" : '';
				    			?>
				    			<div class="col s4">
				    				<input type="checkbox"  <?php echo $checked; ?>   name="capabilities[]" id="<?php echo $cap; ?>" value="<?php echo $cap; ?>"> 
				    				<label for="<?php echo $cap; ?>"> <?php echo $cap; ?> </label> 	
				    			</div>
				    		<?php } ?>	
						</div>
		              </div>

		            </div>
		            <button type="submit" class="btn btn-primary"> Enregistrer</button>
		          </form>
	    		</div>
			</div>
		</div>
		<?php 
	}
	public function show(){
		if(!isset($_GET['user_id'])){

			echo "<div class='editing_user container z-depth-2	' >";
			$this->show_panel();
			echo "</div>";
		}else{
			echo "<div class='editing_user container z-depth-2	' >";
			$this->show_user_edit();
			echo "</div>";

		}
	}

}