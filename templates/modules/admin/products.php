<?php

/**
 * Категории меню в административной части
 *
 * @param $data
 */
function templateProductsListAdmin($data)
{
	?><?php
}

function templateProductsListCategories($data)
{
	?>
	<div class="adminCategories">
		<h1>Категории</h1>
		<ul>
			<?php foreach($data['categories'] as $category){?>
				<li <?php if($data['categoryId'] == $category['id']) echo 'class="selected"'; ?>>
					<a href="<?=$category['url']?>">
						<?=htmlspecialchars($category['title'])?>
					</a>
				</li>
			<?php }?>
			<li class="add <?php if($data['categoryId'] === '0' ) echo ' selected'; ?>">
				<a href="<?=$data['addUrl']?>">
					Добавить категорию
					<span>+</span>
				</a>
			</li>
		</ul>
	</div>
<?php
}

function templateProductsEditCategory($data)
{
	?><div class="adminCategoryEdit"><?php
	$categoryId = $data['categoryId'];
	$parentId   = $data['parentId'];
	$category   = $data['category'];

	if(!$categoryId)
	{
		?><h1>Добавление категории</h1><?php
	}
	else
	{
		?><h1>Редактирование категории "<?=!empty($category) ? htmlspecialchars($category['title']) : ''?>"</h1><?php
	}
	?>
	<form method="post" action="<?=$data['currentUrl']?>">
		<input type="hidden" name="writemodule" value="admin/products">
		<input type="hidden" name="method" value="editCategory">
		<input type="hidden" name="parentId" value="<?=$parentId?>">
		<input type="hidden" name="categoryId" value="<?=$categoryId?>">
		<div class="textinput">
			<span>Название:</span>
			<input name="title" type="text" value="<?=!empty($category) ? htmlspecialchars($category['title']) : ''?>">
		</div>
		<div class="submit">
			<input type="submit" value="Сохранить">
			<input type="submit" name="delete" value="Удалить">
		</div>
	</form>
	<?php
	?></div><?php
}