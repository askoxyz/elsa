<?php

class Excerpt {

	public static function make($str, $words = 20) {

		$word_arr = explode(' ', $str);

		if(count($word_arr) > $words) {

			return implode(' ', array_slice($word_arr, 0, $words)) . ' ...';

		}

		return $str;

	}

}
