<?php
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
