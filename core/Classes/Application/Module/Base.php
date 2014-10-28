<?php

namespace Application\Module;
use Application\Web;

class Base
{
	private $application;
	function __construct(Web $application)
	{
		$this->application  = $application;
	}
}