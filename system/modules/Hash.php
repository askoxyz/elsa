<?php

class Hash {
	
	public static function make($str) {

		return crypt(urlencode($str));

	}

	public static function verify($str, $hash) {

		if($hash == crypt($str, $hash)) {

			return true;

		}

		return false;

	}

}
