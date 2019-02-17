<?php
/*
 *	Made by Samerton
 *  https://github.com/NamelessMC/Nameless/
 *  NamelessMC version 2.0.0-pr5
 *
 *  License: MIT
 *
 *  Panel Bootstrap 3 page
 */

// Can the user view the panel?
if($user->isLoggedIn()){
	if(!$user->canViewACP()){
		// No
		Redirect::to(URL::build('/'));
		die();
	}
	if(!$user->isAdmLoggedIn()){
		// Needs to authenticate
		Redirect::to(URL::build('/panel/auth'));
		die();
	} else {
		if(!$user->hasPermission('admincp.styles.templates')){
			require_once(ROOT_PATH . '/404.php');
			die();
		}
	}
} else {
	// Not logged in
	Redirect::to(URL::build('/login'));
	die();
}

define('PAGE', 'panel');
define('PARENT_PAGE', 'bootstrap3');
define('PANEL_PAGE', 'bootstrap3');
$page_title = $bootstrap3_language->get('language', 'bootstrap3_title');
require_once(ROOT_PATH . '/core/templates/backend_init.php');

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$cache->setCache('bs3_template');

		if(isset($_POST['theme'])){
			$cache->store('bootswatch', $_POST['theme']);
		}

		if(isset($_POST['navbarType']) && ($_POST['navbarType'] == 'default' || $_POST['navbarType'] == 'inverse')){
			$cache->store('nav_style', $_POST['navbarType']);
		}

		Redirect::to(URL::build('/panel/bootstrap3'));
		die();

	} else
		$error = $language->get('admin', 'invalid_token');
}

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, array($navigation, $cc_nav, $mod_nav), $widgets);

if(isset($success))
	$smarty->assign(array(
		'SUCCESS' => $success,
		'SUCCESS_TITLE' => $language->get('general', 'success')
	));

if(isset($errors) && count($errors))
	$smarty->assign(array(
		'ERRORS' => $errors,
		'ERRORS_TITLE' => $language->get('general', 'error')
	));

// Get values
$cache->setCache('bs3_template');
if($cache->isCached('bootswatch')){
	$selected_theme = $cache->retrieve('bootswatch');
} else {
	$selected_theme = 'default';
	$selected_theme->store('bootswatch', 'default');
}

if($cache->isCached('nav_style')){
	$nav_style = $cache->retrieve('nav_style');
} else {
	$nav_style = 'default';
	$cache->store('nav_style', 'default');
}

$themes = array(
	0 => array(
		'value' => 'bootstrap',
		'name' => 'Default',
		'selected' => ($selected_theme == 'bootstrap')
	),
	1 => array(
		'value' => 'cerulean',
		'name' => 'Cerulean',
		'selected' => ($selected_theme == 'cerulean')
	),
	2 => array(
		'value' => 'cosmo',
		'name' => 'Cosmo',
		'selected' => ($selected_theme == 'cosmo')
	),
	3 => array(
		'value' => 'cyborg',
		'name' => 'Cyborg',
		'selected' => ($selected_theme == 'cyborg')
	),
	4 => array(
		'value' => 'darkly',
		'name' => 'Darkly',
		'selected' => ($selected_theme == 'darkly')
	),
	5 => array(
		'value' => 'flatly',
		'name' => 'Flatly',
		'selected' => ($selected_theme == 'flatly')
	),
	6 => array(
		'value' => 'journal',
		'name' => 'Journal',
		'selected' => ($selected_theme == 'journal')
	),
	7 => array(
		'value' => 'lumen',
		'name' => 'Lumen',
		'selected' => ($selected_theme == 'lumen')
	),
	8 => array(
		'value' => 'paper',
		'name' => 'Paper',
		'selected' => ($selected_theme == 'paper')
	),
	9 => array(
		'value' => 'readable',
		'name' => 'Readable',
		'selected' => ($selected_theme == 'readable')
	),
	10 => array(
		'value' => 'sandstone',
		'name' => 'Sandstone',
		'selected' => ($selected_theme == 'sandstone')
	),
	11 => array(
		'value' => 'simplex',
		'name' => 'Simplex',
		'selected' => ($selected_theme == 'simplex')
	),
	12 => array(
		'value' => 'slate',
		'name' => 'Slate',
		'selected' => ($selected_theme == 'slate')
	),
	13 => array(
		'value' => 'spacelab',
		'name' => 'Spacelab',
		'selected' => ($selected_theme == 'spacelab')
	),
	14 => array(
		'value' => 'superhero',
		'name' => 'Superhero',
		'selected' => ($selected_theme == 'superhero')
	),
	15 => array(
		'value' => 'united',
		'name' => 'United',
		'selected' => ($selected_theme == 'united')
	),
	16 => array(
		'value' => 'yeti',
		'name' => 'Yeti',
		'selected' => ($selected_theme == 'yeti')
	)
);

$nav_styles = array(
	0 => array(
		'value' => 'default',
		'name' => 'Default',
		'selected' => ($nav_style == 'default')
	),
	1 => array(
		'value' => 'inverse',
		'name' => 'Inverse',
		'selected' => ($nav_style == 'inverse')
	)
);

$smarty->assign(array(
	'PARENT_PAGE' => PARENT_PAGE,
	'DASHBOARD' => $language->get('admin', 'dashboard'),
	'BOOTSTRAP_3_THEME' => $bootstrap3_language->get('language', 'bootstrap3_title'),
	'PAGE' => PANEL_PAGE,
	'TOKEN' => Token::get(),
	'SUBMIT' => $language->get('general', 'submit'),
	'THEME' => $bootstrap3_language->get('language', 'theme'),
	'THEMES' => $themes,
	'NAVBAR_STYLE' => $bootstrap3_language->get('language', 'navbar_style'),
	'NAVBAR_STYLES' => $nav_styles
));

$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/panel_navbar.php');

// Display template
$template->displayTemplate('bootstrap3/index.tpl', $smarty);