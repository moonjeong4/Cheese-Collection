<?php

require_once("./config/secrets.php");
require_once("./inc/init.php");
require_once("./inc/header.php");

include("./inc/menu.php");
include_once('./inc/loginMenu.php');

echo $pageInfo["body"];
// var_dump($pageInfo);
if (isset($pageInfo["filename"]) && file_exists("./content/" . $pageInfo["filename"])) {
	include("./content/" . $pageInfo["filename"]);
}

require_once("./inc/footer.php");
