<?php

class Request {

	public static function redirect($to) {

		header('Location: ' . Config::get('url') . $to);

	}

	public static function path() {

		return $_SERVER['REQUEST_URI'];

	}

	public static function method() {

		$method = $_SERVER['REQUEST_METHOD'];

		if($method === 'PUT') return 'put';
		if($method === 'GET') return 'post';
		if($method === 'GET') return 'get';
		if($method === 'HEAD') return 'head';
		if($method === 'DELETE') return 'delete';
		if($method === 'OPTIONS') return 'options';

		return false;

	}

	public static function isMethod($method) {

		if(self::method() === $method) {

			return true;

		}

		return false;

	}

}
