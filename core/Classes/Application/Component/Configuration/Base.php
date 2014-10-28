<?php

namespace Application\Component\Configuration;

class Base extends \Application\Component\Base
{
	private $configuration;

	/**
	 * @param array $configuration
	 */
	public function setConfiguration(array $configuration)
	{
		$this->configuration = $configuration;
	}

	/**
	 * @param $pageKey
	 * @return array
	 * @throws \Exception
	 */
	public function getPageConfiguration($pageKey)
	{
		if(!isset($this->configuration['routing']['pages'][$pageKey]))
		{
			throw new \Exception('Cant find configuration for page: ' . $pageKey);
		}
		return $this->configuration['routing']['pages'][$pageKey];
	}

	/**
	 * @return array
	 */
	public function getRoutingMap()
	{
		return $this->configuration['routing']['map'];
	}

	/**
	 * @param $componentName
	 * @return array
	 * @throws \Exception
	 */
	public function getComponentConfiguration($componentName)
	{
		if(!isset($this->configuration['components'][$componentName]))
		{
			throw new \Exception('Cant find configuration for component: ' . $componentName);
		}
		return $this->configuration['components'][$componentName];
	}
}