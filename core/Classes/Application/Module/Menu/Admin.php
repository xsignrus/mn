<?php

namespace Application\Module\Menu;

use Application\Module\Base;

class Admin extends Base
{
	/**
	 * Меню адинистративной части
	 * @return array
	 */
	public function actionListMain()
	{
		return array(
			'items' => array(
				'menu' => array(
					'name' => 'Меню',
				),
				'table' => array(
					'name' => 'Состояние ресторана',
				),
				'users' => array(
					'name' => 'Управление пользователями',
				),
			)
		);
	}
}