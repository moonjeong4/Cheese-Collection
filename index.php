<?php include_once('./inc/loginMenu.php');
$page = "Login please.";
if (isset($_GET['p'])) {
	$page = trim(strip_tags($_GET['p']));
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $page; ?></title>
	<link rel="stylesheet" href="./css/login.css" />
</head>

<body>
	<h1>To see my Collection, Login first Please.</h1>
	<div class="center">
		<?php
		$menuObj = new Menu("mm", $page);

		$menuObj->addItem(new MenuItem("Login", "Login", 100));
		$menuObj->addItem(new MenuItem("Register", "Register", 101));

		echo $menuObj;

		require_once('./config/secrets.php');

		if ($login_result["loggedin"]) {
			header("Location: /finalphp/cheese.php");
		}

		echo '<div class="error">' . $page . '</div>';

		switch ($page) {

			case "Login":

				include('./content/login.php');
				break;
			case "Register":

				include('./content/register.php');
				break;
		}

		// echo $footMenuObj;

		?>
	</div>
</body>

</html>