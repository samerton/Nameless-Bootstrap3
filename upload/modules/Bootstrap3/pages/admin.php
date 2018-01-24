<?php
/*
 *	Made by Samerton
 *  https://github.com/samerton
 *  NamelessMC version 2.0.0-pr3
 *
 *  License: MIT
 *
 *  Bootstrap 3 themes for NamelessMC
 */

// Can the user view the AdminCP?
if($user->isLoggedIn()){
	if(!$user->canViewACP()){
		// No
		Redirect::to(URL::build('/'));
		die();
	} else {
		// Check the user has re-authenticated
		if(!$user->isAdmLoggedIn()){
			// They haven't, do so now
			Redirect::to(URL::build('/admin/auth'));
			die();
		}
	}
} else {
	// Not logged in
	Redirect::to(URL::build('/login'));
	die();
}
 
 
$page = 'admin';
$admin_page = 'bootstrap3';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$cache->setCache('bs3_template');
		
		if(isset($_POST['theme'])){
			$cache->store('bootswatch', $_POST['theme']);
		}
		
		if(isset($_POST['navbarType']) && ($_POST['navbarType'] == 'default' || $_POST['navbarType'] == 'inverse')){
			$cache->store('nav_style', $_POST['navbarType']);
		}
		
		Redirect::to(URL::build('/admin/bootstrap3'));
		die();
		
	} else 
		$error = $language->get('admin', 'invalid_token');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<?php 
	$title = $language->get('admin', 'admin_cp');
	require('core/templates/admin_header.php'); 
	?>
  
  </head>
  <body>
    <?php require('modules/Core/pages/admin/navbar.php'); ?>
	<div class="container">
	  <div class="row">
	    <div class="col-md-3">
		  <?php require('modules/Core/pages/admin/sidebar.php'); ?>
		</div>
		<div class="col-md-9">
		  <div class="card">
		    <div class="card-block">
			<h3><?php echo $bootstrap3_language->get('language', 'bootstrap3_title'); ?></h3>
			<hr />
			<?php
			$cache->setCache('bs3_template');
			if($cache->isCached('bootswatch')){
				$selected_theme = $cache->retrieve('bootswatch');
			} else {
				$selected_theme = 'default';
				$cache->store('bootswatch', 'default');
			}

			if($cache->isCached('nav_style')){
				$nav_style = $cache->retrieve('nav_style');
			} else {
				$nav_style = 'default';
				$cache->store('nav_style', 'default');
			}
			?>
			<form action="" method="post">
			  <div class="form-group">
			    <label for="inputTheme"><?php echo $bootstrap3_language->get('language', 'theme'); ?></label>
				<select name="theme" class="form-control" id="inputTheme">
				  <option value="default"<?php if($selected_theme == 'default') echo ' selected'; ?>>Default</option>
				  <option value="cerulean"<?php if($selected_theme == 'cerulean') echo ' selected'; ?>>Cerulean</option>
				  <option value="cosmo"<?php if($selected_theme == 'cosmo') echo ' selected'; ?>>Cosmo</option>
				  <option value="cyborg"<?php if($selected_theme == 'cyborg') echo ' selected'; ?>>Cyborg</option>
				  <option value="darkly"<?php if($selected_theme == 'darkly') echo ' selected'; ?>>Darkly</option>
				  <option value="flatly"<?php if($selected_theme == 'flatly') echo ' selected'; ?>>Flatly</option>
				  <option value="journal"<?php if($selected_theme == 'journal') echo ' selected'; ?>>Journal</option>
				  <option value="lumen"<?php if($selected_theme == 'lumen') echo ' selected'; ?>>Lumen</option>
				  <option value="paper"<?php if($selected_theme == 'paper') echo ' selected'; ?>>Paper</option>
				  <option value="readable"<?php if($selected_theme == 'readable') echo ' selected'; ?>>Readable</option>
				  <option value="sandstone"<?php if($selected_theme == 'sandstone') echo ' selected'; ?>>Sandstone</option>
				  <option value="simplex"<?php if($selected_theme == 'simplex') echo ' selected'; ?>>Simplex</option>
				  <option value="slate"<?php if($selected_theme == 'slate') echo ' selected'; ?>>Slate</option>
				  <option value="spacelab"<?php if($selected_theme == 'spacelab') echo ' selected'; ?>>Spacelab</option>
				  <option value="superhero"<?php if($selected_theme == 'superhero') echo ' selected'; ?>>Superhero</option>
				  <option value="united"<?php if($selected_theme == 'united') echo ' selected'; ?>>United</option>
				  <option value="yeti"<?php if($selected_theme == 'yeti') echo ' selected'; ?>>Yeti</option>
				</select>
			  </div>
			  <div class="form-group">
			    <label for="inputNavbarType"><?php echo $bootstrap3_language->get('language', 'navbar_style'); ?></label>
				<select name="navbarType" class="form-control" id="inputNavbarType">
				  <option value="default"<?php if($nav_style == 'default') echo ' selected'; ?>>Default</option>
				  <option value="inverse"<?php if($nav_style == 'inverse') echo ' selected'; ?>>Inverse</option>
				</select>
			  </div>
			  <div class="form-group">
			    <input type="hidden" name="token" value="<?php echo Token::get(); ?>">
				<input type="submit" class="btn btn-primary" value="<?php echo $language->get('general', 'submit'); ?>">
			  </div>
			</form>
		    </div>
		  </div>
		</div>
	  </div>
    </div>
	
	<?php require('modules/Core/pages/admin/footer.php'); ?>

    <?php require('modules/Core/pages/admin/scripts.php'); ?>
	
  </body>
</html>