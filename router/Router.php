<?php
	require_once 'classRouter.php';

	$Router = new Router;

	/*
	EXAMPLE

	$ROUTER = new Router();

	$ROUTER->route('GET', 'get/5/router.php', function() {
		echo 'get/5/router.php';
	});

	$ROUTER->route('GET', 'source/{gdt}/{mmp}/router.php', function($vars) { 
		print_r($vars); 
		echo 'source/{gdt}/{mmp}/router.php'; 
	});		

	$ROUTER->route('GET', 'view/{varr}/router.php', function($vars) { 
		print_r($vars); 
		echo 'view/{varr}/router.php'; 
	});

	$ROUTER->route('GET', 'main/main.php', function() { 
		echo 'main/main.php';
	});		

	$ROUTER->route('GET', '*', function() { 
		echo '404Page'; 
	});
	*/

