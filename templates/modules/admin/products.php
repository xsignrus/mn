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
	<form method="post" action="/">
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

function templateProductsListCategoryProducts($data)
{
	$category   = $data['category'];
	if(!$category)
	{
		return;
	}
	?><div class="adminCategoryProductsList"><?php
	?><h1>Продукты категории "<?=htmlspecialchars($category['title'])?>"</h1>
	<ul><?php
	foreach($data['products'] as $product)
	{
		?>
		<li class="product">
		<div class="image"><?php if($product['image']){?>
			<img src="<?=$product['image_url']?>">
		<?php }?>
		</div><div class="data">
			<div class="title">
				<a href="<?=$product['editUrl']?>"><?=htmlspecialchars($product['title'])?></a>
			</div>
			<div class="weight">
				<?=htmlspecialchars($product['weight_compiled'])?>
			</div>
			<div class="price">
				<?=htmlspecialchars($product['price_compiled'])?>
			</div>
		</div><div class="edit">
			<div>
				<a class="icon" href="<?=$product['editUrl']?>">edit</a>
			</div>
			<div>
				<a class="icon delete" href="<?=$product['deleteUrl']?>">del</a>
			</div>
		</div>

		</li><?php
	}
	?>
		<li class="add"><a href="<?=$data['addUrl']?>">Добавить<span>+</span></a></li>
	</ul>
	</div><?php
}

function templateProductsEditProduct($data)
{
	$category   = $data['category'];

	?><div class="adminCategoryProductEdit"><?php
	if($data['product'])
	{
		?><h1><?=htmlspecialchars($category['title'])?> > <?=htmlspecialchars($data['product']['title'])?></h1><?php
	}
	else
	{
		?><h1>Добавить блюдо категории "<?=htmlspecialchars($category['title'])?>"</h1><?php
	}
	?>


	<form enctype="multipart/form-data" method="post" action="/">
		<input type="hidden" name="writemodule" value="admin/products">
		<input type="hidden" name="method" value="editProduct">
		<input type="hidden" name="categoryId" value="<?=$data['categoryId']?>">
		<input type="hidden" name="productId" value="<?=$data['product']['id']?>">
		<div class="image">
			<input type="file" name="image">
	<?php if($data['product']['image']){?>
			<img src="<?=$data['product']['image_url']?>">
	<?php }?>
		</div>
		<div class="data">
			<div class="textinput">
				<input name="title" type="text" value="<?=isset($data['product']['title']) ? htmlspecialchars($data['product']['title']) : ''?>">
			</div>
			<div class="areainput">
				<textarea name="description"><?=isset($data['product']['description']) ? htmlspecialchars($data['product']['description']) : '';?></textarea>
			</div>
			<div class="halfcontainer">
				<div class="half">
					<input name="weight" type="text" value="<?=isset($data['product']['title']) ? htmlspecialchars($data['product']['weight']) : ''?>">
				</div>
				<div class="half">
					<input name="price" type="text" value="<?=isset($data['product']['title']) ? htmlspecialchars($data['product']['price']) : ''?>">
				</div>
			</div>
		</div>

		<div class="submit">
			<input type="submit" value="Сохранить">
			<input type="submit" name="delete" value="Удалить">
		</div>
	</form>
	</div><?php
}