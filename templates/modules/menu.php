<?php

function templateMenuListAdmin($data)
{
	?><ul class="adminMenu"><?php
	$menuItems = $data['items'];
	foreach($menuItems as $name => $item)
	{
		?><li><a href="<?=$item['url']?>"><?=htmlspecialchars($item['title'])?></a></li><?php
	}
	?></ul><?php
}