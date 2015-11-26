<?php

class Config {

	public static function get($key) {

		$config = new FrontMatter(ELSA . '/config.yml');

		if(!empty($config->fetch($key))) {

			return $config->fetch($key);

		}

		return false;

	}

}
