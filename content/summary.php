<div>
	<?php

	$table = $pdo->query("SELECT `page_id`,`name`,`title`,`body`,`filename`,`date_modified`,`description`,`price range` FROM `page`;");

	echo "<table>";
	echo "<tr><th>Name</th><th>Description</th><th>Price Range</th></tr>";

	foreach ($table as $row) {
		if ($row['name'] === 'Summary') {
			continue;
		}
		echo "<tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>" . $row['price range'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	?>
</div>