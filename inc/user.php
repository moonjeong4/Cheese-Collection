<?php
class User
{
	static $pdo = null;

	static function isUser($username)
	{
		$q_ups = User::$pdo->prepare("select user_id from user where username = ?");

		$q_ups->execute([$username]);

		if (!empty($q_ups->rowCount())) {
			return true;
		}

		return false;
	}

	static function create($username, $password, $email)
	{
		$username = strip_tags($username);

		// loggedin, username, message, success

		if (User::isUser($username)) {
			return ["loggedin" => false, "message" => "User already exist.", "success" => false];
		} else {
			// create the user

			// generate the password hash

			$password_hash = password_hash($password, PASSWORD_BCRYPT);

			$q_ips = User::$pdo->prepare("INSERT INTO `user` (`username`, `pass_hash`,`email`) VALUES (?, ?, ?);");

			$q_ips->execute([$username, $password_hash, $email]);

			if (!empty($q_ips->rowCount())) {
				return ["loggedin" => false, "message" => "User {$username} created.", "success" => true, "email" => $email,];
			}

			return ["loggedin" => false, "message" => "User could not be created!", "success" => false];
		}
	}

	static function logout()
	{
		setcookie("u", '', 1);
		setcookie("ch", '', 1);
	}

	static function passwordLogin($username, $password, $email)
	{
		$q_ups = User::$pdo->prepare("SELECT `user_id`,`username`,`pass_hash` FROM `user` WHERE `username` = ? AND email = ?");
		$q_ups->execute([$username, $email]);

		if (!empty($q_ups->rowCount())) {
			$row = $q_ups->fetch();
			//$row['pass_hash']

			if (password_verify($password, $row['pass_hash'])) {


				$cookie = md5(mt_rand(0, 9999999999999));
				$cookie_hash = password_hash($cookie, PASSWORD_BCRYPT);

				setcookie("u", $username);
				setcookie("ch", $cookie);

				$q_csp = User::$pdo->prepare("UPDATE `user` SET `cookie_hash` = ? WHERE `user_id` = ?");
				$q_csp->execute([$cookie_hash, $row['user_id']]);

				return [
					"loggedin" => true,
					"message" => "logged in",
					"success" => true,
					"username" => $row["username"],
					"user_id" => $row["user_id"],
				];
			}
		}
		return ["loggedin" => false, "message" => "unable to authenticate", "success" => false];
	}

	static function cookieLogin($username, $cookie)
	{
		$q_ups = User::$pdo->prepare("SELECT `user_id`,`username`,`cookie_hash` FROM `user` WHERE `username` = ?");
		$q_ups->execute([$username]);

		if (!empty($q_ups->rowCount())) {
			$row = $q_ups->fetch();

			if (password_verify($cookie, $row['cookie_hash'])) {
				return [
					"loggedin" => true,
					"message" => "logged in",
					"success" => true,
					"username" => $row["username"],
					"user_id" => $row["user_id"]
				];
			}
		}
		return ["loggedin" => false, "message" => "unable to authenticate", "success" => false];
	}
}
