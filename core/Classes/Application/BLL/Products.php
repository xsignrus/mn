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

	public function deleteProduct($productId)
	{
		return $this->getDbWeb()->query('DELETE FROM `product` WHERE `id` = ?', array($productId));
	}

	public function insertProduct(array $data)
	{

		$this->getDbWeb()->query(
			'INSERT INTO `product` SET
				`id`=?,
				`category_id`=?,
				`title`=?,
				`description`=?,
				`weight`=?,
				`weight_type`=?,
				`price`=?
				ON DUPLICATE KEY UPDATE
				`id`=?,
				`category_id`=?,
				`title`=?,
				`description`=?,
				`weight`=?,
				`weight_type`=?,
				`price`=?
				',
				array_merge(array_values($data), array_values($data))
		);
		return $this->getDbWeb()->lastInsertId();
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

	public function getCategoryProducts($categoryId)
	{
		return $this->getDbWeb()->selectAll(
			'SELECT * FROM `product` WHERE `category_id` = ? ORDER BY `id`',
			array(
				$categoryId
			)
		);
	}

	public function getCategoryById($categoryId)
	{
		return $this->getDbWeb()->selectRow(
			'SELECT * FROM `product_category` WHERE `id` = ?',
			array(
				$categoryId
			)
		);
	}

	public function getProductById($categoryId)
	{
		return $this->getDbWeb()->selectRow(
			'SELECT * FROM `product` WHERE `id` = ?',
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