<?php

public static function login($email, $password) {
		$user = self::getUser("null",$email);
		if (!is_null($user)) {
			$id = $user->get_id();
			$passwordHash = $user->get_password();
			$siteSalt  = "ulbuynsell";
			$saltedHash = hash('sha256', $password.$siteSalt);
			if ($passwordHash == $saltedHash) {
				return $user;
			}
        return null;
		}
	}

public static function logout() {
		/*http://php.net/manual/en/function.session-unset.php*/
		if (!isset ($_SESSION)) {
			session_start();
		}
		session_unset();
		session_destroy();
		session_write_close();
		session_regenerate_id(true);
	}
}
?>
