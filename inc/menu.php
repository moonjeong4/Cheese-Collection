<ul class="menu">
	<?php

	$q_menu = $pdo->query("SELECT `label`,`name` FROM `menu` join page on page.page_id = menu.page_id WHERE `menu_name` = 'main' order by item_order;");

	foreach ($q_menu as $row) {
		echo "<li><a href=\"?p={$row['name']}\">{$row['name']}</a></li>";
	}
	?>
</ul>