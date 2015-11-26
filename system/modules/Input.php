<?php

class Input {
	
	public static function get($key, $fallback = false) {

		if(!empty($_POST[$key])) {

			return json_decode(json_encode($_POST[$key]));

		}

		if($fallback) {

			return $fallback;

		}

		return false;

	}

	public static function all() {

		if(!empty($_POST)) {

			return json_decode(json_encode($_POST));

		}

		return false;

	}

}