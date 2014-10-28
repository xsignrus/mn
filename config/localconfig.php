<?php
return array(
	'rootPath'      => '/home/sites/memenu.ru/',
	'autoload'      => array(
		'directories'   => array(
			'core/classes'
		)
	),
	'components'    => require_once 'components.php',
	'routing'       => require_once 'routing.php'
);