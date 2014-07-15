<?php
$routeName = 'admin/default';

return array(
	'home' => array('label' => 'Home', 'route' => 'admin', 'iconClass' => 'fa-home', 'id' => 'home'),
	'logo' => array('id' => 'logo','label' => 'Logo', 'route' => $routeName, 'iconClass' => 'fa-picture-o', 'controller' => 'product', 'action' => 'index', 'pages' => array(
		'category' => array( 'id' => 'logo-category', 'label' => 'Logo Category', 'route' => $routeName, 'iconClass' => 'fa-folder-open', 'controller' => 'category', 'action' => 'index', 'pages' => array(
			'new' => array('id' => 'logo-category-new', 'label' => 'New Category', 'route' => $routeName, 'iconClass' => 'fa-plus', 'controller' => 'category', 'action' => 'new'),
		)),
	)),
	'user' => array('id' => 'user',  'label' => 'User Management', 'route' => $routeName, 'iconClass' => 'fa-user', 'controller' => 'user', 'action' => 'index', 'pages' => array(
		'new' => array( 'id' => 'user-new', 'label' => 'New User', 'route' => $routeName, 'iconClass' => 'fa-plus', 'controller' => 'user', 'action' => 'add'),
	)),
);