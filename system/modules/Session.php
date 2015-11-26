<?php

class Session {

	public static function get($key) {

		if(!empty($_SESSION[$key])) {

			return $_SESSION[$key];

		}

		return false;

	}

	public static function put($key, $value) {

		$_SESSION[$key] = $value;

		return true;

	}

	public static function remove($key) {

		unset($_SESSION[$key]);

		return true;

	}

	public static function flush() {

		foreach($_SESSION as $key => $val) {

			unset($_SESSION[$key]);

		}

		$_SESSION = array();
		session_destroy();

		return true;
		
	}

}
