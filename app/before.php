<?php

// code to execute _before_ everything

// redirect appropriately
if(explode('.', $_SERVER['HTTP_HOST'])[0] === 'www' || empty($_SERVER['HTTPS'])) {

	$config = new Config;
	header('Location: ' . $config->get('url') . $_SERVER['REQUEST_URI']);

}
