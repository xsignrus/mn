<?php
namespace Application\Module\Admin;

use Application\Module\Base;

class Products extends Base
{
	public function doEditCategory()
	{
		$categoryId     = $this->application->request->getPostParam('categoryId', 0);
		$parentId       = $this->application->request->getPostParam('parentId', 0);
		$title          = $this->application->request->getPostParam('title', '');
		if(!trim($title))
		{
			throw new \Exception('too small title');
		}
		$delete         = $this->application->request->getPostParam('delete', 0);

		if($delete)
		{
			$this->application->bll->products->deleteById($categoryId);
			$this->application->request->redirect($this->application->routing->getUrl('admin/menu/'));
			return;
		}

		if(!$categoryId)
		{
			$categoryId = $this->application->bll->products->insert(
				$categoryId,
				$parentId,
				$title
			);
		}
		else
		{
			$categoryId = $this->application->bll->products->update(
				$categoryId,
				$parentId,
				$title
			);
		}

		$this->application->request->redirect($this->application->routing->getUrl('admin/menu/edit?categoryId=' . $categoryId));
	}

	public function actionListAdmin()
	{
		$categories = $this->application->bll->products->getAllCategories();
		$data = array(
			'categories' => $categories
		);
		return $data;
	}

	public function doEditProduct()
	{
		$categoryId = $this->application->request->getPostParam('categoryId');
		$productId  = $this->application->request->getPostParam('productId');
		$delete     = $this->application->request->getPostParam('delete', 0);

		if($delete)
		{
			$this->application->bll->products->deleteProduct($productId);
			$this->application->request->redirect($this->application->routing->getUrl('admin/menu/edit?categoryId=' . $categoryId));
			return;
		}

		$productData = array(
			'id'            => $productId,
			'categoryId'    => $categoryId,
			'title'         => $this->application->request->getPostParam('title'),
			'description'   => $this->application->request->getPostParam('description'),
			'weight'        => $this->application->request->getPostParam('weight'),
			'weight_type'   => $this->application->request->getPostParam('weight_type'),
			'price'         => $this->application->request->getPostParam('price'),
		);
		$productId  = $this->application->bll->products->insertProduct($productData);
		$this->application->request->redirect($this->application->routing->getUrl('admin/menu/products/edit?categoryId=' . $categoryId .'&productId=' . $productId));
	}

	public function actionListCategoryProducts()
	{
		$categoryId     = $this->application->request->getQueryParam('categoryId');
		$category       = $this->application->bll->products->getCategoryById($categoryId);
		$products       = $this->application->bll->products->getCategoryProducts($categoryId);

		foreach($products as &$product)
		{
			$product['editUrl']         = $this->application->routing->getUrl('admin/menu/products/edit?categoryId=' . $categoryId .'&productId=' . $product['id']);
			$product['deleteUrl']       = '#';
			$product['price_compiled']  = sprintf('%2.2f', $product['price']) . ' руб.';
			$product['weight_compiled'] = sprintf('%d', $product['weight']) . ' гр.';
		}
		unset($product);

		$data = array(
			'categoryId'    => $categoryId,
			'category'      => $category,
			'products'      => $products,
			'addUrl'        => $this->application->routing->getUrl('admin/menu/products/edit?categoryId=' . $categoryId .'&productId=0')
		);
		return $data;
	}

	public function actionListCategories()
	{
		$categories = $this->application->bll->products->getAllCategories();
		foreach($categories as &$category)
		{
			$category['url'] = $this->application->routing->getUrl('admin/menu/edit?categoryId=' . $category['id']);
		}
		unset($category);
		$data['categories']     = $categories;
		$data['categoryId']     = $this->application->request->getQueryParam('categoryId', 0);
		$data['addUrl']         = $this->application->routing->getUrl('admin/menu/edit?categoryId=0');
		return $data;
	}

	public function actionEditProduct()
	{
		$categoryId     = $this->application->request->getQueryParam('categoryId');
		$productId      = $this->application->request->getQueryParam('productId');
		$category       = $this->application->bll->products->getCategoryById($categoryId);
		$product        = $this->application->bll->products->getProductById($productId);

		$data = array(
			'categoryId'    => $categoryId,
			'category'      => $category,
			'product'       => $product
		);
		return $data;
	}


	public function actionEditCategory()
	{
		$categoryId     = $this->application->request->getQueryParam('categoryId');
		$parentId       = $this->application->request->getQueryParam('parentId', 0);
		$category       = $this->application->bll->products->getCategoryById($categoryId);

		$data = array(
			'categoryId'    => $categoryId,
			'parentId'      => $parentId,
			'category'      => $category,
		);
		return $data;
	}
}