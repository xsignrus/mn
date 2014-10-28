<?php
namespace Application\Component\View;
use Application\Component\Base;

class Web extends Base
{
	private $layout;
	public function setLayout($layoutName)
	{
		$this->layout = $layoutName;
	}

	private function getLayoutFileName()
	{
		return $this->application->configuration->getRootPath() . 'templates/layouts/' . $this->layout . '.php';
	}

	public function render(array $modulesData)
	{
		$application = $this->application;
		extract(
			array(
				$modulesData,
				$application
			)
		);

		require $this->getLayoutFileName();
	}
}