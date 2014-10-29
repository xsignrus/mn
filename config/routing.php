<?php

$modules = array(
	/**
	 * Меню сайта в разделе администратора
	 */
	'admin_menu' => array(
		'className' => '\Application\Module\Menu\Admin',
		'template'  => 'menu',
		'action'    => 'list',
		'mode'      => 'admin'
	),
	/**
	 * Модуль управления меню ресторана
	 */
	'admin_products'    => array(
		'className' => '\Application\Module\Admin\Products',
		'template'  => 'admin/products',
		'action'    => 'list',
		'mode'      => 'admin'
	),
	/**
	 * Категории меню
	 */
	'admin_products_categories' => array(
		'className' => '\Application\Module\Admin\Products',
		'template'  => 'admin/products',
		'action'    => 'list',
		'mode'      => 'categories'
	),
	/**
	 * Редактирование категории меню
	 */
	'admin_products_category_edit' => array(
		'className' => '\Application\Module\Admin\Products',
		'template'  => 'admin/products',
		'action'    => 'edit',
		'mode'      => 'category'
	),
	/**
	 * Редактирование блюда меню
	 */
	'admin_product_edit' => array(
		'className' => '\Application\Module\Admin\Products',
		'template'  => 'admin/products',
		'action'    => 'edit',
		'mode'      => 'product'
	),
	/**
	 * Список блюд в категории
	 */
	'admin_category_products' => array(
		'className' => '\Application\Module\Admin\Products',
		'template'  => 'admin/products',
		'action'    => 'list',
		'mode'      => 'categoryProducts'
	),
);

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
				''  => 'admin/menu',
				'edit'  => array(
					''  => 'admin/menu/edit',
				),
				'products'  => array(
					'edit'  =>  array(
						''  => 'admin/menu/product/edit',
					)
				),
			)
		),

	),
	'pages' => array(
		/**
		 * Главная страница администрирования
		 */
		'admin' => array(
			'layout'    => 'admin',
			'title'     => 'Администрирование',
			'blocks'    => array(
				'header'   => array(
					$modules['admin_menu']
				)
			)
		),
		/**
		 * Управление меню ресторана
		 */
		'admin/menu' => array(
			'layout'    => 'admin',
			'title'     => 'Управление меню',
			'blocks'    => array(
				'header'   => array(
					$modules['admin_menu']
				),
				'content'   => array(
					$modules['admin_products']
				),
				'sidebar'   => array(
					$modules['admin_products_categories']
				)
			)
		),
		/**
		 * Редактирование категории меню
		 */
		'admin/menu/edit'=> array(
			'layout'    => 'admin',
			'title'     => 'Управление меню',
			'blocks'    => array(
				'header'   => array(
					$modules['admin_menu'],
				),
				'content'   => array(
					$modules['admin_category_products'],
				),
				'sidebar'   => array(
					$modules['admin_products_categories'],
					$modules['admin_products_category_edit']
				)
			)
		),
		/**
		 * Редактирование блюда
		 */
		'admin/menu/product/edit'=> array(
			'layout'    => 'admin',
			'title'     => 'Управление меню',
			'blocks'    => array(
				'header'   => array(
					$modules['admin_menu'],
				),
				'content'   => array(
					$modules['admin_product_edit'],
				),
				'sidebar'   => array(
					$modules['admin_products_categories'],
				)
			)
		),
		/**
		 * Управление пользователями
		 */
		'admin/users' => array(
			'layout'    => 'admin',
			'title'     => 'Управление пользователями',
			'blocks'    => array(
				'header'   => array(
					$modules['admin_menu']
				)
			)
		),
		/**
		 * Управление состоянием системы
		 */
		'admin/table' => array(
			'layout'    => 'admin',
			'title'     => 'Состояние системы',
			'blocks'    => array(
				'header'   => array(
					$modules['admin_menu']
				)
			)
		),
	)
);