<?php

namespace Application\Module\Menu;

use Application\Module\Base;

class Admin extends Base
{
	/**
	 * Меню адинистративной части
	 * @return array
	 */
	public function actionListAdmin()
	{
		$selectedItemName   = explode('/', $this->application->request->getUrl());
		$selectedItemName   = isset($selectedItemName[2]) ? $selectedItemName[2] : '';
		$data = array(
			'items' => array(
				'menu' => array(
					'title' => 'Меню',
					'url'   => $this->application->routing->getUrl('admin/menu'),
				),
				'table' => array(
					'title' => 'Состояние ресторана',
					'url'   => $this->application->routing->getUrl('admin/table'),
				),
				'users' => array(
					'title' => 'Управление пользователями',
					'url'   => $this->application->routing->getUrl('admin/users'),
				),
			)
		);

		if(isset($data['items'][$selectedItemName]))
		{
			$data['items'][$selectedItemName]['selected'] = true;
		}

		return $data;
	}
}