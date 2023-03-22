<?php

$page_key = "Emmental";

if (isset($_GET["p"])) {
	$tmp = trim(strtolower($_GET["p"]));

	$q_exists = "SELECT count(`name`) as num FROM `page` WHERE `name` = ?;";
	$q_r = $pdo->prepare($q_exists);
	$q_r->execute([$tmp]);
	$numRecords = $q_r->fetchColumn();

	if ($numRecords > 0) {
		$page_key = $tmp;
	}
}

$q_pageInfo = $pdo->query("SELECT `page_id`,`name`,`title`,`body`,`filename`,`date_modified`,`description`,`price range` FROM `page` WHERE name = '$page_key';");

$pageInfo = $q_pageInfo->fetch();
