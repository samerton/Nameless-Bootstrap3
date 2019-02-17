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

class Bootstrap3_Module extends Module {
	private $_language;

	public function __construct($pages, $language){
		$name = 'Bootstrap3';
		$author = '<a href="https://samerton.me" target="_blank" rel="nofollow noopener">Samerton</a>';
		$module_version = '1.2.0';
		$nameless_version = '2.0.0-pr5';

		$this->_language = $language;

		parent::__construct($this, $name, $author, $module_version, $nameless_version);

		// Define URLs which belong to this module
		$pages->add('Bootstrap3', '/panel/bootstrap3', 'pages/panel.php');
	}

	public function onInstall(){
		// Not necessary
	}

	public function onUninstall(){
		// Not necessary
	}

	public function onEnable(){
		// Not necessary
	}

	public function onDisable(){
		// Not necessary
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template){
		if(defined('BACK_END')){
			if($user->hasPermission('admincp.styles.templates')){
				$cache->setCache('panel_sidebar');
				if(!$cache->isCached('bootstrap3_order')){
					$order = 50;
					$cache->store('bootstrap3_order', 50);
				} else {
					$order = $cache->retrieve('bootstrap3_order');
				}

				if(!$cache->isCached('bootstrap3_icon')){
					$icon = '<i class="nav-icon fas fa-paint-brush"></i>';
					$cache->store('bootstrap3_icon', $icon);
				} else
					$icon = $cache->retrieve('bootstrap3_icon');

				$navs[2]->add('bootstrap3_divider', mb_strtoupper($this->_language->get('language', 'bootstrap3_title')), 'divider', 'top', null, $order, '');
				$navs[2]->add('bootstrap3', $this->_language->get('language', 'bootstrap3_title'), URL::build('/panel/bootstrap3'), 'top', null, ($order + 0.1), $icon);
			}
		}
	}
}