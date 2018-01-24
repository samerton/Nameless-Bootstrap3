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

// Custom language
$bootstrap3_language = new Language(ROOT_PATH . '/modules/Bootstrap3/language');

// Define URLs which belong to this module
$pages->add('Bootstrap3', '/admin/bootstrap3', 'pages/admin.php');

// Add link to admin sidebar
if(!isset($admin_sidebar)) $admin_sidebar = array();
$admin_sidebar['bootstrap3'] = array(
	'title' => $bootstrap3_language->get('language', 'bootstrap3_title'),
	'url' => URL::build('/admin/bootstrap3')
);