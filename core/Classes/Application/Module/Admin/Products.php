<?php
namespace Application\Module\Admin;

use Application\Module\Base;

class Products extends Base
{
	public function actionListAdmin()
	{
		$categories = $this->application->bll->products->getAllCategories();
	}
}