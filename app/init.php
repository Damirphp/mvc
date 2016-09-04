<?php

session_start();

$GLOBALS['config'] = array(
	'DB' => array(
		'host' => 'localhost',
		'name' => 'app',
		'user' => 'root',
		'password' => '',
	),
	'session' => array(
		'user' => 'user',
		'token' => 'token',
		'login_token' => 'login',
		'signup_token' => 'signup',
		'flash_success' => 'flash'
	)
);

define('APP', 'http://localhost/mvc/public/');
function url($path) {
	echo APP . $path;
}

spl_autoload_register(function($class) {
	if(file_exists('../app/core/' . $class . '.php'))
		require_once '../app/core/' . $class . '.php';
	else if(file_exists('../app/helpers/' . $class . '.php'))
		require_once '../app/helpers/' . $class . '.php';
});

