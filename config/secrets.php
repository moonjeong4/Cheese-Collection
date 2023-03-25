<?php

$host = '127.0.0.1';
$db = 'FinalPHP';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$user = "xxxxxx";
$pass = "xxxxxx";

$options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
$options[PDO::ATTR_EMULATE_PREPARES] = false;

$pdo = null;
try {
	$pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $ex) {
	throw new PDOException($ex->getMessage(), $ex->getCode());
}

require_once("./inc/user.php");
User::$pdo = $pdo;
$login_result = ["loggedin" => false, "message" => "not logged in"];

if (isset($_GET['logout'])) {
	User::logout();
} else {

	if (isset($_COOKIE["ch"]) && isset($_COOKIE["u"])) {
		$t_cookie = $_COOKIE["ch"];
		$t_username = $_COOKIE["u"];

		$login_result = User::cookieLogin($t_username, $t_cookie);
	}

	if (!$login_result["loggedin"]) {

		if (isset($_POST['login']) && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['email'])) {

			$t_user = $_POST['user'];
			$t_password = $_POST['password'];
			$t_email = $_POST['email'];

			$login_result = User::passwordLogin($t_user, $t_password, $t_email);
		}
	}
}

if (isset($_POST['register']) && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['email'])) {

	$email = $_POST['email'];

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$t_user = $_POST['user'];
		$t_password = $_POST['password'];
		$t_email = $_POST['email'];

		$r = User::create($t_user, $t_password, $t_email);

		if ($r['success']) {
			echo '<div class="error">' . $r['message'] . '</div>';
		}
	} else {
		echo '<div class="error">' . $email . ' is not a valid email address.</div>';
	}
}
