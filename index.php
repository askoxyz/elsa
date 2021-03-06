<?php

/*
--------------------------------------------------------------------------------
Turn on error reporting
--------------------------------------------------------------------------------
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
--------------------------------------------------------------------------------
Define some things
--------------------------------------------------------------------------------
*/
define('ELSA', __DIR__);

/*
--------------------------------------------------------------------------------
Autoload dependencies
--------------------------------------------------------------------------------
*/
foreach(glob(ELSA . '/system/dependencies/*.php') as $dep) {

	require $dep;

}

/*
--------------------------------------------------------------------------------
Autoload system modules
--------------------------------------------------------------------------------
*/
foreach(glob(ELSA . '/system/modules/*.php') as $module) {

	require $module;

}

/*
--------------------------------------------------------------------------------
Autoload system controllers
--------------------------------------------------------------------------------
*/
foreach(glob(ELSA . '/system/controllers/*.php') as $controller) {

	require $controller;

}

/*
--------------------------------------------------------------------------------
Autoload app modules
--------------------------------------------------------------------------------
*/
foreach(glob(ELSA . '/app/modules/*.php') as $module) {

	require $module;

}

/*
--------------------------------------------------------------------------------
Autoload app controllers
--------------------------------------------------------------------------------
*/
foreach(glob(ELSA . '/app/controllers/*.php') as $controller) {

	require $controller;

}

/*
--------------------------------------------------------------------------------
Init
--------------------------------------------------------------------------------
*/
session_start();

$route = new Router;

/*
--------------------------------------------------------------------------------
Go forth!
--------------------------------------------------------------------------------
*/
require ELSA . '/app/before.php';
require ELSA . '/system/routes.php';
require ELSA . '/app/routes.php';
require ELSA . '/app/after.php';

$route->dispatchController($route->match());
