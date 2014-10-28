<?php

namespace Application\Component\Controller;

use Application\Component\Base;

class Web extends Base
{
	public function processRequest()
	{
		list($pageKey, $urlVariables) = $this->application->routing->getPageKeyAndVariables($this->application->request->getUrl());

		$pageConfiguration  = $this->application->configuration->getPageConfiguration($pageKey);
	}
}