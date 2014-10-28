<?php

return array(
	'map'  => array(
		''      => 'index',
		/**
		 * управление системой - интерфейс ответственного за работус системой
		 * в ресторане
		 */
		'admin'  => array(
			''  => 'admin',
			/**
			 * Управление пользователями с точки зрения администратора ресторана -
			 * управление аккаунтами менеджеров, официантов
			 */
			'users' => array(
				''  => 'admin/users',
				/**
				 * Управление отдельным пользователем системы
				 */
				'%d'    => array(
					''  => 'admin/clients/client'
				)

			),
			/**
			 * Управление клиентами ресторана
			 */
			'clients'   => array(
				''      => 'admin/clients',
				/**
				 * Просмотр сведений об отдельном клиенте
				 */
				'%d'    => array(
					''  => 'admin/clients/client'
				)
			),
			/**
			 * Просмотр состояния системы
			 */
			'table'    => array(
				''  => 'admin/table'
			),
			/**
			 * Управление меню
			 */
			'menu'  => array(
				''  => 'admin/menu'
			)
		),

	),
	'pages' => array(
		'admin' => array(
			'layout'    => 'admin',
			'title'     => 'Администрирование',
			'blocks'    => array(
				'header'   => array(
					array(
						'className' => '\Application\Module\Menu\Admin',
						'action'    => 'list',
						'mode'      => 'main'
					)
				)
			)
		),
	)
);