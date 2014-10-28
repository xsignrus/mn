<?php
namespace Application\BLL;

use Application\Web;

abstract class BLL
{
	private $className;

	/**
	 * @var Web
	 */
	protected $application;

	public function setClassName($className)
	{
		$this->className = $className;
	}

	function __construct(Web $application)
	{
		$this->application = $application;
	}

	protected function getDbWeb()
	{
		return $this->application->db->web;
	}

}