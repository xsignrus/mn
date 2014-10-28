<?php

namespace Application\BLL;
class Products extends BLL
{
	public function getAllCategories()
	{
		$categories = $this->getDbWeb()->selectAll('SELECT * FROM `product_category`');
		return array(
			'categories' => $categories,
		);
	}
}