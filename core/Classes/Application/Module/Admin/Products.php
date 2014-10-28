<?php
namespace Application\Module\Admin;

use Application\Module\Base;

class Products extends Base
{
	public function actionListCategories()
	{
		$categories = $this->application->bll->products->getAllCategories();
		foreach($categories as &$category)
		{
			$category['url'] = $this->application->routing->getUrl('admin/menu/edit?categoryId=' . $category['id']);
		}
		unset($category);
		return array(
			'categoryId'	=> $this->application->request->getQueryParam('categoryId'),
			'categories' 	=> $categories,
			'addUrl'		=> $this->application->routing->getUrl('admin/menu/edit?categoryId=0')

		);
	}

	public function doEditCategory()
	{
		$categoryId	= $this->application->request->getPostParam('categoryId');
		$title		= $this->application->request->getPostParam('title');
		$parentId	= $this->application->request->getPostParam('parentId');
		$delete		= $this->application->request->getPostParam('delete');
		if(!$delete)
		{
			if($categoryId)
			{
				$this->application->bll->products->update($categoryId, $parentId, $title);
			}
			else
			{
				$this->application->bll->products->insert($categoryId, $parentId, $title);
			}
		}
		else
		{
			$this->application->bll->products->deleteById($categoryId);
			$this->application->request->redirect(
				$this->application->routing->getUrl('admin/menu')
			);
		}
	}

	public function actionListAdmin()
	{

	}

	public function actionEditCategory()
	{
		$category = $this->application->bll->products->getById($this->application->request->getQueryParam('categoryId'));
		return array(
			'categoryId'	=> $this->application->request->getQueryParam('categoryId'),
			'category' 		=> $category,
			'parentId'		=> $category['parent_id'],
			'currentUrl'	=> $this->application->request->getUrl()
		);
	}
}