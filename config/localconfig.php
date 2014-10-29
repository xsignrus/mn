<?php
return array(
	'rootPath'      => '/home/sites/memenu.ru/',
	'autoload'      => array(
		'directories'   => array(
			'core',
			'core/Classes'
		)
	),
	'db' => array(
		'web' => array(
			'dsn'       => 'mysql:dbname=memenu_example;host=127.0.0.1',
			'username'  => 'root',
			'password'  => '2912',
		),
		'root' => array(
			'dsn'       => 'mysql:dbname=memenu;host=127.0.0.1',
			'username'  => 'root',
			'password'  => '2912',
		),
	),
	'components'    => require_once 'components.php',
	'bll'           => require_once 'bll.php',
	'routing'       => require_once 'routing.php'
);