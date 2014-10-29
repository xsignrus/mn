<?php
namespace Application\Component\Routing;
use Application\Component\Base;

class UrlManager extends Base
{
	private function getProductImagePathPrefix($productId, $categoryId, $timeStamp)
	{
		return  $categoryId . DIRECTORY_SEPARATOR . ($productId % 100) . DIRECTORY_SEPARATOR . ($timeStamp % 100) . DIRECTORY_SEPARATOR . $timeStamp;
	}

	public function getProductImagePath($productId, $categoryId, $timeStamp, $sizeName)
	{
		$prefix =$this->application->configuration->getRootPath() . 'data/static/upload/' . $this->getProductImagePathPrefix($productId, $categoryId, $timeStamp);
		return $prefix . $sizeName . '.jpg';
	}
}