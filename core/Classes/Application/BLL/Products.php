<?php

namespace Application\BLL;
class Products extends BLL
{
	public function update($categoryId, $parentId, $title)
	{
		$this->getDbWeb()->query(
			'INSERT INTO `product_category` (`id`,`parent_id`,`title`) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE title = ?',
			array(
				$categoryId,
				$parentId,
				$title,
				$title
			)
		);
		return $this->getDbWeb()->lastInsertId() ? $this->getDbWeb()->lastInsertId() : $categoryId;
	}

	public function deleteById($categoryId)
	{
		return $this->getDbWeb()->query(
			'DELETE FROM `product_category` WHERE `id` = ?',
			array(
				$categoryId
			)
		);
	}

	public function getById($categoryId)
	{
		return $this->getDbWeb()->selectRow(
			'SELECT * FROM `product_category` WHERE `id` = ?',
			array(
				$categoryId
			)
		);
	}

	public function insert($categoryId, $parentId, $title)
	{
		$this->getDbWeb()->query(
			'INSERT INTO `product_category` (`id`,`parent_id`,`title`) VALUES(?, ?, ?)',
			array(
				$categoryId,
				$parentId,
				$title,
			)
		);
		return $this->getDbWeb()->lastInsertId();
	}

	public function getAllCategories()
	{
		return $this->getDbWeb()->selectAll('SELECT * FROM `product_category`');
	}
}