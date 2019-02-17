<?php 
/*
 *	Made by Samerton
 *  https://github.com/samerton
 *  NamelessMC version 2.0.0-pr5
 *
 *  License: MIT
 *
 *  Bootstrap 3 themes for NamelessMC
 */

// Custom language
$bootstrap3_language = new Language(ROOT_PATH . '/modules/Bootstrap3/language');

require_once(ROOT_PATH . '/modules/Bootstrap3/module.php');
$module = new Bootstrap3_Module($pages, $bootstrap3_language);