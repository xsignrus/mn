<?php
namespace Application\Component\Request;

use Application\Component\Base;

class Web extends Base
{
	private $url;

	protected function initialize()
	{
		parent::initialize();
		$this->url  = $_SERVER['REQUEST_URI'];
	}

	public function redirect($url,$httpCode = 301)
	{
		header('Location: '. $url, true, $httpCode);
		return;
	}

	public function getUrl()
	{
		return $this->url;
	}
}