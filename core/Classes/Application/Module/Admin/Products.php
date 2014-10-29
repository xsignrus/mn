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

	public function actionListCategories()
	{
		$categories = $this->application->bll->products->getAllCategories();
		foreach($categories as &$category)
		{
			$category['url'] = $this->application->routing->getUrl('admin/menu/edit?categoryId=' . $category['id']);
		}
		unset($category);
		$data['categories'] = $categories;
		$data['categoryId']  = $this->application->request->getQueryParam('categoryId', 0);
		$data['addUrl'] = $this->application->routing->getUrl('admin/menu/edit?categoryId=0');
		return $data;
	}

	public function actionEditCategory()
	{
		$categoryId     = $this->application->request->getQueryParam('categoryId');
		$parentId       = $this->application->request->getQueryParam('parentId', 0);
		$category       = $this->application->bll->products->getById($categoryId);

		$data = array(
			'categoryId'    => $categoryId,
			'parentId'      => $parentId,
			'category'      => $category
		);
		return $data;
	}
}